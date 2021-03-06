<?php
    require_once '../../core/init.php';
    $admin = new Admin();
    $show = new Show();
    $error = array();
    $admin_id = $admin->data()->id;
    $general = new General();




if (isset($_POST['sudo_email']) && !empty($_POST['sudo_email'])) {

	$sudo_email = $_POST['sudo_email'];
	$admin_id = $admin->data()->id;
	if (empty($_POST['sudo_email'])) {
		echo $show->showMessage('danger','Email Can not  be empty!', 'warning');
		return false;
	}


	if ($general->updateAdminRecored($admin_id, 'sudo_email',$sudo_email)) {
		echo 'success';
	}
}

if (isset($_POST['sudo_phoneNo']) && !empty($_POST['sudo_phoneNo'])) {

	$sudo_phoneNo = $_POST['sudo_phoneNo'];
	$admin_id = $admin->data()->id;
	if (empty($_POST['sudo_phoneNo'])) {
		echo $show->showMessage('danger','phone No Can not  be empty!', 'warning');
		return false;
	}


	if ($general->updateAdminRecored($admin_id, 'sudo_phoneNo',$sudo_phoneNo)) {
		echo 'success';
	}
}

if (isset($_POST['sudo_department']) && !empty($_POST['sudo_department'])) {

	$sudo_department = $_POST['sudo_department'];
	$admin_id = $admin->data()->id;
	if (empty($_POST['sudo_department'])) {
		echo $show->showMessage('danger','Department Can not  be empty!', 'warning');
		return false;
	}


	if ($general->updateAdminRecored($admin_id, 'sudo_department',$sudo_department)) {
		echo 'success';
	}
}

if (isset($_POST['sudo_fileNo']) && !empty($_POST['sudo_fileNo'])) {

	$sudo_fileNo = $_POST['sudo_fileNo'];
	$admin_id = $admin->data()->id;
	if (empty($_POST['sudo_fileNo'])) {
		echo $show->showMessage('danger','File No Can not  be empty!', 'warning');
		return false;
	}


	if ($general->updateAdminRecored($admin_id, 'sudo_fileNo',$sudo_fileNo)) {
		echo 'success';
	}
}

if (isset($_POST['sudo_full_name']) && !empty($_POST['sudo_full_name'])) {

	$sudo_full_name = $_POST['sudo_full_name'];
	$admin_id = $admin->data()->id;
	if (empty($_POST['sudo_full_name'])) {
		echo $show->showMessage('danger','phone No Can not  be empty!', 'warning');
		return false;
	}


	if ($general->updateAdminRecored($admin_id, 'sudo_full_name',$sudo_full_name)) {
		echo 'success';
	}
}

if (isset($_POST['sudo_permission']) && !empty($_POST['sudo_permission'])) {

	$sudo_permission = $_POST['sudo_permission'];
	$admin_id = $admin->data()->id;
	if (empty($_POST['sudo_permission'])) {
		echo $show->showMessage('danger','Permission Can not  be empty!', 'warning');
		return false;
	}


	if ($general->updateAdminRecored($admin_id, 'sudo_permission',$sudo_permission)) {
		echo 'success';
	}
}

if (isset($_POST['sudo_username']) && !empty($_POST['sudo_username'])) {

	$sudo_username = $_POST['sudo_username'];
	$admin_id = $admin->data()->id;
	if (empty($_POST['sudo_username'])) {
		echo $show->showMessage('danger','Username Can not  be empty!', 'warning');
		return false;
	}


	if ($general->updateAdminRecored($admin_id, 'sudo_username',$sudo_username)) {
		$admin->logout();
		Redirect::to('../sudo-login');
	}
}


