<?php
/**
 * Performs a lookup via the unofficial MAL API, Jikan.
 */
class AnimeLookup extends GenericTask {
	/**
	 * @var string constructed URL to use when hitting the Jikan endpoint
	 */
	private $api_url;
	
	/**
	 * Constructor for task controller AnimeLookup.
	 * 
	 * @param string $string text part of the command
	 */
	public function __construct ($string) {
		$e = $this->setQueryString ($string);
		
		if ($e !== null) {
			// Throw back the error message
			$this->textResponse ($e);
			return;
		}
		
		$json_data = $this->requestAnimeList ();
		$this->processAnimes ($json_data);
	}
	
	/**
	 * Constructs the endpoint URL.
	 * 
	 * @param string $string user's anime query
	 */
	private function setQueryString ($string) {
		if (empty (trim ($string))) {
			return ('Command requires argument in the form of a query. E.G. /anime black lagoon');
		}
		
		$this->api_url = 'http://api.jikan.me/search/anime/'.urlencode ($string).'/1';
	}
	
	/**
	 * Hits the Jikan endpoint and gives back the JSON response.
	 * 
	 * @return string JSON formatted response string
	 */
	private function requestAnimeList () {
		$curl = curl_init ();
		
		curl_setopt ($curl, CURLOPT_URL, $this->api_url);
		curl_setopt ($curl, CURLOPT_RETURNTRANSFER, true);
		
		$response = curl_exec ($curl);
		
		curl_close($curl);
		
		return ($response);
	}
	
	/**
	 * Processes the Jikan response JSON into a Slack-readable response.
	 * 
	 * @param string $json_data Jikan API response in JSON format
	 * 
	 * @return array Slack response
	 */
	private function processAnimes ($json_data) {
		$result = json_decode ($json_data, true);
		
		if (!isset ($result['result'][0])) {
			$this->textResponse ("No data");
			return;
		}
		
		$result = $result['result'][0];
		
		$slack_response = array (
			'response_type' => 'in_channel',
			'text' => $result['description'],
			'attachments' => array (
				array (
					'fallback' => 'Fallback text',
					'image_url' => $result['image_url'],
					'title' => $result['title'],
					'title_link' => $result['url']
				)
			)
		);
		
		$response = json_encode($slack_response);
		
		http_response_code(200);
		header('Content-Type: application/json');
		header('Status: 200 OK');
		
		echo $response;
	}
}
