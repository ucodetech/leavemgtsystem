<?php
	session_start();
	$GLOBALS['config'] = array(
		'mysql' => array(
			'host' => '127.0.0.1',
			'username' => 'root',
			'password' => '',
			'db' => 'lms_database'

		),
		'remember' => array(
			'cookie_name' => 'hashlms',
			'cookie_expiry' => '604800'
		),
		'session' => array(
			'session_admin' => 'lmsAdmin',
			'session_user' => 'lmsUser',
			'token_name' => 'token'
		)
	);

  //APP ROOT
 define('APPROOT', dirname(dirname(__FILE__)));

 //URL ROOT

 define('URLROOT', 'http://localhost/leavemgtsystem/');

 //SITE NAME
 define('SITENAME', 'LMS');
 define('APPVERSION', '1.0.0');
 define('ADMIN', 'CONTROL ROOM');
 define('NAVNAME', 'LMS');
 define('DASHBOARD', 'User Panel');
 define('FPILOGO', '../images/fpinacoss.jpeg');
 define('LOADER', '../images/gif/trans2.gif');
 define('LOADER2', '../images/gif/tra.gif');



spl_autoload_register(function($class){
	require_once (APPROOT .'/classes/' . $class . '.php');
});


require_once (APPROOT .'/helpers/session_helper.php');
require_once (APPROOT .'/helpers/session.php');

error_reporting();