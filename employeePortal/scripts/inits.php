<?php 
require_once '../../core/init.php';

$show = new Show();
$leave = new Leave();
$user = new User();
$user_id = $user->data()->id;
$fileNo = $user->data()->fileNo;

if (isset($_POST['action']) && $_POST['action'] == 'showActiveServerSide') {
	$check = $leave->getUserLeaveRequestStatus('activeLeaves', $fileNo);
	if ($check) {
		echo $check;
	}
}



if (isset($_POST['actionStatus']) && !empty($_POST['actionStatus'])) {
	$action = $_POST['actionStatus'];
	if ( $action == 'Aleave') {
		$getFrom = 'annaulLeaveRequest';
		$id = $fileNo;
		$field = 'file_no';
	}elseif ($action == 'Matleave' ) {
		$getFrom = 'maternityLeave';
		$id = $user_id;
		$field = 'user_id';
	}elseif ($action == 'Sableave') {
		$getFrom = 'sabaticalLeave';
		$id = $fileNo;
		$field = 'file_no';
	}elseif ($action == 'casLeave') {
		$getFrom = 'casaulLeave';
		$id = $user_id;
		$field = 'user_id';
	}elseif ($action == 'medicLeave') {
		$getFrom = 'medicalLeave';
		$id = $user_id;
		$field = 'user_id';
	}
	// elseif ($action == 'studLeave') {
	// 	$getFrom = '';
	// }

	$check = $leave->checkLeaveStatus($getFrom,$field, $id);
	if ($check) {
		echo $check;
	}
	
}



if (isset($_POST['action']) && $_POST['action'] == 'update_emp') {
  $user->activity();

}
