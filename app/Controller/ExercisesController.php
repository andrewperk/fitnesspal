<?php

App::uses('AppController', 'Controller');

class ExercisesController extends AppController {
	public $name = 'Exercises';

	/**
	 * Just for testing purposes, allow this page
	 */
	public function index() {
		$this->set('exercises', $this->Exercise->find('all'));
	}

	/**
	 * Just for testing purpose, not allowed
	 */
	public function secret() {

	}
}