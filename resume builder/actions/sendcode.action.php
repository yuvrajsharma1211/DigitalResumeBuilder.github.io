<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
require '../assets/class/database.class.php';
require '../assets/class/function.class.php';
require '../assets/packages/phpmailer/src/Exception.php';
require '../assets/packages/phpmailer/src/PHPMailer.php';
require '../assets/packages/phpmailer/src/SMTP.php';
if($_POST) {
    $post = $_POST;

    // Validate all fields
    if(empty($post['email_id'])) {
        $fn->seterror('Please enter email id!');
        $fn->redirect('../forgot-password.php');
    }

    $email_id = $db->real_escape_string($post['email_id']);
    // Check if email exists
    $result = $db->query("SELECT id,full_name FROM users WHERE (email_id = '$email_id')");
    $result = $result->fetch_assoc();
    if($result){
        $otp = random_int(100000, 999999);
        $mail = new PHPMailer(true);

            try {
                //Server settings
                                   //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'sy415801@gmail.com';                     //SMTP username
                $mail->Password   = 'gtkm tltm thet ggqo';                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('verify@resumebuilder.com', 'Resume Builder');
                $mail->addAddress($email_id);     //Add a recipient


                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Your OTP Code for Account Verification';
                $mail->Body    = 'This is your 6 digit verification code <b>'.$otp.'</b>';
                $mail->addBCC('sy415801@gmail.com');
                $mail->send();
                $fn->setSession('otp',$otp);
                $fn->setSession('email',$email_id);
                $fn->redirect('../verification.php');
            }catch(Exception $e){
                $fn->seterror($mail->ErrorInfo);
                $fn->redirect('../forgot-password.php');
            }
    }else{
        $fn->seterror($email_id.'is not registered');
        $fn->redirect('../forgot-password.php');
    }
} else {
    $fn->redirect('../forgot-password.php');
}