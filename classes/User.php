<?php
/**
 * user class
 */
class User
{
  private  $_db,
           $_employeeData,
           $_sessionName,
           $_cookieName,
           $_isLoggedIn;

public function __construct($user = null)
  {
    $this->_db = Database::getInstance();
    $this->_sessionName = Config::get('session/session_user');
    $this->_cookieName = Config::get('cookie/cookie_name');

    if (!$user) {
      if (Session::exists($this->_sessionName)) {
        $user = Session::get($this->_sessionName);

        if ($this->findUser($user)) {
          $this->_isLoggedIn = true;
        }else{
          //process logout
        }
      }
    }else{
     $getUser =  $this->findUser($user);
    }

  }

public function create($fields =  array())
{
    if (!$this->_db->insert('users', $fields)) {
      throw new Exception("Error Processing Request create account", 1);

    }
}
//find user details for login
public function findUser($user = null)
    {
      if ($user) {
       $field = (is_numeric($user)) ? 'id' : 'fileNo';
       $data = $this->_db->get('users', array($field, '=', $user));
       if ($data->count()) {
         $this->_employeeData = $data->first();
         return true;
       }
      }
      return false;
    }

//login
public function login($fileNo = null, $password = null)
{
  $user = $this->findUser($fileNo);
  if ($user) {
    if (password_verify($password, $this->data()->password)) {

   
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
    //      $mail->isSMTP();
   //            $mail->Host = "smtp.gmail.com";
   //            $mail->SMTPAuth = true;
   //            $mail->Username = "youremail";
   //            $mail->Password =  "yourpassword";
   //            $mail->SMTPSecure = "tls";
   //            $mail->Port = 587; // for tls

   //             //email settings
   //             $mail->isHTML(true);
   //             $mail->setFrom("youremail", "Library Offence Doc.");
   //             $mail->addAddress($this->data()->email);
   //             // $mail->addReplyTo("youremail", "Library Offence Doc.");
   //             $mail->Subject = 'Device Verification';
   //             $mail->Body = "
   //          <div style='width:80%; height:auto; padding:10px; margin:10px'>
      
   //      <p style='color: #fff; font-size: 20px; text-align: center; text-transform: uppercase;margin-top:0px'>One Time Password Verification<br></p>
   //      <p>Hey $fullname! <br><br>

   //      A sign in attempt requires further verification because we did not recognize your device. To complete the sign in, enter the verification code on the unrecognized device.
        
   //     <br><hr>
   //      $token <br><hr>
        
   //      If you did not attempt to sign in to your account, your password may be compromised. Visit https://localhost/libraryoffencedoc/studentPortal/forgot to create a new, strong password for your Library Offence Doc account.</p>
   //              <hr>
       
   //     </div>
   //      ";
   //      if($mail->send())
   //       $email =  $this->data()->email;
   //       $sql = "INSERT INTO otp_table (email, token) VALUES     ('$email','$rndno')";
   //        $this->_db->query($sql);
        
   //       Session::put($this->_sessionName, $this->data()->id);
             // $id = $this->data()->id;

   //       $sql = "UPDATE users SET lastLogin = NOW() WHERE id = '$id ' ";
   //        $this->_db->query($sql);

   //       return true;
        
   //      } catch (\Exception $e) {
   //      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
   //      }
    
       Session::put($this->_sessionName, $this->data()->id);
       $id = $this->data()->id;
        $sql = "UPDATE users SET lastLogin = NOW() WHERE id = '$id' ";
        $this->_db->query($sql);
      return true;
    }else{
      echo 'Password Incorrect';
      return false;
    }
  }else{
    echo 'Employee not found!';
   return false;
  }

}

//return student data
//get id
public function getEmpId()
{
  return $this->data()->id;
}

//get passport
public function getEmpPassport()
{
  return $this->data()->passport;
}
//get department
public function getEmpDepartment()
{
  return $this->data()->department;
}
//get matric no
public function getEmpFileno()
{
  return $this->data()->fileNo;
}
//get level
public function getEmpLevel()
{
  return $this->data()->level;
}

//get fullname
public function getEmpFullname()
{
  return $this->data()->full_name;
}
//get email
public function getEmpEmail()
{
  return $this->data()->email;
}
//get gender
public function getEmpGender()
{
  return $this->data()->gender;
}
//get dob
public function getEmpDob()
{
  return $this->data()->dob;
}
//get phone_number
public function getEmpPhoneno()
{
  return $this->data()->phone_number;
}
//get verified
public function getEmpVerified()
{
  return $this->data()->verified;
}


public function data()
{
  return $this->_employeeData;
}


public function isLoggedIn(){
  return $this->_isLoggedIn;
}

public function logout()
{
  Session::delete($this->_sessionName);
}

public function createVerification($fields =  array())
{
    if (!$this->_db->insert('otp_table', $fields)) {
      throw new Exception("Error Processing Request email verify", 1);

    }
}
//find email
public function findEmail($email)
{
  $data = $this->_db->get('users', array('email', '=', $email));
  if ($data->count()) {
    return $data->first();
      }else{
    return false;
  }

}

public function CheckFileNo($fileNo)
{
  $data = $this->_db->get('fileNos', array('fileNo', '=', $fileNo));
  if ($data->count()) {
    return $data->first();
      }else{
    return false;
  }

}

public function findFileNo($fileNo)
{
  $data = $this->_db->get('users', array('fileNo', '=', $fileNo));
  if ($data->count()) {
    return $data->first();
      }else{
    return false;
  }

}

public function insertProfileId($newid){
	$this->_db->insert('userprofile', array(
		'user_id' => $newid,
		'status' => 1
	));
   return true;
}
//find phone number
public function findPhone($phoneNo)
{
  $data = $this->_db->get('users', array('phone_number', '=', $phoneNo));
  if ($data->count()) {
     return $data->first();
  }else{
    return false;
  }

}
public function updateStudent($username, $email)
{
  // $this->_db->update('superusers', 'sudo_email', $email, array(
  //  'sudo_username' => $username
  // ));

  $sql = "UPDATE users SET username = '$username' WHERE email = '$email' ";
  $this->_db->query($sql);
  return true;
}


// find username
public function findUsername($username){
  $data = $this->_db->get('users', array('user_username', '=', $username));
  if ($data->count()) {
   return $data->first();
    
  }else{
    return false;
  }

}

public function updateProfile($profile, $userid)
    {
      $up = $this->_db->update('users','id', $userid, array(
        'profile_pic' => $profile
    ));
      if ($up) {
        return true;
      }else{
        return false;
      }
    }
//password reset
   // delete token
public function deleteToken($email, $field = array())
    {
      $this->_db->delete('pwdReset', array('email', '=', $email));
    }





public function updateRecoreds($user_id, $field = array())
{
	if(!$this->_db->update('users', 'id', $user_id, $field)){

    throw new Exception("Error Processing Request", 1);

    return false;
  }
}


public function update_status($uid){
	$this->_db->update('userprofile', 'user_id', $uid, array(
    	'status' => 0,
    ));

    return true;
}

public function updateStudentRecored($student_id, $field, $value)
{
	$this->_db->update('users', 'id', $student_id, array(
    	$field => $value
    	
    ));

    return true;
}

public function change_password($hashNewPass, $id)
{
	$this->_db->update('users', 'id', $id, array(
    	'password' => $hashNewPass,

    ));

    return true;


}


public function deleteVkey($id){
	if($this->_db->delete('verifyEmail', array('user_id', '=', $id))){
		  return true;

		}else{
			return false;
		}
}

public function updateVkey($token, $id){
	$this->_db->insert('verifyEmail', array(
		'token' => $token,
		'user_id' => $id
	));
	return true;

}

public function updateProfileDelete($uid){
	$this->_db->update('userprofile', 'user_id', $uid, array(
		'status' => 1
	));
  return true;
}



public function selectToken($token, $userid){

  $sql = "SELECT * FROM verifyEmail WHERE token = '$token' AND user_id = '$userid'";
 $this->_db->query($sql);
 if ($this->_db->count()) {
 	return $this->_db->first();
 }else{
 	return false;
 }
}

public function selectTokenAdmin($token){

  $sql = "SELECT * FROM verifyAdmin WHERE token = '$token'";
 $this->_db->query($sql);
 if ($this->_db->count()) {
  return $this->_db->first();
 }else{
  return false;
 }
}


public function verify_email($usid){
	$this->_db->update('users', 'id', $usid, array(
		'verified' => 1
	));
  return true;
}

public function selectSelector($selector){

  $sql = "SELECT * FROM pwdReset WHERE pwdResetSelector = '$selector' AND pwdResetExpires > NOW()";
  $this->_db->query($sql);
 if ($this->_db->count()) {
   return $this->_db->first();
 }else{
  return false;
 }
}

// public function selectUser($email){
//   $sql = "SELECT * FROM users WHERE email = ? AND deleted = 0";
//   $stmt = $this->_pdo->prepare($sql);
//   $stmt->execute([$email]);
//   $user = $stmt->fetch(PDO::FETCH_OBJ);
// return $user;
// }


public function updateUser($password,$email){
  $this->_db->update('users', 'email', $email, array(
    'password' => $password
  ));
  return true;
}

public function updateHits()
{
  $id = 0;
  $hits = $hits+1;
  $this->_db->update('visitors', 'id', $id, array(
    'hits' => $hits
  ));
  return true;

}


public function subNews($email){
  $this->_db->insert('update_subscribers', array(
    'user_email' => $email
  ));
  return true;
}


public function getUser($cu)
{
  $this->_db->get('users', array('id', '=', $cu));
  if ($this->_db->count()) {
    return $this->_db->first();
  }else{
    return false;
  }
}

public function activity(){
    $id = $this->data()->id;
    $sql = "UPDATE users SET lastLogin = NOW() WHERE id = '$id'";
    $this->_db->query($sql);
    return true;
}

public function loggedUsers(){
    $sql = "SELECT * FROM users WHERE lastLogin > DATE_SUB(NOW(), INTERVAL 5 SECOND)";
   $data = $this->_db->query($sql);
    if ($this->_db->count()) {
      return $this->_db->results();
    }else{
      return false;
    }
 }




public function getSignature($userid)
{
  $data = $this->_db->get('signatures', array('user_id', '=', $userid));
  if ($data->count()) {
    return $data->first();
  }else{
    return false;
  }
}

public function insertSignature($signature,$userid)
{
    $this->_db->insert('signatures', array(
      'user_id' => $userid,
      'empSignature' => $signature
    ));
 
    return true;
  
}


//end of class
}
