<?php

 $user = new User();
if ((Session::exists(Config::get('session/session_user')))) {
  $userLoggedIn = $user->data()->email;
  $userLoggedInId = $user->data()->id;


}

  function isLoggedInUser(){
      $user = new User();
    if ($user->isLoggedIn()) {
        return true;
     }else{
        return false;
     }


      }


  $admin = new Admin();
  if (Session::exists(Config::get('session/session_admin'))) {
    $SuperLoggedInId = $admin->data()->id;

  }

  function isOTPset($useremail){
     $check = Database::getInstance()->get('verifyCommander', array('com_email', '=', $useremail));
    if ($check->count()) {
      return true;
    }else{
      return false;
    }
  }

  function isLoggedInAdmin(){
      $admin = new Admin();
    if ($admin->isLoggedInAdmin()) {
        return true;
    }else{
      return false;
    }
  }


function hasPermissionSuper($permission = 'Superuser'){
    $admin = new Admin();
    if (isset($_SESSION[Config::get('session/session_admin')])) {

    $permissioned = $admin->data()->sudo_permission;

    $permissions = explode(',', $permissioned);
     if (in_array($permission, $permissions,true)) {
      return true;
     }
     return false;

   }
}


function hasPermissionHOD($permission = 'HOD'){
     $admin = new Admin();
    if (isset($_SESSION[Config::get('session/session_admin')])) {

    $permissioned = $admin->data()->sudo_permission;

    $permissions = explode(',', $permissioned);
     if (in_array($permission, $permissions,true)) {
      return true;
     }
     return false;

   }

}
function hasPermissionMedical($permission = 'Medical'){
     $admin = new Admin();
    if (isset($_SESSION[Config::get('session/session_admin')])) {

    $permissioned = $admin->data()->sudo_permission;

    $permissions = explode(',', $permissioned);
     if (in_array($permission, $permissions,true)) {
      return true;
     }
     return false;

   }

}


function hasPermissionHR($permission = 'HR'){
     $admin = new Admin();
    if (isset($_SESSION[Config::get('session/session_admin')])) {

    $permissioned = $admin->data()->sudo_permission;

    $permissions = explode(',', $permissioned);
     if (in_array($permission, $permissions,true)) {
      return true;
     }
     return false;

   }

}

function hasPermissionEmployee($permission = 'employeePerm'){
     $user = new User();
    if (isset($_SESSION[Config::get('session/session_user')])) {

    $permissioned = $user->data()->permission;

    $permissions = explode(',', $permissioned);
     if (in_array($permission, $permissions,true)) {
      return true;
     }
     return false;

   }

}

