<?php
/**
 * Chooses a single option from a list of comma seperated items.
 */
class AnimeLookup extends GenericTask {
	private $api_url;
	
	public function __construct ($string) {
		$e = $this->setQueryString ($string);
		
		if ($e !== null) {
			// Throw back the error message
			$this->textResponse ($e);
			return;
		}
		
		$json_data = $this->requestAnimeList ();
		// $r = $this->processAnimes ($json_data);
		
		$this->textResponse ($json_data);
	}
	
	private function setQueryString ($string) {
		if (empty (trim ($string))) {
			return ('Command requires argument in the form of a query. E.G. /anime black lagoon');
		}
		
		$this->api_url = 'http://api.jikan.me/search/anime/'.urlencode ($string).'/1';
	}
	
	private function requestAnimeList () {
		$curl = curl_init ();
		
		curl_setopt ($curl, CURLOPT_URL, $this->api_url);
		// curl_setopt ($curl, CURLOPT_POST, 0);
		// curl_setopt ($curl, CURLOPT_POSTFIELDS, '');
		curl_setopt ($curl, CURLOPT_RETURNTRANSFER, true);
		
		$response = curl_exec ($curl);
		
		curl_close($curl);
		
		return ($response);
	}
	
	private function processAnimes ($json_data) {
		$result = json_decode ($json_data);
		
		if (!isset ($result[0])) {
			// error
		}
		
		$result = $result[0];
		
		$slack_response = array (
			
		);
		
	}
}
