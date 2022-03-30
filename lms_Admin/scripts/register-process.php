<?php
require_once '../../core/init.php';

$admin = new Admin();
$validate = new Validate();

if (isset($_POST['action']) && $_POST['action'] == 'add_admin') {

	if (Input::exists()) {

			$validation = $validate->check($_POST, array(
				'fullName' => array(
					'required' => true,
					'min' => 10,
					'max' => 255

				),
				'sudo_fileNo' => array(
					'required' => true,
					'unique' => 'superusers',
					'min' => 8,
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


					$mail =  new PHPMailer(true);

             try {
               //SMTP settings
              // $mail->SMTPDebug = 3;
              $mail->isSMTP();
              $mail->Host = "smtp.gmail.com";
              $mail->SMTPAuth = true;
              $mail->Username = "youremail";
              $mail->Password =  "yourpassword";
              $mail->SMTPSecure = "tls";
              $mail->Port = 587; // for tls
            //   $mail->SMTPDebug = 2;
               // $mail->isSMTP();
               // $mail->Host = "mail.web.com.ng";
               // $mail->SMTPAuth = true;
               // $mail->Username = "youremail";
               // $mail->Password =  "yourpassword";
               // $mail->SMTPSecure = "ssl";
               // $mail->Port = 465; // for tls

               //email settings
               $mail->isHTML(true);
               $mail->setFrom("youremail",  "LMS.");
               $mail->addAddress($email);
            //   $mail->addReplyTo("youremail");
               $mail->Subject = "Welcome to LMS. Admin";
               $mail->Body = "
            <div style='width:80%; height:auto; padding:10px; margin:10px'>

           <p style='color: #000; font-size: 20px; text-align: center; text-transform: uppercase;margin-top:0px'> Welcome Leave Management System </p>
        <p  style='color: #000; font-size: 18px; text-transform:capitalize;margin:10px;  '>Hi!&nbsp;&nbsp; $fullname<br>
            You have be granted access to the Admin Panel of Leave Management System.
        </p>
        <p style='color:red;'>Note: You are been monitored so please becareful what you do here!</p>
        <p>Here are your login details <br> <span style='color:green;'>Username: $username and Password: $password </span></p>
        <h4>You are advised to change your password immedately on your first login</h4>
        <p>
        	You are equally mandated to verify your email address by clicking the link blow: <br>
        	<a href='$url'>$url</a>
        </p>

         </div>

        ";
        $mail->send();
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
