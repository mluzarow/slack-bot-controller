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
	/*
		token=gIkuvaNzQIHg97ATvDxqgjtO
		team_id=T0001
		team_domain=example
		enterprise_id=E0001
		enterprise_name=Globular%20Construct%20Inc
		channel_id=C2147483705
		channel_name=test
		user_id=U2147483697
		user_name=Steve
		command=/weather
		text=94070
		response_url=https://hooks.slack.com/commands/1234/5678
		trigger_id=13345224609.738474920.8088930838d88f008e0
	 */
	private function setCommandData ($post_data) {
		$command = trim ($post_data['command']);
		
		if (in_array ($command, array_keys ($this->tasks))) {
			$task = new $this->tasks[$command] ();
		} else {
			http_response_code(400);
			header('Content-Type: text/html; charset=UTF-8');
			header('Status: 400 Bad Request');
			echo 'Command "'.$command[0].'" does not exist.';
		}
	}
}
