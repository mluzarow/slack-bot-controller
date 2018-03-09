<?php
/**
 * Generic task class from which all other tasks inherit.
 */
class GenericTask {
	/**
	 * Reply publically with text to the chat.
	 * 
	 * @param string $text reply text
	 */
	protected function textResponse ($text) {
		$response = array(
			'response_type' => 'in_channel',
			'text' => $text
		);
		$response = json_encode($response);
		
		http_response_code(200);
		header('Content-Type: application/json');
		header('Status: 200 OK');
		
		echo $response;
	}
}
