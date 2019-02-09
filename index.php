<?php
include_once "partials/header.php";
?>

    <div class="container" id="start_quiz_container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 text-center">
                <h1 class="mt-5">Start Quiz</h1>
                <p class="lead">Enter Your Name, select test and click continue.</p>
                <p>
                <form name="start_test_form" id="start_test_form" method="post" action="functions/start.php">
                    <div class="form-group">
                        <input name="name" id="test_user_name" type="text" class="form-control" aria-describedby="emailHelp"
                               placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <select name="test" class="form-control" id="test_Select">
                            <option disabled selected>Select Test</option>
                        </select>
                    </div>
                    <button type="submit" id="start_test" class="btn btn-primary">Continue</button>
                </form>
                </p>
            </div>
        </div>
    </div>

    <div class="container" style="display: none">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="mt-5">Question</h2>
                <p class="lead">Click on the correct answer.</p>
                <div class="choices">
                    <a class="btn btn-sm btn-outline-dark mr-2" href="#" role="button">Link</a>
                    <a class="btn btn-sm btn-outline-dark mr-2" href="#" role="button">Link</a>
                    <a class="btn btn-sm btn-outline-dark mr-2" href="#" role="button">Link</a>
                    <a class="btn btn-sm btn-outline-dark mr-2" href="#" role="button">Link</a>
                </div>
                <p class="mt-3">
                    <a href="#" class="btn btn-primary">Next</a>
                </p>
                <div class="progress mt-2">
                    <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25"
                         aria-valuemin="0" aria-valuemax="100">25%
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container" id="finish_quiz" style="display: none"></div>

<?php
include_once "partials/footer.php";