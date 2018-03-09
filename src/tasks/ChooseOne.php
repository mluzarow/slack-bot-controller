<?php
/**
 * Chooses a single option from a list of comma seperated items.
 */
class ChooseOne extends GenericTask {
	/**
	 * @var array list of items to choose from
	 */
	private $items = array ();
	
	/**
	 * Constructor for task controller ChooseOne.
	 * 
	 * @param string $string text part of the command
	 */
	public function __construct ($string) {
		$e = $this->setItems ($string);
		
		if ($e !== null) {
			// Throw back the error message
			$this->textResponse ($e);
			return;
		}
		
		$r = $this->chooseItem ();
		$this->textResponse ($r);
	}
	
	/**
	 * Sets items array with valid non-empty strings.
	 * 
	 * @param string $string text part of the command
	 *
	 * @return string|void error string or void if successful
	 */
	private function setItems ($string) {
		if (empty ($string)) {
			return ('Command requires argument in the form of a comma seperated list. E.G. /choose apple, orange');
		}
		
		$items = explode (',', $string);
		
		foreach ($items as $item) {
			$trimmed_item = trim ($item);
			
			if (!empty($trimmed_item)) {
				$this->items[] = $trimmed_item;
			}
		}
		
		if (empty ($this->items)) {
			return ('There are no valid items to choose from.');
		}
	}
	
	/**
	 * Chooses an item from the items list at random.
	 * 
	 * @return string chosen item
	 */
	private function chooseItem () {
		$highest_index = count ($this->items) - 1;
		$random_number = rand (0, $highest_index);
		
		return ($this->items[$random_number]);
	}
}
