<?php
require_once '../../core/init.php';

$admin = new Admin();
$validate = new Validate();
$show = new Show();

if (isset($_POST['action']) && $_POST['action'] == 'login') {

	$supername = $show->test_input($_POST['supername']);
	$password = $show->test_input($_POST['password']);

	 if (empty($_POST['supername'])) {
	 	echo 'Username is required';
	 	return false;
	 }
	  if (empty($_POST['password'])) {
	 	echo 'Password is required';
	 	return false;
	 }


	$login = $admin->login($supername, $password);
	if ($login) {
		echo 'success';
	}


}
