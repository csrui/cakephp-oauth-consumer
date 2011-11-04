<?php

class OauthConsumerComponent extends Object {
	
	private $client = null;
	
	protected $scope = null;
	
	protected $configuration = null;
	
	private $data_store = null;
	
	private $service = null;
	
	private $api_endpoint = null;

	//called before Controller::beforeFilter()
	function initialize(&$controller, $settings = array()) {
		// saving the controller reference for later use
		$this->controller =& $controller;
		
		App::import('Vendor', 'Oauth.oauth2');		
		App::import('Lib', 'Oauth.token_datastore');
		$this->data_store = new OAuth2_DataStore();
				
	}
	
	public function setup($client_id, $client_secret, $callback_url) {
		
		// configuration of client credentials
		$this->client = new OAuth2_Client(
			$client_id,
			$client_secret,
			$callback_url
		);
		
		$this->service = new OAuth2_Service($this->client, $this->configuration, $this->data_store, $this->scope);		
		
	}
	
	public function authorize() {
		
		if (isset($_GET['code'])) {
		    $this->service->getAccessToken();
		} else {
			$this->service->authorize();
		}
		
	}
	
	public function getAccessToken() {

		return $this->data_store->retrieveAccessToken()->getAccessToken();		

	}
	
	public function setAccessToken($token) {
		
		$this->data_store->storeAccessToken(new OAuth2_Token($token));
		
	}
	
	public function call($resource, $method = 'GET', array $uriParameters = array(), $postBody = null, array $additionalHeaders = array()) {
		
		return $this->service->callApiEndpoint($this->endpoint.$resource, $method, $uriParameters, $postBody, $additionalHeaders);
		
	}
	

}
?>