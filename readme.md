Oauth CakePHP Plugin
====================

Provide consumers for Oauth2


Example foursquare authentication
---------------------------------

	<?php

	class UsersController extends AppController {

		public $components = array(
			'Oauth.FoursquareConsumer'
		);

	
		public function authorize() {
		
			$this->autoRender = false;
		
			$this->FoursquareConsumer->authorize();
		
			if (!is_null($this->FoursquareConsumer->getAccessToken())) {
		
				$response = json_decode($this->FoursquareConsumer->call('users/self.json'), true);
		
				if ($response['meta']['code'] == 200) {
				
					$this->Session->write('Auth.User', array(
						'id' => $response['response']['user']['id'],
						'username' => sprintf('%s %s', $response['response']['user']['firstName'], $response['response']['user']['lastName']),
						'avatar' => $response['response']['user']['photo']
					));
					$this->Session->write('Auth.token', $this->FoursquareConsumer->getAccessToken());
					$this->redirect('/');
				
				}
			
			}

		}
	
		public function signout() {
		
			$this->autoRender = false;
			$this->Session->destroy('Auth');
			$this->redirect('/');
		
		}

	}