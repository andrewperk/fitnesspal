<?php

// Include the LoggerUser model
App::uses('LoggerUser', 'Logger.Model');

// Include the AuthComponent
App::uses('AuthComponent', 'Controller/Component');

/**
 * This schema is used to create any nessecary tables for 
 * Logger Plugin. To run this schema and create the tables 
 * from your command line run:
 *
 * The -c tells it which DB connection to use
 * The -p tells it to run this schema from the Logger plugin
 *
 * Commands:
 *
 * $cd /path/to/cakeapp/app
 * $./Console/cake schema create logger -c logger -p Logger
 */

class loggerSchema extends CakeSchema {

	public $name = 'logger';

	public $LoggerUser = null;

	/**
	 * This is ran before any tables are created/dropped.
	 *
	 * @return boolean
	 */
	public function before($event = array()) {
		// Flush the cache
		$db = ConnectionManager::getDatasource($this->connection);
		$db->cacheSources = false;
		return true;
	}

	/**
	 * This is ran after any tables are created/dropped.
	 */
	public function after($event = array()) {
		// If we're creating the logger_users table create default Admin User
		if (isset($event['create']) && ($event['create'] == 'logger_users')) {
			$this->_createDefaultAdminUser();
		}
	}

	/**
	 * This array is used to build the Schema of the logger_users table.
	 *
	 * When this schema is ran this table will be created for you in 
	 * the database.
	 */
	public $logger_users = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'username' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'password' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 40, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'role' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'engine' => 'InnoDB')
	);

	/**
	 * This array is used to build the Schema of the sucker_log
	 */
	public $sucker_logs = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'ip' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 15, 'key' => 'index', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'ip_name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 66, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'domain' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 33, 'key' => 'index', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'url_decoded' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 99, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'user_agent' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 99, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'referer' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 256, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'cookie_return' => array('type' => 'boolean', 'null' => false, 'default' => null),
		'last_usage' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'last_usage_human' => array('type' => 'timestamp', 'null' => false, 'default' => 'CURRENT_TIMESTAMP'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'ip' => array('column' => 'ip', 'unique' => 0),
			'domain' => array('column' => 'domain', 'unique' => 0),
			'last_usage' => array('column' => 'last_usage', 'unique' => 0),
			'multi_ip_lusage' => array('column' => array('ip', 'last_usage'), 'unique' => 0),
			'multi_ip_creturn' => array('column' => array('ip', 'cookie_return'), 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'engine' => 'MEMORY')
	);

	/**
	 * Creates the default Admin user for the Logger
	 */
	private function _createDefaultAdminUser() {
		// Create instance of the LoggerUser model
		$this->LoggerUser = ClassRegistry::init('LoggerUser');
		//  Tell it to use the logger DB config
		$this->LoggerUser->useDbConfig = 'logger';

		// Save the default Admin user using the details from 
		// the Logger/Config/bootstrap.php
		$this->LoggerUser->create();
		$this->LoggerUser->save(array(
			'username'=>Configure::read('logger_admin_username'),
			'password'=>AuthComponent::password(Configure::read('logger_admin_password')),
			'role'=>'admin'
		));
	}
}