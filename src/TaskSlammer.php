<?php

class TaskSlammer {
	private $command_key;
	private $command_string;
	
	private $tasks = array (
		'test-command' => 'TestCommand'
	);
	
	public function __construct ($post_data) {
		$this->setCommandData ($post_data);
	}
	
	private setCommandData ($post_data) {
		if (empty($post_data)) {
			echo 'There is no command data';
		}
		
		$command = explode (' ', $post_data);
		
		if (in_array ($command[0], $this->tasks)) {
			$task = new $this->tasks[$command[0]] ();
		} else {
			echo 'Command "'.$command[0].'" does not exist.';
		}
	}
}
