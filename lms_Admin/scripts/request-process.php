<?php
require_once '../../core/init.php';

$leave = new Leave();
$validate = new Validate();
$show = new Show();

if (isset($_POST['action']) && $_POST['action'] == 'fetchAnnualRequest') {
	
	$annaulLeave = $leave->getAnnaulLeave();
	echo $annaulLeave;


}
if (isset($_POST['action']) && $_POST['action'] == 'fetchSabaticalRequest') {
	
	$annaulLeave = $leave->getSabaticalLeave();
	echo $annaulLeave;
}

if (isset($_POST['action']) && $_POST['action'] == 'fetchMaternityRequest') {
	
	$annaulLeave = $leave->getMaternityLeave();
	echo $annaulLeave;
}

if (isset($_POST['action']) && $_POST['action'] == 'fetchMedicalRequest') {
	
	$annaulLeave = $leave->getMedicalLeave();
	echo $annaulLeave;
}