//change Password
if (isset($_POST['action']) && $_POST['action'] == 'change_password') {
  $currentP = $show->test_input($_POST['currentPwd']);
  $newP = $show->test_input($_POST['newPwd']);
  $cnewP = $show->test_input($_POST['retypeNewPwd']);
  
  $password = $admin->getPassword($admin_id);

 if ($currentP == '') {
    echo $show->showMessage('danger', 'Current Password is required!', 'warning');
    return false;
  }

  if ($newP == '') {
    echo $show->showMessage('danger', 'New Password is required!', 'warning');
    return false;
  }else{
      if (strlen($newP) < 10) {
        echo $show->showMessage('danger', 'Password must be atleast 10 characters long!', 'warning');
        return false;
      }
  }
  if ($cnewP == '') {
    echo $show->showMessage('danger', 'Please verify new password!', 'warning');
    return false;
  }else{
    if ($cnewP != $newP) {
      echo $show->showMessage('danger', 'Password Mismatch!', 'warning');
      return false;
    }
  }

  $hashNewPass = password_hash($newP, PASSWORD_DEFAULT);
  if ($currentP == '') {
    echo $show->showMessage('danger', 'Current Password is required!', 'warning');
    return false;
  }else{
    if (!password_verify($currentP, $password)) {
      echo $show->showMessage('danger', 'Current Password is not correct!', 'warning');
      return false;
    }else{
      $admin->change_password($hashNewPass, $admin_id);
      echo $show->showMessage('success', 'Password Changed successfully!', 'check');
    }
  }
}

//verify email
if (isset($_POST['action']) && $_POST['action'] == 'verify_email') {
  $token = md5(microtime());
  $url = "http://localhost/ucodeTuts/users/verify_email.php?token=".$token;
  $userid = $user->getUserId();
  $deleteUser = $user->deleteVkey($userid);
  $updateUser = $user->updateVkey($token, $userid);
  $notify->notifi(array(
        'user_id' => $userid,
        'type' => 'Admin',
        'message' => 'Verified E-mail!'
      ));


  if ($updateUser===true) {
    try {
            $useremail  = $user->getEmail();
            $mail =  new PHPMailer\PHPMailer\PHPMailer();
               //SMTP settings
               $mail->isSMTP();
               $mail->Host = "smtp.gmail.com";
               $mail->SMTPAuth = true;
               $mail->Username = "youremail";
               $mail->Password =  "echo@mike12@@";
               $mail->Port = 587; //587 for tls
               $mail->SMTPSecure = "tls";

               //email settings
               $mail->isHTML(true);
               $mail->setFrom("youremail");
               $mail->addAddress($useremail);
               $mail->addReplyTo("youremail");
               $mail->Subject = "E-Mail verification";
               $mail->Body = "
            <div style='width:80%; height:auto; padding:10px; margin:10px'>
        <p align='center'><img src='http://localhost/ucodeTuts/images/ucodeTut%20Logo.png' class='img-fluid' width='300' alt='Ucode Logo' align='center'>  </p>
        <p style='color: #fff; font-size: 20px; text-align: center; text-transform: uppercase;margin-top:0px'>E-Mail verification</p>
        <p  style='color: #000; font-size: 18px; text-transform:capitalize;margin:10px;  '>
        Here is your E-mail verification link:<br><hr>
        <a  href='".$url."' style='margin-bottom: 0;font-weight: 400;text-align: center;white-space: nowrap;vertical-align: middle;-ms-touch-action: manipulation;touch-action: manipulation;cursor: pointer;background-image: none;border: 1px solid transparent;padding: 6px 12px;font-size: 14px;line-height: 1.42857143;border-radius: 4px;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;  color: #fff;background-color: #d9534f;border-color: #d43f3a; text-decoration: none; font-size: 20px;'>Verify Email</a>
        <hr>
        <hr>
        <h4>UcodeTuts</h4>
        <p style='color: #fff; font-size:20px; text-align: center; text-transform: uppercase;'>
        <a href='http//uzbgraphix.com.ng' style='color:#fff;'>Offical Site</a></p> </div>
        ";
        $mail->send();
        echo $show->showMessage('success', 'We have sent a verification link to you! check your mail-box', 'check');
        } catch (\Exception $e) {
        echo $show->showMessage('danger', 'Something went wrong please try again!', 'warning');
        }
      }
}
