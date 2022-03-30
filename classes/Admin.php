<?php

/**
 * Admin class
 */

class Admin
{
		private $_db,
				$_data,
				$_sessionName,
				$_cookieName,
				$_isLoggedInAdmin;

	function __construct($admin = null)
	{
		$this->_db =  Database::getInstance();
		$this->_sessionName = Config::get('session/session_admin');
		$this->_cookieName = Config::get('remember/cookie_name');


		if (!$admin) {
			if (Session::exists($this->_sessionName)) {
				$admin = Session::get($this->_sessionName);
				if ($this->findAdmin($admin)) {
					$this->_isLoggedInAdmin = true;
				}

			}
		}else{
			$this->findAdmin($admin);
		}

	}

public function isLoggedInAdmin()
{
	return $this->_isLoggedInAdmin;
}


public function findAdmin($admin = null)
{
	if ($admin) {

	$field = (is_numeric($admin))? 'id' : 'sudo_username';
	$data = $this->_db->get('superusers', array($field, '=', $admin));
	if ($data->count()) {
		$this->_data = $data->first();
		return true;
	}
}
return false;
}

public function login($supername = null, $password = null)
{
	$admin = $this->findAdmin($supername);
	if ($admin) {
		$adminPassword = $this->data()->sudo_password;
		$adminEamil = $this->data()->sudo_email;
		$adminId = $this->data()->id;
		$fullname = $this->getAdminFullname();
		if (password_verify($password, $adminPassword)) {


   //      $rndno=rand(100000, 999999);//OTP generate
   //      $token = "OTP NUMBER: "."<h2>".$rndno."</h2>";

   //  $mail =  new PHPMailer(true);

  	// try{

   //             // //SMTP settings
   //             // $mail->isSMTP();
   //             // $mail->Host = "mail.web.com.ng";
   //             // $mail->SMTPAuth = true;
   //             // $mail->Username = "youremail";
   //             // $mail->Password =  "yourpassword";
   //             // $mail->SMTPSecure = "ssl";
   //             // $mail->Port = 465; //587 for tls
  	// 		  $mail->isSMTP();
   //            $mail->Host = "smtp.gmail.com";
   //            $mail->SMTPAuth = true;
   //            $mail->Username = "youremail";
   //            $mail->Password =  "yourpassword";
   //            $mail->SMTPSecure = "tls";
   //            $mail->Port = 587; // for tls

   //             //email settings
   //             $mail->isHTML(true);
   //             $mail->setFrom("youremail", "Library Offence Doc.");
   //             $mail->addAddress($this->data()->sudo_email);
   //             // $mail->addReplyTo("youremail", "Library Offence Doc.");
   //             $mail->Subject = 'Device Verification';
   //             $mail->Body = "
   //          <div style='width:80%; height:auto; padding:10px; margin:10px'>

   //      <p style='color: #fff; font-size: 20px; text-align: center; text-transform: uppercase;margin-top:0px'>One Time Password Verification<br></p>
   //      <p>Hey $fullname! <br><br>

   //      A sign in attempt requires further verification because we did not recognize your device. To complete the sign in, enter the verification code on the unrecognized device.

   //     <br><hr>
   //      $token <br><hr>

   //      If you did not attempt to sign in to your account, your password may be compromised. Visit https://localhost/libraryoffencedoc/lod_Admin/admin-login to create a new, strong password for your Library Offence Doc account.</p>
   //              <hr>

   //     </div>
   //      ";
   //      if($mail->send())
   //     	$email =  $this->data()->sudo_email;
   //       $sql = "INSERT INTO verifyAdmin (sudo_email, token) VALUES ('$email','$rndno')";
   //        $this->_db->query($sql);

   //       Session::put($this->_sessionName, $this->data()->id);
   //       $sql = "UPDATE superusers SET sudo_lastLogin = NOW() WHERE sudo_email = '$email' ";
   //        $this->_db->query($sql);

   //       return true;

   //      } catch (\Exception $e) {
   //      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
   //      }

    	 Session::put($this->_sessionName, $this->data()->id);
    	  $sql = "UPDATE superusers SET sudo_lastLogin = NOW() WHERE sudo_email = '$adminEamil' ";
          $this->_db->query($sql);
		return true;
	}else{
			echo 'Incorrect Password Retype!';
			return false;
		}


	}else{
		echo 'User not found!';
		return false;
	}
}


public function logout()
{
	Session::delete($this->_sessionName);

}

public function data()
{
	return $this->_data;
}

public function getAdminEmail()
{
	return $this->data()->sudo_email;
}
public function getAdminId()
{
 	return $this->data()->id;
}
public function getAdminFullname()
{
	return $this->data()->sudo_full_name;
}
public function getAdminPhoneNo()
{
 	return $this->data()->sudo_phoneNo;
}
public function getAdminPermission()
{
 	return $this->data()->sudo_permission;
}

public function create($field = array())
{
	if (!$this->_db->insert('superusers',$field)) {
		throw new Exception("Error Processing Request", 1);

	}
}


public function findEmail($email)
{
	$check = $this->_db->get('superusers', array('sudo_email', '=', $email));
	if ($check->count()) {
		return $check->first();
	}else{
		return false;
	}

}

public function findPhone($phoneNo)
{
	$check = $this->_db->get('superusers', array('sudo_phoneNo', '=', $phoneNo));
	if ($check->count()) {
	 return $check->first();
	}else{
		return false;
	}

}

public function findFileNo($fileNo)
{
	$check = $this->_db->get('superusers', array('sudo_fileNo', '=', $fileNo));
	if ($check->count()) {
		return $check->first();
	}else{
		return false;
	}

}

public function updateAdmin($username, $email)
{
	// $this->_db->update('superusers', 'sudo_email', $email, array(
	// 	'sudo_username' => $username
	// ));

	$sql = "UPDATE superusers SET sudo_username = '$username' WHERE sudo_email = '$email' ";
	$this->_db->query($sql);
	return true;
}

public function insertProfile($adminId)
{
	$this->_db->insert('super_profile', array(
		'sudo_id' => $adminId,
		'status' => '1'
	));
	return true;
}

public function adminGetSignatures($adminid)
{
	$data = $this->_db->get('adminSignatures', array('admin_id', '=', $adminid));
	if ($data->count()) {
		$row = $data->first();
		return $row;
	}else{
		return false;
	}
}

public function getPassword($adminid){
	$data = $this->_db->get('superusers', array('id','=',$adminid));
	if ($data->count()) {
		return $data->first()->sudo_password;
	}else{
		return false;
	}
}

public function change_password($hashNewPass, $id)
{
	$this->_db->update('superusers', 'id', $id, array(
    	'sudo_password' => $hashNewPass,

    ));

    return true;


}

}//end of class
