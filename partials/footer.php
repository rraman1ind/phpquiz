</div>
<!-- Bootstrap core JavaScript -->
<script src="../assets/js/jquery-3.3.1.slim.min.js"></script>
<script src="../assets/js/popper.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/jquery.cookie.js"></script>
<script>
    var numberOfQuestions;
    document.cookie = 'test_id=;expires=Thu, 01 Jan 1970 00:00:01 GMT;';
    $(document).ready(function () {
        getAllTests();
        $("#start_test_form").submit(function (ev) {
            ev.preventDefault();
            startTest();
        });

        // Select option of Question
        $('body').on('click', '.answer_option', function (ev) {
            ev.preventDefault();
            var question_id = $(this).data("question");
            var test_id = $(this).data("test");
            var choice_id = $(this).data("choice");
            var target = $(this).data("target");
            var question_number = $(this).data("question_number");

            var option_submit = $("#" + target);
            option_submit.prop('disabled', false);
            option_submit.attr("data-question_id", question_id);
            option_submit.attr("data-test_id", test_id);
            option_submit.attr("data-choice_id", choice_id);
            option_submit.attr("data-question_number", question_number);
        });

        // Submit option "Next Button"
        $('body').on('click', '.answer_option_submit', function (ev) {
            ev.preventDefault();
            var question_id = $(this).attr("data-question_id");
            var test_id = $(this).attr("data-test_id");
            var choice_id = $(this).attr("data-choice_id");
            var question_number = $(this).attr("data-question_number");

            submit_option(question_id, test_id, choice_id, question_number);
        });
    });

    function getAllTests() {
        $.ajax({
            url: 'functions/tests.php',
            dataType: 'json',
            type: 'get',
            contentType: 'application/json',
            success: function (data, textStatus, jQxhr) {
                $.each(data, function (key, value) {
                    $('#test_Select')
                        .append($("<option></option>")
                            .attr("value", value['id'])
                            .text(value['name']));
                });
            },
            error: function (jqXhr, textStatus, errorThrown) {
                console.log(errorThrown);
            }
        });
    }

    function startTest() {
        var fd = new FormData();
        fd.append('name', $("#test_user_name").val());
        fd.append('test', $("#test_Select option:selected").val());
        fd.append('test_name', $("#test_Select option:selected").text());
        $.ajax({
            url: 'functions/start.php',
            // dataType: 'json',
            processData: false,
            contentType: false,
            type: 'POST',
            data: fd,
            success: function (data, textStatus, jQxhr) {
                $.cookie("test_id", data['test_id']);
                createQuestionElements(data['questions']);
                numberOfQuestions = data['questions'].length;
            },
            error: function (jqXhr, textStatus, errorThrown) {
                console.log(errorThrown);
            }
        });
    }

    function createQuestionElements(questions) {

        $("#start_quiz_container").fadeOut();
        var test_id = $.cookie("test_id");
        var totalNumberOfQuestions = questions.length;
        var progressStep = 100/totalNumberOfQuestions;

        questions.forEach(function (question, index) {
            var question_number = index + 1;
            var progress = index*progressStep;

            var choicesHtml = '';
            $.each(question['choices'], function (index, choice) {
                choicesHtml += '<a class="btn btn-sm btn-outline-dark mr-2 answer_option" href="#" data-question_number="' + question_number + '" data-question="' + question["id"] + '" data-test="' + test_id + '" data-choice="' + choice["id"] + '" data-target="submit_' + question_number + '" role="button">' + choice['choice'] + '</a>';
            });

            var finalHtml = '<div class="container" id="question_' + question_number + '" style="display: none">\n' +
                '        <div class="row">\n' +
                '            <div class="col-lg-12 text-center">\n' +
                '                <h2 class="mt-5">'+question['question']+'</h2>\n' +
                '                <p class="lead">Click on the correct answer.</p>\n' +
                '                <div class="choices">\n' + choicesHtml +
                '                </div>\n' +
                '                <p class="mt-3">\n' +
                '                    <a href="#" id="submit_' + question_number + '" data-question-number="' + question_number + '" class="btn btn-primary answer_option_submit">Next</a>\n' +
                '                </p>\n' +
                '                <div class="progress mt-2">\n' +
                '                    <div class="progress-bar" role="progressbar" style="width: '+progress+'%;" aria-valuenow="25"\n' +
                '                         aria-valuemin="0" aria-valuemax="100">'+progress+'%\n' +
                '                    </div>\n' +
                '                </div>\n' +
                '            </div>\n' +
                '        </div>\n' +
                '    </div>';


            $('.main_container').append(finalHtml);
            startQuiz();

        });

    }

    function submit_option(question_id, test_id, choice_id, question_number) {
        var fd = new FormData();
        fd.append('question_id', question_id);
        fd.append('test_id', test_id);
        fd.append('choice_id', choice_id);

        $.ajax({
            url: 'functions/quiz.php',
            // dataType: 'json',
            processData: false,
            contentType: false,
            type: 'POST',
            data: fd,
            success: function (data, textStatus, jQxhr) {
                $("#question_" + question_number).fadeOut();
                if (data['message'] == 1) {
                    var next_question_id = parseInt(question_number) + 1;
                    $("#question_" + next_question_id).fadeIn();
                } else if (data['message'] == 2) {
                    finishQuiz(data["result"]);
                } else {
                    console.log(data, textStatus, jQxhr);
                }
            },
            error: function (jqXhr, textStatus, errorThrown) {
                console.log(errorThrown);
            }
        });
    }

    function startQuiz() {
        $("#question_1").fadeIn();
    }

    function finishQuiz(result) {
        var total_wrong_answers = parseInt(result["total_questions"]) - parseInt(result["total_correct"]);

        var finish_quiz_html = '<div class="row">\n' +
            '            <div class="col-lg-12 text-center">\n' +
            '                <h1 class="mt-5">Thanks ' + result["user_name"] + '</h1>\n' +
            '                <p class="lead">You answered ' + result["total_answered"] + ' out of ' + result["total_questions"] + ' questions in ' + result["test_name"] + ' !!</p>\n' +
            '                <div class="score">\n' +
            '                    <table class="table">\n' +
            '                        <tbody>\n' +
            '                        <tr>\n' +
            '                            <td>Test</td><td>' + result["test_name"] + '</td>\n' +
            '                        </tr>\n' +
            '                        <tr>\n' +
            '                            <td>Total Questions</td><td>' + result["total_questions"] + '</td>\n' +
            '                        </tr>\n' +
            '                        <tr>\n' +
            '                            <td>Attempted</td><td>' + result["total_answered"] + '</td>\n' +
            '                        </tr>\n' +
            '                        <tr>\n' +
            '                            <td>Correct</td><td>' + result["total_correct"] + '</td>\n' +
            '                        </tr>\n' +
            '                        <tr>\n' +
            '                            <td>Wrong</td><td>' + total_wrong_answers + '</td>\n' +
            '                        </tr>\n' +
            '                        </tbody>\n' +
            '                    </table>\n' +
            '                </div>\n' +
            '            </div>\n' +
            '        </div>';

        $("#finish_quiz").append(finish_quiz_html);
        $("#finish_quiz").show();
    }

</script>
</body>
</html>