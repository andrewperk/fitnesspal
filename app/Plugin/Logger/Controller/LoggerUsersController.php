<?php

App::uses('LoggerAppController', 'Logger.Controller');

class LoggerUsersController extends LoggerAppController {

    /**
     * The main login page for Logger Admin User's
     * 
     * Checks for a post request (submitted form), then attempts to log 
     * the user in with what was in the request.
     *
     * If successful redirects to loginRedirect set in Auth Config.
     *
     * If not successful redisplays login form with errors.
     *
     * @return void
     */
    public function login() {
	    if ($this->request->is('post')) {
	        if ($this->Auth->login()) {
	            $this->redirect($this->Auth->redirect());
	        } else {
	            $this->Session->setFlash(__('Invalid username or password, try again'));
	        }
	    }
	}

    /**
     * The main logout action
     *
     * Just redirects to the logoutAction set in Auth Config and 
     * destroys session logging user out.
     *
     * @return void
     */
	public function logout() {
	    $this->redirect($this->Auth->logout());
	}

}