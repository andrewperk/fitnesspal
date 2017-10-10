<?php

/**
 * The main routes for the Logger plugin
 */

/**
 * The routes for the Auth of the Logger plugin
 */
Router::connect('/logger/login', array('plugin'=>'logger', 'controller'=>'logger_users', 'action'=>'login'));
Router::connect('/logger/logout', array('plugin'=>'logger', 'controller'=>'logger_users', 'action'=>'logout'));