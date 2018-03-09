<?php
/**
 * Testing function just to make sure everything is working.
 */
class TestCommand {
	public function __construct () {
		http_response_code(200);
		header('Content-Type: application/json');
		header('Status: 200 OK');
		
		$response = array(
			'response_type' => 'in_channel',
			'text' => 'Everything worked!'
		);
		
		echo json_encode($response);
	}
}