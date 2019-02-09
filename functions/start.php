<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once 'QuizCore.php';

$quiz = new QuizCore();

$questions = $quiz->startQuiz(1, 'Nidhin');

print_r($questions);