<?php
require_once '../../core/init.php';

$general = new General();
$show = new Show();
$user = new User();


	
if (isset($_FILES['passport'])) {
	
			$userid = $user->getId();

			 $passport = '';
	         $file = $_FILES["passport"]['name'];
	         $RandomNum = rand(0, 10000);
	         $FileName = str_replace(' ','-',strtolower($_FILES['passport']['name']));
	         $FileType = $_FILES['passport']['type']; //"File/png", File/jpeg etc.
	         $FileTemp = $_FILES["passport"]["tmp_name"];
	         $FileSize = $_FILES['passport']['size'];
	         $FileExt = substr($FileName, strrpos($FileName, '.'));
	         $FileExt = str_replace('.','',$FileExt);
	         $valid = array('png', 'jpeg', 'jpg');
	         $FileName = preg_replace("/\.[^.\s]{3,4}$/", "", $FileName);
	         $NewFileName = $FileName.'-'.$RandomNum.'.'.$FileExt;
	         $output_dir = '../avaters/'.$NewFileName;//Path for file
	       
	       	if ($FileSize > 1000000) {
	      		 echo   'file size should be less than 1MB';
	       	return false;
	       	}
	        if (!in_array(strtolower($FileExt), $valid)) {
	       		  echo  'Invalid Extension';
	          return false;

	        }

	        $passport = $NewFileName;

	         // if (!is_dir($output_dir)) {
	         //   mkdir($output_dir='uploads', 755, true);
	         //
	         // }

        if (move_uploaded_file($FileTemp ,$output_dir)) 

			$update = $general->updateStudentRecored($userid, 'passport', $passport);
			if ($update) {
				echo 'success';
			}
	}
if (isset($_FILES['signature'])) {
	
			$userid = $user->getId();

			 $signature = '';
	         $file = $_FILES["signature"]['name'];
	         $RandomNum = rand(0, 10000);
	         $FileName = str_replace(' ','-',strtolower($_FILES['signature']['name']));
	         $FileType = $_FILES['signature']['type']; //"File/png", File/jpeg etc.
	         $FileTemp = $_FILES["signature"]["tmp_name"];
	         $FileSize = $_FILES['signature']['size'];
	         $FileExt = substr($FileName, strrpos($FileName, '.'));
	         $FileExt = str_replace('.','',$FileExt);
	         $valid = array('png', 'jpeg', 'jpg');
	         $FileName = preg_replace("/\.[^.\s]{3,4}$/", "", $FileName);
	         $NewFileName = $FileName.'-'.$RandomNum.'.'.$FileExt;
	         $output_dir = '../avaters/'.$NewFileName;//Path for file
	       
	       	if ($FileSize > 1000000) {
	      		 echo   'file size should be less than 1MB';
	       	return false;
	       	}
	        if (!in_array(strtolower($FileExt), $valid)) {
	       		  echo  'Invalid Extension';
	          return false;

	        }

	        $signature = $NewFileName;

	         // if (!is_dir($output_dir)) {
	         //   mkdir($output_dir='uploads', 755, true);
	         //
	         // }

        if (move_uploaded_file($FileTemp ,$output_dir)) 

			$update = $general->InsertSignature($userid,$signature);
			if ($update) {
				echo 'success';
			}
	}


if (isset($_POST['action']) && $_POST['action'] == 'update_recored') {
 
	
	
	$userid = $user->getId();
	$homeAddress = $show->test_input($_POST['homeAddress']);

if (hasPermissionLIBStudent()) {
	
	if (isset($_POST['MatricNo']) 
		&& isset($_POST['duration']) 
		&& isset($_POST['level'])
		 && !empty($_POST['level']) 
		  && !empty($_POST['MatricNo']) 
		  && !empty($_POST['duration'])) {
		
		if (empty($_POST['homeAddress'])) {
			echo 'Home dress is required!';
			return false;
		}

		$MatricNo = $show->test_input($_POST['MatricNo']);
		$duration = $show->test_input($_POST['duration']);
		$level = $show->test_input($_POST['level']);

		$MatricNo = strtoupper($MatricNo);

		$user->updateRecoreds($userid, array(
			'matric_no' => $MatricNo,
			'school_duration' => $duration,
			'level' => $level,
			'home_address' => $homeAddress,
			'updated' => 1
		));


		echo 'success';

		
	}else{
		echo 'Matric no, Level, Duration can not be empty!';
		return false;
	}
}

// staff
if (hasPermissionLIBStaff()) {

	if (isset($_POST['fileNo']) 
		&& isset($_POST['officeAddress']) 
		&& isset($_POST['position'])
		 && !empty($_POST['fileNo']) 
		  && !empty($_POST['officeAddress']) 
		  && !empty($_POST['position'])) {
		
		if (empty($_POST['homeAddress'])) {
			echo 'Home dress is required!';
			return false;
		}

		$officeAddress = $show->test_input($_POST['officeAddress']);
		$position = $show->test_input($_POST['position']);
		$fileNo = $show->test_input($_POST['fileNo']);
		$fileNo = strtoupper($fileNo);

		$user->updateRecoreds($userid, array(
			'fileNo' => $fileNo,
			'position' => $position,
			'office_address' => $officeAddress,
			'home_address' => $homeAddress,
			'updated' => 1
		));


		echo 'success';

		
	}else{
		echo 'Matric no, Level, Duration can not be empty!';
		return false;
	}

	
	}

}