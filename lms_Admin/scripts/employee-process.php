<?php
require_once '../../core/init.php';

$general = new General();
$show = new Show();
$employee = new User();

if (isset($_POST['action']) && $_POST['action'] == 'fetch_employees') {

	$fetchemployee = $general->fetchEmployess();
	if ($fetchemployee) {
		echo $fetchemployee;
	}

}

if (isset($_POST['employee_id'])) {
	$employee_id = (int)$_POST['employee_id'];

	$get = $general->getemployeeDetail($employee_id);
	if ($get) {
		echo $get;
	}
}

if (isset($_POST['fullName'])) {

	if (!empty($_POST['fullName'])) {
		$fullName =  $show->test_input($_POST['fullName']);
		$employee_id = (int)$_POST['employeeId'];

		$update = $general->updateemployeeRecored($employee_id, 'full_name', $fullName);
		if ($update) {
			echo 'success';
		}
	}else{
		echo  'This field should not be empty!';
		return false;
	}


}
if (isset($_POST['email'])) {

	if (!empty($_POST['email'])) {
		$email =  $show->test_input($_POST['email']);
		$employee_id = (int)$_POST['employeeId'];

		$update = $general->updateemployeeRecored($employee_id, 'email', $email);
		if ($update) {
			echo 'success';
		}
	}else{
		echo  'This field should not be empty!';
		return false;
	}


}
if (isset($_POST['fileNo'])) {

	if (!empty($_POST['fileNo'])) {
		$fileNo =  $show->test_input($_POST['fileNo']);
		$employee_id = (int)$_POST['employeeId'];

		$update = $general->updateemployeeRecored($employee_id, 'fileNo', $fileNo);
		if ($update) {
			echo 'success';
		}
	}else{
		echo  'This field should not be empty!';
		return false;
	}


}
if (isset($_POST['phoneNo'])) {

	if (!empty($_POST['phoneNo'])) {
		$phoneNo =  $show->test_input($_POST['phoneNo']);
		$employee_id = (int)$_POST['employeeId'];

		$update = $general->updateemployeeRecored($employee_id, 'phoneNo', $phoneNo);
		if ($update) {
			echo 'success';
		}
	}else{
		echo  'This field should not be empty!';
		return false;
	}


}

if (isset($_POST['department'])) {

	if (!empty($_POST['department'])) {
		$department =  $show->test_input($_POST['department']);
		$employee_id = (int)$_POST['employeeId'];

		$update = $general->updateemployeeRecored($employee_id, 'department', $department);
		if ($update) {
			echo 'success';
		}
	}else{
		echo  'This field should not be empty!';
		return false;
	}


}
