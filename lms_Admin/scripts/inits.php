<?php
require_once '../../core/init.php';
$general = new General();
$user = new Employee();
$leave = new Leave();
$show = new Show();
$notify = new Notification();

if (isset($_POST['action']) && $_POST['action'] == 'fetch_leave') {

	$fetchactiveLeaves = $leave->fetchActiveLeaves();
	if ($fetchactiveLeaves) {
		echo $fetchactiveLeaves;
	}

}

if (isset($_POST['admin_id'])) {
	$admin_id = (int)$_POST['admin_id'];

	$get = $general->getAdminDetail($admin_id);
	if ($get) {
		echo $get;
	}
}


// FEtch notification ajax
if (isset($_POST['action']) && $_POST['action'] == 'fetchNotifaction') {

  $notifaction = $notify->fetchNotifactionAdmin();
  $output = '';
  if ($notifaction){
    foreach ($notifaction as $noti) {
      $user = new User($noti->user_id);
      $output .= '
      <div class="col-lg-4 align-self-center">
      <div class="alert alert-info" role="alert">
        <button type="button" id="'.$noti->id.'" name="button" class="close" data-dismiss="alert" aria-label="Close">
        <span arid-hidden="true">&times;</span>
      </button>
      <h4 class="alert-heading">New Notification</h4>
      <p class="mb-0 ">
        '.$user->data()->full_name.'->  '.nl2br($noti->message).'
      </p>
      <a href="sudo-feedback">Go to Feedback page</a>
      <hr class="my-2">
      <p class="mb-0 float-left">Staff -> '.$user->data()->full_name.'</p>
      <p class="mb-0 float-right"><i class="lead">'.timeAgo($noti->dateCreated).'</i></p>
      <div class="clearfix"> </div>
    </div>
    </div>
      ';
    }
    echo $output;
  }else{
    echo '<h4 class="text-center text-info mt-5">No New Notifications</h4>';
  }



  }

if (isset($_POST['action']) && $_POST['action'] == 'getNotify') {
    if ($notify->fetchNotifactionAdmin()) {
      $count =  $notify->fetchNotifactionCountAdmin();
      echo '<span class="badge badge-pill badge-danger">'.$count.'</span>';
    }else{
        $count =  $notify->fetchNotifactionCountAdmin();
    echo '<span class="badge badge-pill badge-danger">'.$count.'</span>';
    }
}

