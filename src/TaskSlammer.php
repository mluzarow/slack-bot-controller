<?php
/**
 * Controls startup of specific task objects.
 */
class TaskSlammer {
	/**
	 * @var string command keyword entered through slack
	 */
	private $command_key;
	/**
	 * @var string command arguments (everything after the command keyword)
	 */
	private $command_string;
	
	/**
	 * @var array constant dictionary of commands to classes that process them.
	 */
	private $tasks = array (
		'/test-command' => 'TestCommand',
		'/choose' => 'ChooseOne',
		'/anime' => 'AnimeLookup',
		'/timeleft' => 'TimeDifferenceWork',
		'/text-reverse' => 'TextReverse'
	);
	
	/**
	 * Constructor for controller TaskSlammer.
	 * 
	 * @param array $post_data $_POST data
	 */
	public function __construct ($post_data) {
		$this->setCommandData ($post_data);
		$this->processCommand ();
	}
	
	/**
	 * Sets command key and string properties.
	 * 
	 * @param array $post_data $_POST data
	 */
	private function setCommandData ($post_data) {
		$this->command_key = trim ($post_data['command']);
		$this->command_string = trim ($post_data['text']);
	}
	
	/**
	 * Calls the command controller class corresponding to the command received.
	 * Fires 400 - bad request if the command is not found.
	 */
	private function processCommand () {
		if (in_array ($this->command_key, array_keys ($this->tasks))) {
			try {
				$task = new $this->tasks[$this->command_key] ($this->command_string);
			} catch (Exception $e) {
				$response = array(
					'text' => $e->getMessage ()
				);
				$response = json_encode($response);
				
				http_response_code(200);
				header('Content-Type: application/json');
				header('Status: 200 OK');
				
				echo $respose;
			}
		} else {
			http_response_code(400);
			header('Content-Type: text/html; charset=UTF-8');
			header('Status: 400 Bad Request');
			echo 'Command "'.$this->command_key.'" does not exist.';
		}
	}
}
