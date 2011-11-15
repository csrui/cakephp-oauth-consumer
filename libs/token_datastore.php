<?php

App::import('Vendor', 'Oauth.oauth2');
class OAuth2_DataStore implements OAuth2_DataStore_Interface {

	private $token = null;

    /**
     *
     * @return OAuth2_Token
     */
    public function retrieveAccessToken() {
        return !is_null($this->token) ? $this->token : new OAuth2_Token();
    }

    /**
     * @param OAuth2_Token $token
     */
    public function storeAccessToken(OAuth2_Token $token) {
		$this->token = $token;
    }

}

?>