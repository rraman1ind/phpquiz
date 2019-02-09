<?php
header( "Access-Control-Allow-Origin: *" );
header( "Content-Type: application/json; charset=UTF-8" );

include_once 'QuizCore.php';

if ( $_SERVER['REQUEST_METHOD'] == "POST" ) {
	$quiz        = new QuizCore();
	$quiz_update = $quiz->updateQuiz( $_POST['question_id'], $_POST['test_id'], $_POST['choice_id'] );

} else {
	echo json_encode( array( "message" => 0 ) );
}

