<?php

App::uses('AppModel', 'Model');

class LoggerAppModel extends AppModel {
	
	/**
     * Since I'm not using Cake default naming conventions
     * we need to specifiy which database config to use.
     * 
     * @var string
     */
    public $useDbConfig = 'logger';
}