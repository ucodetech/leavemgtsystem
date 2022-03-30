<?php 
require_once '../../core/init.php';

$show = new Show();
$leave = new Leave();
$user = new User();
$user_id = $user->data()->id;
$db = Database::getInstance();
if (isset($_POST['action']) && $_POST['action'] == 'Sableave') {

	$fullname = ((isset($_POST['fullname']) && !empty($_POST['fullname']))?$show->test_input($_POST['fullname']): '');
	$fileNo = ((isset($_POST['fileNo']) && !empty($_POST['fileNo']))?$show->test_input($_POST['fileNo']): '');
	$department = ((isset($_POST['department']) && !empty($_POST['department']))?$show->test_input($_POST['department']): '');
	$typeOfEmploy = ((isset($_POST['typeOfEmploy']) && !empty($_POST['typeOfEmploy']))?$show->test_input($_POST['typeOfEmploy']): '');
	$phoneNo = ((isset($_POST['phoneNo']) && !empty($_POST['phoneNo']))?$show->test_input($_POST['phoneNo']): '');
	$signature = ((isset($_POST['signature']) && !empty($_POST['signature']))?$show->test_input($_POST['signature']): '');
	$salaryGradeLevel = ((isset($_POST['salaryGradeLevel']) && !empty($_POST['salaryGradeLevel']))?$show->test_input($_POST['salaryGradeLevel']): '');
	$rank = ((isset($_POST['rank']) && !empty($_POST['rank']))?$show->test_input($_POST['rank']): '');
	$dateProceedLeave = ((isset($_POST['dateProceedLeave']) && !empty($_POST['dateProceedLeave']))?$show->test_input($_POST['dateProceedLeave']): '');
	$dateReturningLeave = ((isset($_POST['dateReturningLeave']) && !empty($_POST['dateReturningLeave']))?$show->test_input($_POST['dateReturningLeave']): '');
	$address = ((isset($_POST['address']) && !empty($_POST['address']))?$show->test_input($_POST['address']): '');
	$expirationDate = ((isset($_POST['expirationDate']) && !empty($_POST['expirationDate']))?$show->test_input($_POST['expirationDate']): '');
	$organisation = ((isset($_POST['organisation']) && !empty($_POST['organisation']))?$show->test_input($_POST['organisation']): '');

	if (empty($_POST['fullname'])) {
		echo $show->showMessage('danger', 'Fullname is required!', 'warning');
		return false;
	}

	if (empty($_POST['fileNo'])) {
		echo $show->showMessage('danger', 'File No is required!', 'warning');
		return false;
	}
	if (empty($_POST['department'])) {
		echo $show->showMessage('danger', 'Department is required!', 'warning');
		return false;
	}
	if (empty($_POST['typeOfEmploy'])) {
		echo $show->showMessage('danger', 'Type of Employment is required!', 'warning');
		return false;
	}
	if (empty($_POST['phoneNo'])) {
		echo $show->showMessage('danger', 'Phone No is required!', 'warning');
		return false;
	}
	if (empty($_POST['signature'])) {
		echo $show->showMessage('danger', 'Signature is required!', 'warning');
		return false;
	}
	if (empty($_POST['salaryGradeLevel'])) {
		echo $show->showMessage('danger', 'Salary grade level is required!', 'warning');
		return false;
	}
	if (empty($_POST['rank'])) {
		echo $show->showMessage('danger', 'Rank is required!', 'warning');
		return false;
	}
	
	if (empty($_POST['dateProceedLeave'])) {
		echo $show->showMessage('danger', 'Date procceding on leave is required!', 'warning');
		return false;
	}
	if (empty($_POST['dateReturningLeave'])) {
		echo $show->showMessage('danger', 'Date returning  is required!', 'warning');
		return false;
	}
	if (empty($_POST['address'])) {
		echo $show->showMessage('danger', 'Address while on leave is required!', 'warning');
		return false;
	}
	if (empty($_POST['expirationDate'])) {
		echo $show->showMessage('danger', 'Expiration date  is required!', 'warning');
		return false;
	}
	if (empty($_POST['organisation'])) {
		echo $show->showMessage('danger', 'Orginisation  is required!', 'warning');
		return false;
	}


		//check if have made request before
		if ($leave->checkUserExist('sabaticalLeave',$fileNo)){
			echo $show->showMessage('danger', 'You already have  Leave pending request!', 'warning');
			return false;
		}

			if ($leave->checkUserOnLeave($fileNo)){
				echo $show->showMessage('danger', 'You have an active leave runing!', 'warning');
				return false;
		}

	
			$fileno = strtoupper($fileNo);
			$leave->MakeRequest('sabaticalLeave',array(
				'full_name' => $fullname,
				'file_no' => $fileno, 
				'department' => $department, 	
				'grade_level' => $salaryGradeLevel,
				'rank' => $rank,	
				'typeOfEmployment' => $typeOfEmploy, 	
				'dateOfProceedingOnLeave' => $dateProceedLeave, 	
				'dateReturningToDuty' => $dateReturningLeave, 	
				'phoneNo' => $phoneNo,
				'signatureOfBeneficiary' => $signature,
				'address' => $address,
				'expirationDate' => $expirationDate,
				'organisation' => $organisation,
				'pending' => 1

			));
			$sql = "UPDATE leaveRequestCount SET countRequest = countRequest + 1 WHERE id = 0 ";
			$db->query($sql);
			echo 'success';

}
