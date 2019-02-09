<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once 'QuizCore.php';

$test = new QuizCore();

$tests = $test->getAllTests();