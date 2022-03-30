<?php
require_once '../../core/init.php';

$user = new User();
$show = new Show();
if (isset($_POST['action']) && $_POST['action'] == 'register') {

  if (Input::exists()) {

          $fullname = $show->test_input($_POST['fullname']);
          $email = $show->test_input($_POST['email']);
          $phoneNo = $show->test_input($_POST['phoneNo']);
          $gender = $show->test_input($_POST['gender']);
          $state = $show->test_input($_POST['state']);
          $department = $show->test_input($_POST['department']);
          $fileNo = $show->test_input($_POST['fileNo']);
          $typeOfEmploy = $show->test_input($_POST['typeOfEmploy']);
          $password = $show->test_input($_POST['password']);
          $confirmPassword = $show->test_input($_POST['confirmPassword']);
            $fileNo = strtoupper($fileNo);
          $requird = array('fullname','email','phoneNo','gender','state','department','typeOfEmploy','fileNo','password','confirmPassword');
          foreach ($requird as $field) {
            if (empty($_POST[$field])) {
              echo 'All Fields with Arstrisk (*) are required!';
              return false;
            }
          }//end of foreach


              if ($user->findEmail($email)) {
                echo 'Email already exists!';
                return false;
              }else{
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                  echo 'Email is invalid!';
                return false;
                }
              }
             
              if ($user->findPhone($phoneNo)) {
                echo 'Phone No. already exists!';
                return false;
              }

            if (strlen($password) < 10) {
                echo 'Password must be at least 10 character or more!';
                return false;
              }

            if ($confirmPassword != $password) {
                echo 'Password mismatch!';
                return false;
              }


          if (!$user->CheckFileNo($fileNo)) {
                echo 'File No. does\'nt exists!';
                 return false;
              }elseif($user->findFileNo($fileNo)){
                 echo 'File No already exists!';
                return false;
              }

          try {

                $passwordhash = password_hash($password, PASSWORD_DEFAULT);
                $permissioned = 'employeePerm';
                $user->create(array(

              'department'  => $department,
              'full_name'  => $fullname,
              'email'  => $email,
              'password'  => $passwordhash,
              'gender'  => $gender,
              'state'    => $state,
              'fileNo'    => $fileNo,
              'phone_number'  => $phoneNo,
              'permission'   => $permissioned,
              'passport' => 'default.png',
              'typeOfEmploy' => $typeOfEmploy
          ));
            // $randNo = rand(1000, 9999);
            // $token = md5(microtime(uniqid()));
            // $url =  'https://localhost/leavemgtsystem/employeePortal/verify_email.php?token='.$token;
            // $email = Input::get('email');
            // $userGet = $user->findEmail($email);
              
            //  if ($userGet) {

            //   $user->updateVkey($token, $userId);

            //   $mail =  new PHPMailer(true);

            //   try {
            //       //SMTP settings
            //       // $mail->SMTPDebug = 3;
            //       $mail->isSMTP();
            //       $mail->Host = "smtp.gmail.com";
            //       $mail->SMTPAuth = true;
            //       $mail->Username = "youremail";
            //       $mail->Password =  "yourpassword";
            //       $mail->SMTPSecure = "tls";
            //       $mail->Port = 587; // for tls
            //     //   $mail->SMTPDebug = 2;
            //        // $mail->isSMTP();
            //        // $mail->Host = "mail.web.com.ng";
            //        // $mail->SMTPAuth = true;
            //        // $mail->Username = "youremail";
            //        // $mail->Password =  "yourpassword";
            //        // $mail->SMTPSecure = "ssl";
            //        // $mail->Port = 465; // for tls

            //        //email settings
            //        $mail->isHTML(true);
            //        $mail->setFrom("youremail",  "Library Offence Doc.");
            //        $mail->addAddress($email);
            //     //   $mail->addReplyTo("youremail");
            //        $mail->Subject = "Welcome to Library Offence Doc. Admin";
            //        $mail->Body = "
            //     <div style='width:80%; height:auto; padding:10px; margin:10px'>

            //    <p style='color: #000; font-size: 20px; text-align: center; text-transform: uppercase;margin-top:0px'> Welcome Library Offence Doc. </p>
            // <p  style='color: #000; font-size: 18px; text-transform:capitalize;margin:10px;  '>Hi!&nbsp;&nbsp; $fullname<br>
            //     You have successfully registered to Library Offence Documentation System.
            // </p>
            // <p style='color:red;'>Note: You are been monitored so please becareful what you do here!</p>

            // <p>
            //   Your login details:<br>
            //   <span style='color:darkgreen;'>Username:->:  $username</span>
            //   <span style='color:orangered;'>Password:->:  Password you created during registration!</span>

            // </p>
            // <p>
            //   You are  mandated to verify your email address by clicking the link blow: <br>
            //   <a href='$url'>$url</a>
            // </p>

            //  </div>

            // ";
            // if($mail->send())
            // echo 'success';

                
            //   } catch (Exception $e) {
            //     echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            //   }
 
             // }
           echo 'success';


          } catch (Exception $e) {
            echo $e->getMessage();
             return false;
          }



  }//end of inputs

  
}//end of if
