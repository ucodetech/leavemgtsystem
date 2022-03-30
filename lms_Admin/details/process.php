<?php 

	require_once '../../core/init.php';

	$leave = new Leave();
	$admin = new Admin();
	$show = new Show();
	$db = Database::getInstance();
	// maternity

if (isset($_POST['action']) && $_POST['action'] == 'leaveIDAccpt') {
	$leavid = $_POST['leaveID'];
	$medicsignature = $_POST['medicSignature'];

	$check = "SELECT * FROM maternityLeave WHERE id = '$leavid' AND medicalOfficerSignature != 'null' ";
	$query = $db->query($check);

	if ($query->count()) {
		echo $show->showMessage('danger','You have apporved this request before!', 'warning');
		return false;
	}else{
	$do = $leave->updateLeaveMat($leavid,$medicsignature);
	if ($do) {
		echo $show->showMessage('info','Leave Approved and sent to HR for further action!', 'check');
	}else{
		echo $show->showMessage('danger','error sending request!', 'warning');
		return false;
	}
}

}

//decline
	if (isset($_POST['action']) && $_POST['action'] == 'leaveIDAccptHR') {
	$leavid = $_POST['leaveID'];

	$check = "SELECT * FROM maternityLeave WHERE id = '$leavid' AND approved != 0 ";
	$query = $db->query($check);

	if ($query->count()) {
		echo $show->showMessage('danger','You have apporved this request before!', 'warning');
		return false;
	}else{
	$do = $leave->updateLeaveMatHR($leavid);
	if ($do) {
		echo $show->showMessage('info','Leave Approved!', 'check');
	}else{
		echo $show->showMessage('danger','error sending request!', 'warning');
		return false;
	}
}

}

// annual leave
if (isset($_POST['action']) && $_POST['action'] == 'HodApprove') {
	$recommendationOfHOD = ((isset($_POST['recommendationOfHOD']) && !empty($_POST['recommendationOfHOD']))?$show->test_input($_POST['recommendationOfHOD']):'');
	$HodSignature = ((isset($_POST['HodSignature']) && !empty($_POST['HodSignature']))?$show->test_input($_POST['HodSignature']):'');
	$dateSigned = ((isset($_POST['dateSigned']) && !empty($_POST['dateSigned']))?$show->test_input($_POST['dateSigned']):'');
	$leaveIDAnnual = ((isset($_POST['leaveIDAnnual']) && !empty($_POST['leaveIDAnnual']))?$show->test_input($_POST['leaveIDAnnual']):'');


if (empty($_POST['recommendationOfHOD'])) {
	echo $show->showMessage('danger', 'Your Recommendation is required!', 'warning');
	return false;

}

if (empty($_POST['HodSignature'])) {
	echo $show->showMessage('danger', 'Your signature is required!', 'warning');
	return false;
	
}
if (empty($_POST['dateSigned'])) {
	echo $show->showMessage('danger', 'Date is required!', 'warning');
	return false;
	
}

	$leave->approveLeave('annaulLeaveRequest',$leaveIDAnnual, array(
		'recommendationOfHOD'  => $recommendationOfHOD,
		'HodSignature' => $HodSignature,
		'HodDateSigned' =>$dateSigned
	));
	
	echo $show->showMessage('success', 'Recommendation Updated!', 'check');

}



// update recommendation
if (isset($_POST['action']) && $_POST['action'] == 'HodUpdate') {
	$recommendationOfHODUpdate = ((isset($_POST['recommendationOfHODUpdate']) && !empty($_POST['recommendationOfHODUpdate']))?$show->test_input($_POST['recommendationOfHODUpdate']):'');
	$dateUpdated = ((isset($_POST['dateUpdated']) && !empty($_POST['dateUpdated']))?$show->test_input($_POST['dateUpdated']):'');
	$leaveIDAnnual = ((isset($_POST['leaveIDAnnual']) && !empty($_POST['leaveIDAnnual']))?$show->test_input($_POST['leaveIDAnnual']):'');
if (empty($_POST['recommendationOfHODUpdate'])) {
	echo $show->showMessage('danger', 'Your Recommendation is required!', 'warning');
	return false;
}
if (empty($_POST['dateUpdated'])) {
	echo $show->showMessage('danger', 'Date is required!', 'warning');
	return false;	
}

	$leave->approveLeave('annaulLeaveRequest',$leaveIDAnnual, array(
		'recommendationOfHOD'  => $recommendationOfHODUpdate,
		'HodDateSigned' =>$dateUpdated
	));
	
	echo $show->showMessage('success', 'Recommendation Updated!', 'check');
}


