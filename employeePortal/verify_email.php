<?php
require_once '../core/init.php';
	$user = new User();
if (isset($_GET['token'])) {
  $token = $_GET['token'];


      if (empty($token)) {
        Redirect::to('lod-dashboard');
      }else{
      	if (isLoggedInStudent()) {
        	$userid = $user->getId();
          $verify =  $user->selectToken($token, $userid );
          if ($verify===false) {
            Redirect::to('lod-dashboard');
          }else{
              $id = $verify->user_id;
              $user->verify_email($id);
              $user->deleteVkey($userid);
              Redirect::to('lod-dashboard');
            }

        }else{
        	 Redirect::to('login');
        }

      }
}
