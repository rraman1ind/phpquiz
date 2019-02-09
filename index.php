<?php
include_once "partials/header.php";
?>

    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 text-center">
                <h1 class="mt-5">Start Quiz</h1>
                <p class="lead">Enter Your Name, select test and click continue.</p>
                <p>
                <form name="start_test">
                    <div class="form-group">
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                               placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <select class="form-control" id="exampleFormControlSelect1">
                            <option disabled>Select Test</option>
                            <option>Test 1</option>
                            <option>Test 2</option>
                            <option>Test 4</option>
                            <option>Test 5</option>
                        </select>
                    </div>
                    <button type="submit" id="start_test" class="btn btn-primary">Continue</button>
                </form>
                </p>
            </div>
        </div>
    </div>

    <div class="container">
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

    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1 class="mt-5">Thanks Name</h1>
                <p class="lead">You answered 10 ort of 20 questions in TEst quiz !!</p>
                <div class="score">
                    <table class="table">
                        <tbody>
                        <tr>
                            <td>Test</td><td>Test Name</td>
                        </tr>
                        <tr>
                            <td>Total Questions</td><td>10</td>
                        </tr>
                        <tr>
                            <td>Attempted</td><td>10</td>
                        </tr>
                        <tr>
                            <td>Correct</td><td>10</td>
                        </tr>
                        <tr>
                            <td>Wrong</td><td>10</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<?php
include_once "partials/footer.php";