<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class MyMail
{
    public function sendmail($fromName, $email, $subject, $messageBody)
    {
        $rndno = rand(10000000, 99999999);//OTP generate
        $token = "TOKEN: " . "<h2>" . $rndno . "</h2>";
        // Load Composer's autoloader
        require APPROOT . '/vendor/autoload.php';
        $mail = new PHPMailer(true);
        //
        try {
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;       
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
            $mail->Subject = $subject;
            $mail->Body = $messageBody;
            if($mail->send())
              return true;

        } catch (\Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }




public function mailTemp($subject, $body)
{
    $temp = "<div style='width:60%; height:auto; color:white; background:#1a2035; padding:5px; margin:10px auto; border-radius:20px;'>
    <center>
      <img src='https://upload.wikimedia.org/wikipedia/en/a/ab/GOUniversity_logo.jpg' alt='logo'  width='205' height='200' style='border-radius:50%;'>
    </center>
    <center>
    <h4 style='align-items-center'>Subject: $subject</h4>
    </center>
    <p style='background:#fff; color:#1a2035; padding:23px; line-height:30px;'>
      $body
    </p>
    
    <hr style='height:5px; border-radius: 50px; background:orangered'>
    <p style='font-size:15px; text-align: center; text-transform: uppercase; margin-top:10px;'>
    Copy Right &copy: All right reserved 2022 <a href='https//gtechno.com' style='color:#fff;'>gtechno.com</a></p>
    </div>
    ";
    return $temp;
}






}