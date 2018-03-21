<?php
/**
 * Reverses the given text.
 */
class TextReverse extends GenericTask {
	/**
	 * @var string text to be reversed
	 */
	private $text;
	
	/**
	 * Constructor for task controller TextReverse.
	 * 
	 * @param string $string text part of the command
	 */
	public function __construct ($string) {
		$e = $this->setText ($string);
		
		if ($e !== null) {
			// Throw back the error message
			$this->textResponse ($e);
			return;
		}
		
		$r = $this->reverseText ();
		$this->textResponse ($r);
	}
	
	/**
	 * Sets the text to be reversed.
	 * 
	 * @param string $string text part of the command
	 *
	 * @return string|void error string or void if successful
	 */
	private function setText ($string) {
		$string = trim ($string);
		
		if (empty ($string)) {
			return ('Command requires argument in the form of a string to be reversed.');
		}
		
		$this->text = $string;
	}
	
	private function reverseText () {
		return (strrev ($this->text));
	}
}
