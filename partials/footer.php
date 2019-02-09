</div>
<!-- Bootstrap core JavaScript -->
<script src="../assets/js/jquery-3.3.1.slim.min.js"></script>
<script src="../assets/js/popper.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/jquery.cookie.js"></script>
<script>
    var numberOfQuestions;
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

            var option_submit = $("#" + target);
            option_submit.prop('disabled', false);
            option_submit.attr("data-question_id", question_id);
            option_submit.attr("data-test_id", test_id);
            option_submit.attr("data-choice_id", choice_id);
        });

        // Submit option "Next Button"
        $('body').on('click', '.answer_option_submit', function (ev) {
            ev.preventDefault();
            var question_id = $(this).attr("data-question_id");
            var test_id = $(this).attr("data-test_id");
            var choice_id = $(this).attr("data-choice_id");

            submit_option(question_id, test_id, choice_id);
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
        $.ajax({
            url: 'functions/start.php',
            // dataType: 'json',
            processData: false,
            contentType: false,
            type: 'POST',
            data: fd,
            success: function (data, textStatus, jQxhr) {
                createQuestionElements(data['questions']);
                numberOfQuestions = data['questions'].length;
                $.cookie("test_id", data['test_id']);
            },
            error: function (jqXhr, textStatus, errorThrown) {
                console.log(errorThrown);
            }
        });
    }

    function createQuestionElements(questions) {

        $("#start_quiz_container").fadeOut();
        var test_id = $.cookie("test_id");

        questions.forEach(function (question, index) {
            var question_number = index + 1;

            var choicesHtml = '';
            $.each(question['choices'], function (index, choice) {
                choicesHtml += '<a class="btn btn-sm btn-outline-dark mr-2 answer_option" href="#" data-question="' + question["id"] + '" data-test="' + test_id + '" data-choice="' + choice["id"] + '" data-target="submit_' + question_number + '" role="button">' + choice['choice'] + '</a>';
            });

            var finalHtml = '<div class="container" id="question_' + question_number + '" style="display: none">\n' +
                '        <div class="row">\n' +
                '            <div class="col-lg-12 text-center">\n' +
                '                <h2 class="mt-5">Question</h2>\n' +
                '                <p class="lead">Click on the correct answer.</p>\n' +
                '                <div class="choices">\n' + choicesHtml +
                '                </div>\n' +
                '                <p class="mt-3">\n' +
                '                    <a href="#" id="submit_' + question_number + '" data-question-number="' + question_number + '" class="btn btn-primary answer_option_submit">Next</a>\n' +
                '                </p>\n' +
                '                <div class="progress mt-2">\n' +
                '                    <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25"\n' +
                '                         aria-valuemin="0" aria-valuemax="100">25%\n' +
                '                    </div>\n' +
                '                </div>\n' +
                '            </div>\n' +
                '        </div>\n' +
                '    </div>';


            $('.main_container').append(finalHtml);
            startQuiz();

        });

    }

    function submit_option(question_id, test_id, choice_id) {
        var fd = new FormData();
        fd.append('question_id', question_id);
        fd.append('test_id', test_id);
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
                if (data['message'] == 1) {
                    console.log('next question');
                } else {
                    console.log('Finish quiz');
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

</script>
</body>
</html>