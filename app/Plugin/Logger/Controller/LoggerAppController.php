<?php

App::uses('AppController', 'Controller');

class LoggerAppController extends AppController {
	
	/**
	 * @var array The components the entire Logger will use
	 */
	public $components = array(
		'Session',
		'Cookie',
		'Auth',
		'Security'
	);

	/**
	 * This is ran before every request to your actions.
	 */
	public function beforeFilter() {
		parent::beforeFilter();
		$this->_setUpAuth();
	}

	/**
	 * Set up the Auth component configuration
	 *
	 * @return void
	 */
	protected function _setUpAuth() {
		// The location to redirect to upon login.
		$this->Auth->loginRedirect = array('plugin'=>'logger', 'controller'=>'stats', 'action'=>'home');

		// The location to redirect to upon logout.
		$this->Auth->logoutRedirect = array('plugin'=>'logger', 'controller'=>'logger_users', 'action'=>'login');

		// The location of the login action.
		$this->Auth->loginAction = array('plugin'=>'logger', 'controller'=>'logger_users', 'action'=>'login');

		// Uses web form authentication
		// Tells it to use the LoggerUser model in the Logger plugin
		$this->Auth->authenticate = array(
			'Form'=>array('userModel'=>'Logger.LoggerUser')
		);

		$this->Auth->authorize = array('Controller');

		// The actions that are allowed to be viewed without Authentication
		// You can override this in the beforeFilter of a specific controller
		$this->Auth->allow('login', 'logout');
	}

	/**
	 * Determines if the logged in user has access to actions
	 *
	 * Only allow logged in users with admin role to access Logger.
	 *
	 * @var user the logged in user
	 * @return boolean 
	 */
	public function isAuthorized($user) {
		if ($user['role'] === 'admin') {
			return true;
		}
		return false;
	}
}