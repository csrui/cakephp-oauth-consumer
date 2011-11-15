<?php

App::import('Component', 'Oauth.OauthConsumer');

class FoursquareConsumerComponent extends OauthConsumerComponent {

	//called after Controller::beforeFilter()
	public function startup(&$controller) {
		
		// configuration of service
		$this->configuration = new OAuth2_Service_Configuration(
	        'https://foursquare.com/oauth2/authorize',
	        'https://foursquare.com/oauth2/access_token'
		);
		
		$this->endpoint = 'https://api.foursquare.com/v2/';
		
		$this->setup(
			configure::read('4sq.client_id'),
        	configure::read('4sq.client_secret'),
			configure::read('4sq.callback_url')
        );
		
	}

	//called after Controller::beforeRender()
	function beforeRender(&$controller) {
	}

	//called after Controller::render()
	function shutdown(&$controller) {
	}	

}
?>