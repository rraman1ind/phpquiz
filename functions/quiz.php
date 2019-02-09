<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once 'QuizCore.php';

$quiz = new QuizCore();

$quiz_update = $quiz->updateQuiz(7, 5, 24);