<?php

namespace UnitTestFiles\Test;

use PHPUnit\Framework\TestCase;
use QuizCore;
use GuzzleHttp\Client;


class QuizCoreTest extends TestCase {

	public function testGetAllTests() {
		$client   = new Client( [ 'base_uri' => 'http://localhost:8000/' ] );
		$response = $client->get( '/functions/tests.php' );

		$responseBody       = $response->getBody();
		$responseHeader     = $response->getHeader( 'content-type' )[0];
		$responseStatusCode = $response->getStatusCode();


		$this->assertEquals( 200, $responseStatusCode );
		$this->assertContains( "application/json", $responseHeader );
		$this->assertNotEmpty( $responseBody );
	}

	public function testStartQuiz() {
		$client   = new Client( [ 'base_uri' => 'http://localhost:8000/' ] );
		$response = $client->post( '/functions/start.php', array(
			'form_params' => array(
				'test'      => 1,
				'test_name' => 'Test 1',
				'name'      => 'Rmni'
			)
		) );

		$responseBody       = $response->getBody();
		$responseHeader     = $response->getHeader( 'content-type' )[0];
		$responseStatusCode = $response->getStatusCode();


		$this->assertEquals( 200, $responseStatusCode );
		$this->assertContains( "application/json", $responseHeader );
		$this->assertNotEmpty( $responseBody );
	}
}