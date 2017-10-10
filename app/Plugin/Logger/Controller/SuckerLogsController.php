<?php

App::uses('LoggerAppController', 'Logger.Controller');

class SuckerLogsController extends LoggerAppController {

	public function index() {
		$this->set('suckers', $this->SuckerLog->find('all'));
	}
}