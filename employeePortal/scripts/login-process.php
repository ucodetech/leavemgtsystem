<?php 
require_once '../../core/init.php';

$user = new User();
$show = new Show();

if (isset($_POST['action']) && $_POST['action'] == 'login') {

    if (Input::exists()) {
    	
    	$fileNo = $show->test_input($_POST['fileNo']);
    	$password = $show->test_input($_POST['password']);

    	if (empty($_POST['fileNo'])) {
    		echo 'File No. is required!';
    		return false;
    	}
    	if (empty($_POST['password'])) {
    		echo 'Password is required!';
    		return false;
    	}

			// $remember = (($remember == 'on'))?true : false;
    	$loggedIn = $user->login($fileNo, $password);
    		if($loggedIn)
    		 	echo 'success';
   			}		        	

    	}


    

