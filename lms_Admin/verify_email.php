<?php
require_once '../core/init.php';
$admin = new Admin();

if (isset($_GET['token'])) {
  $token = $_GET['token'];
      if (empty($token)) {
        Redirect::to('sudo-login');
      }else{
          $verify =  $admin->selectTokenAdmin($token);
          $email = $verify->sudo_email;
          if (!$verify) {
            Redirect::to('sudo-login');
          }
          else{
              $admin->verify_email($email);
              $admin->deleteVkey($email);
             Redirect::to('sudo-login');
            }

      }
}