// personnel approve
if (isset($_POST['action']) && $_POST['action'] == 'PersonnelApprove') {

	$leaveFrom = ((isset($_POST['leaveFrom']) && !empty($_POST['leaveFrom']))?$show->test_input($_POST['leaveFrom']):'');
	$leaveTo = ((isset($_POST['leaveTo']) && !empty($_POST['leaveTo']))?$show->test_input($_POST['leaveTo']):'');
	$personel_registrarSignature = ((isset($_POST['personel_registrarSignature']) && !empty($_POST['personel_registrarSignature']))?$show->test_input($_POST['personel_registrarSignature']):'');
	$leaveIDAnnual = ((isset($_POST['leaveIDAnnual']) && !empty($_POST['leaveIDAnnual']))?$show->test_input($_POST['leaveIDAnnual']):'');
	$empFileNo = ((isset($_POST['empFileNo']) && !empty($_POST['empFileNo']))?$show->test_input($_POST['empFileNo']):'');
	$empId = ((isset($_POST['empId']) && !empty($_POST['empId']))?$show->test_input($_POST['empId']):'');


if (empty($_POST['leaveFrom'])) {
	echo $show->showMessage('danger', 'Leave Approved From is required!', 'warning');
	return false;

}

if (empty($_POST['leaveTo'])) {
	echo $show->showMessage('danger', 'Leave to is required', 'warning');
	return false;
	
}
if (empty($_POST['personel_registrarSignature'])) {
	echo $show->showMessage('danger', 'Signature is required!', 'warning');
	return false;
	
}
	$date = date('Y-m-d');
		// insert into active leave 
		$typeOfLeave = 'Annual Leave';

		
	$leave->approveLeave('annaulLeaveRequest',$leaveIDAnnual, array(
		'personel_approvedFrom'  => $leaveFrom,
		'personel_approvedTo' => $leaveTo,
		'personel_registrarSignature' =>$personel_registrarSignature,
		'personel_DateSignature' => $date,
		'approved' => 1,
		'pending' => 0
	));
	$leave->SendactiveLeave($typeOfLeave,$empFileNo,$empId,$leaveFrom,$leaveTo);
	echo $show->showMessage('success', 'Leave Approved!', 'check');
	

}


// personnel approve
if (isset($_POST['action']) && $_POST['action'] == 'PersonnelUpdate') {

	$leaveFromUpdate = ((isset($_POST['leaveFromUpdate']) && !empty($_POST['leaveFromUpdate']))?$show->test_input($_POST['leaveFromUpdate']):'');
	$leaveToUpdate = ((isset($_POST['leaveToUpdate']) && !empty($_POST['leaveToUpdate']))?$show->test_input($_POST['leaveToUpdate']):'');
	$leaveIDAnnual = ((isset($_POST['leaveIDAnnual']) && !empty($_POST['leaveIDAnnual']))?$show->test_input($_POST['leaveIDAnnual']):'');
	$empId = ((isset($_POST['empId']) && !empty($_POST['empId']))?$show->test_input($_POST['empId']):'');


if (empty($_POST['leaveFromUpdate'])) {
	echo $show->showMessage('danger', 'Leave Approved From is required!', 'warning');
	return false;

}

if (empty($_POST['leaveToUpdate'])) {
	echo $show->showMessage('danger', 'Leave To is required', 'warning');
	return false;
	
}

	
	$leave->approveLeave('annaulLeaveRequest',$leaveIDAnnual, array(
		'personel_approvedFrom'  => $leaveFromUpdate,
		'personel_approvedTo' => $leaveToUpdate
	));

	$update = "UPDATE activeLeaves SET dateOfProceedingOnLeave = '$leaveFromUpdate', dateReturningToDuty = '$leaveToUpdate' WHERE user_id = '$empId' ";
	$db->query($update);

	echo $show->showMessage('success', 'Leave Updated!', 'check');
	

}







