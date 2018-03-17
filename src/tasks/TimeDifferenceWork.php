<?php
/**
 * Finds the time left in your workday.
 */
class TimeDifferenceWork extends GenericTask {
	/**
	 * @var Date time as of firing this command in timezone UTC
	 */
	private $current_time;
	/**
	 * @var Date time at which work ends (4:30 PM)
	 */
	private $end_time = date ('h:i:s A', mkdate (16, 30, 0));
	
	/**
	 * Constructor for task controller TimeDifferenceWork.
	 */
	public function __construct () {
		$this->setTime ();
		
		$r = $this->calcTime ();
		$this->textResponse ($r);
	}
	
	/**
	 * Sets the current time.
	 */
	private function setTime () {
		// Set the default timezone to use.
		date_default_timezone_set('UTC');
		
		$this->current_time = date ('h:i:s A');
	}
	
	/**
	 * Calculates remaining time in workday.
	 * 
	 * @return string formatted time remaining
	 */
	private function calcTime () {
		$remaining_time = $this->end_time - $this->current_time;
		
		return ($remaining_time);
	}
}
