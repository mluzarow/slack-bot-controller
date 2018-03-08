<?php

class TaskSlammer {
	private $command_key;
	private $command_string;
	
	private $tasks = array (
		'/test-command' => 'TestCommand'
	);
	
	public function __construct ($post_data) {
		$this->setCommandData ($post_data);
	}
	
	private function setCommandData ($post_data) {
		if (empty($post_data)) {
			http_response_code(400);
			header('Content-Type: text/html; charset=UTF-8');
			header('Status: 400 Bad Request');
			echo 'There is no command data';
		}
		
		$command = explode (' ', $post_data);
		
		if (in_array ($command[0], $this->tasks)) {
			$task = new $this->tasks[$command[0]] ();
		} else {
			http_response_code(400);
			header('Content-Type: text/html; charset=UTF-8');
			header('Status: 400 Bad Request');
			echo 'Command "'.$command[0].'" does not exist.';
		}
	}
}
