<?php

/**
 * Logger Plugin wide configuration can be set in here.
 */

// -------------------------------------------------------

/**
 * The Logger will only need one user, the Admin
 *
 * The Admin for the Logger will be created when you run 
 * the Logger Schema. That Admin will use these values 
 * for the username and password.
 *
 * Here you can change the: 
 *    logger_admin_username
 *    logger_admin_password
 * 
 * Change to something you will remember. 
 * 
 */

// logger_admin_username: the value of the username is the 2nd param: LoggerAdmin
Configure::write('logger_admin_username', 'LoggerAdmin');

// logger_admin_password: the value of the password is the 2nd param: LoggerAdminPassword
Configure::write('logger_admin_password', 'LoggerAdminPassword');