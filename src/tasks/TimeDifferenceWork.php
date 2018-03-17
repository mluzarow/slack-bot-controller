<?php
/**
 * Finds the time left in your workday.
 */
class TimeDifferenceWork extends GenericTask {
	/**
	 * @var DateTime time as of firing this command in timezone UTC
	 */
	private $current_time;
	/**
	 * @var DateTime time at which work ends (4:30 PM)
	 */
	private $end_time;
	
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
		date_default_timezone_set('America/Chicago');
		
		$this->end_time = new DateTime ('16:30:00');
		$this->current_time = new DateTime ('now');
	}
	
	/**
	 * Calculates remaining time in workday.
	 * 
	 * @return string formatted time remaining
	 */
	private function calcTime () {
		$remaining_time = $this->current_time->diff ($this->end_time);
		
		return ($remaining_time->format ('%H hrs %I mins %S sec'));
	}
}
