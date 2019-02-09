<?php
header( "Access-Control-Allow-Origin: *" );
header( "Content-Type: application/json; charset=UTF-8" );

include_once 'QuizCore.php';

if ( $_SERVER['REQUEST_METHOD'] == "POST" ) {
	$quiz = new QuizCore();
	$questions = $quiz->startQuiz( $_POST['test'],$_POST['test_name'], $_POST['name']);
} else {
	echo json_encode(array("message" => 0));
}
