<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once '../../core/init.php';

$admin = new Admin();
$validate = new Validate();
$mailme = new MyMail();
$userid = $admin->data()->id;

if (isset($_POST['action']) && $_POST['action'] == 'add_admin') {

	if (Input::exists()) {

			$validation = $validate->check($_POST, array(
				'fullName' => array(
					'required' => true,
					'min' => 6,
					'max' => 255

				),
				'sudo_fileNo' => array(
					'required' => true,
					'unique' => 'superusers',
					'min' => 6,
					'max' => 30
				),
				'sudo_email' => array(
					'required' => true,
					'unique' => 'superusers'

				),
				'sudo_phoneNo' => array(
					'required' => true,
					'unique' => 'superusers'

				),
				'sudo_department' => array(
					'required' => true

				),
				'password' => array(
					'required' => true,
					'min' => '10',
					'max' => '50'

				),
				'confirm_password' => array(
					'required' => true,
					'matches' => 'password'
				),
				'permission' => array(
					'required' => true,

				)



			));
		if ($validation->passed()) {

			$password_hash = password_hash(Input::get('password'), PASSWORD_DEFAULT);
			$fileno = strtoupper(Input::get('sudo_fileNo'));
		try {
			$default = 'default.png';
			$admin->create(array(
				'sudo_full_name' => Input::get('fullName'),
				'sudo_fileNo' => $fileno,
				'sudo_email' => Input::get('sudo_email'),
				'sudo_phoneNo' => Input::get('sudo_phoneNo'),
				'sudo_password' => $password_hash,
				'sudo_department' => Input::get('sudo_department'),
				'sudo_permission' => Input::get('permission'),
				'profile_pic' => $default

			));
				$randNo = rand(1000, 9999);
				$token = md5(microtime(uniqid()));
				$url =  'http://localhost/leavemgtsystem/lms_Admin/verify_email.php?token='.$token;

				$email = Input::get('sudo_email');
				$password = Input::get('password');
				$fullname = Input::get('fullName');
				
				$adminGet = $admin->findEmail($email);

				if ($adminGet) {
					$adminFullName = $adminGet->sudo_full_name;
					$adminId = $adminGet->id;

					$fname = explode(' ', $adminFullName);
					$firstname = $fname[0];

					$username = $firstname.'-'.$randNo;

					$admin->updateAdmin($username, $email);

					$mg ="
            Welcome to Leave Management System! $fullname<br>
            You have be granted access to the Admin Panel of Leave Management System.
       		Username: $username and Password: $password <br>
		        You are advised to change your password immediately on your first login<br>
		       
		        	You are equally mandated to verify your email address by clicking the link blow: <br>
		        	<a href='$url'>$url</a>
		         ";
         $messageBody = $mailme->mailTemp('Welcome to LMS Admin',$mg);
      
        // if($mailme->sendMailMine('GOU Admin',$email,'Admin Panel Access', $messageBody))

        // Load Composer's autoloader
        require APPROOT . '/vendor/autoload.php';
        $mail = new PHPMailer(true);
        //
        try {
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;       
            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->Username = "blqck48@gmail.com";
            $mail->Password = "maryluv166";
            $mail->SMTPSecure = "ssl";
            $mail->Port = 465; // for tls

            //email settings
            $mail->isHTML(true);
            $mail->setFrom("blqck48@gmail.com", $fromName);
            $mail->addAddress($email);
            // $mail->addReplyTo("ucodetech.wordpress@gmail.com", "Library Offence Doc.");
            $mail->Subject = 'GOU LMS Admin Panel';
            $mail->Body = $messageBody;
            if($mail->send())
            	Database::getInstance()->query("INSERT INTO verifyAdmin (sudo_email, token) VALUES ('$email','$token') ");
               echo 'success';
        } catch (\Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
          
         

	 }

	}catch (Exception $e) {
		echo $e->getMessage();
	}




		}else{
			foreach ($validation->errors() as $error) {
			echo $error . '<br>';
			return false;
			}


		}
	}






}
