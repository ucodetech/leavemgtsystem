<?php 
require_once '../../core/init.php';

$show = new Show();
$leave = new Leave();
$user = new User();
$user_id = $user->data()->id;
$db = Database::getInstance();
if (isset($_POST['action']) && $_POST['action'] == 'Matleave') {

	$dateProceedLeave = ((isset($_POST['dateProceedLeave']) && !empty($_POST['dateProceedLeave']))?$show->test_input($_POST['dateProceedLeave']): '');
	$dueToDeliver = ((isset($_POST['dueToDeliver']) && !empty($_POST['dueToDeliver']))?$show->test_input($_POST['dueToDeliver']): '');

	
	if (empty($_POST['dateProceedLeave'])) {
		echo $show->showMessage('danger', 'Date procceding on leave is required!', 'times');
		return false;
	}
	if (empty($_POST['dueToDeliver'])) {
		echo $show->showMessage('danger', 'Date expected for delivery is required!', 'times');
		return false;
	}
	
		//check if have made request before
		if ($leave->checkUserExistById('maternityLeave',$user_id)){
			echo $show->showMessage('danger', 'You already have maternity leave pending request!', 'times');
			return false;
		}

			if ($leave->checkUserOnLeaveId($user_id)){
				echo $show->showMessage('danger', 'You have an active leave runing!', 'times');
				return false;
		}

	
			$leave->MakeRequest('maternityLeave',array(
				'user_id' => $user_id,
				'leaveFrom' => $dateProceedLeave, 
				'dueToDeliver' => $dueToDeliver,
				'pending' => 1
				
			));
			
			$sql = "UPDATE leaveRequestCount SET countRequest = countRequest + 1 WHERE id = 0 ";
			$db->query($sql);
			echo 'success';


}