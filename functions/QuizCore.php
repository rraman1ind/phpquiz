<?php
include_once 'Database.php';

class QuizCore extends Database {

	public function __construct() {
		parent::__construct();
	}

	public function getAllTests() {
		$query         = "SELECT * from test";
		$statement     = $this->connect()->query( $query );
		$numberOfTests = $statement->rowCount();
		$tests         = [];

		if ( $tests > 0 ) {
			while ( $row = $statement->fetch( PDO::FETCH_ASSOC ) ) {
				array_push( $tests, $row );
			}

			http_response_code( 200 );
			echo json_encode( $tests );

		} else {
			http_response_code( 404 );
			echo json_encode(
				array( "message" => "No Tests found." )
			);
		}
	}

	public function getAllTestQuestions( $testId = 1 ) {
		$query             = "SELECT * from question WHERE test_id = " . $testId;
		$statement         = $this->connect()->query( $query );
		$numberOfQuestions = $statement->rowCount();
		$questions         = [];

		if ( $numberOfQuestions > 0 ) {
			while ( $row = $statement->fetch( PDO::FETCH_ASSOC ) ) {

				$choice_query     = "SELECT choice, id from choices WHERE question_id=" . $row['id'];
				$choice_statement = $this->connect()->query( $choice_query );
				$numberOfChoices  = $choice_statement->rowCount();
				$choices          = [];

				while ( $choice_item = $choice_statement->fetch( PDO::FETCH_ASSOC ) ) {
					array_push( $choices, $choice_item );
				}

				$row['choices'] = $choices;
				array_push( $questions, $row );
			}

			return $questions;

		} else {
			return false;
		}
	}

	public function startQuiz( $test_id, $test_name, $user_name ) {
		// Get Questions of test
		$questions = $this->getAllTestQuestions( $test_id );

		if ( $questions ) {
			// Add test to results table
			$query     = "INSERT INTO results SET test_id=:test_id, test_name=:test_name, user_name=:user_name, total_questions=:total_questions, total_answered=0, total_correct=0";
			$statement = $this->connect()->prepare( $query );
			$statement->execute( array(
				':test_id'         => $test_id,
				':test_name'       => $test_name,
				':user_name'       => $user_name,
				':total_questions' => sizeof( $questions ),
			) );

			$data = [
				'test_id'   => $this->connect()->lastInsertId(),
				'questions' => $questions
			];

			http_response_code( 200 );
			echo json_encode( $data );

		} else {
			http_response_code( 404 );
			echo json_encode(
				array( "message" => "No Questions found." )
			);
		}
	}

	public function updateQuiz( $result_id, $question_id, $choice_id ) {
		$query     = "SELECT * from choices WHERE id=" . $choice_id . " AND question_id=" . $question_id;
		$statement = $this->connect()->query( $query );
		$choice    = $statement->fetch( PDO::FETCH_ASSOC );
		if ( $choice && $choice['is_answer'] == 1 ) {
			$quiz_update_query = "UPDATE results SET total_answered = total_answered + 1, total_correct = total_correct + 1 WHERE id=:result_id";
		} else {
			$quiz_update_query = "UPDATE results SET total_answered = total_answered + 1 WHERE id=:result_id";
		}

		$resultStatement = $this->connect()->prepare( $quiz_update_query );
		$status          = $resultStatement->execute( array(
			':result_id' => $result_id
		) );

		if ( $status ) {

			$result_query     = "SELECT * FROM results WHERE id=" . $result_id;
			$result_statement = $this->connect()->query( $result_query );
			$result           = $result_statement->fetch( PDO::FETCH_ASSOC );

			if ( $result['total_questions'] <= $result['total_answered'] ) {

				$this->endQuiz( $result );

			} else {
				http_response_code( 200 );
				echo json_encode(
					array( "message" => "1" )
				);
			}
		} else {
			http_response_code( 404 );
			echo json_encode(
				array( "message" => "0" )
			);
		}
	}

	public function endQuiz( $result ) {

		$update_result_query = "UPDATE results SET quiz_finished_at = CURRENT_TIMESTAMP WHERE id=" . $result['id'];
		$resultStatement     = $this->connect()->prepare( $update_result_query );
		$status              = $resultStatement->execute();

		$test_results = $this->getResults( $result['id'] );

		http_response_code( 200 );
		echo json_encode(
			array( "message" => "2", "result" => $result )
		);

	}

	public function getResults( $result_id ) {
		$query     = "SELECT * from results WHERE id = " . $result_id;
		$statement = $this->connect()->query( $query );
		$data      = $statement->fetch( PDO::FETCH_ASSOC );

		return $data;
	}

}