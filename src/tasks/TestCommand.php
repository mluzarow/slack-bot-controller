<?php
/**
 * Testing function just to make sure everything is working.
 */
class TestCommand extends GenericTask {
	public function __construct () {
		$this->textResponse ('Everything worked!');
	}
}
