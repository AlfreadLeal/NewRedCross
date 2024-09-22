<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';


class ControlForgot extends ViewDataReadCross
{
    private $email;

    public function __construct($email)
    {
        $this->email = $email;
    }

    public function validateEmail()
    {
        $this->checkEmpty();
        $this->checkRegex();
        $this->forgotEmailValidation($this->email);
        $this->sendEmailOTP();

        header('location: ../ResetPasswordOTP.php');
    }


    private function checkEmpty()
    {
        if (empty($this->email)) {
            header('location: ../VerifyOTP.php?empty=email');
            exit();
        }
    }

    private function checkRegex()
    {
        if (!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $this->email)) {
            header('location: ../VerifyOTP.php?regex=email');
            exit();
        }
    }

    private function sendEmailOTP()
    {
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server 
            $mail->SMTPAuth   = true;                                   //Enable SMTP 
            $mail->Username   = 'jamesdkashura@gmail.com';                     //SMTP 
            $mail->Password   = 'ehxm rwrp kjmi nkwf';                               //SMTP 
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit 
            $mail->Port       = 465;                                    //TCP port to 

            //Recipients
            $mail->setFrom('jamesdkashura@gmail.com', 'RedCross');
            $mail->addAddress($this->email, "Reset password");  //email & username

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'RedCross OTP';
            $mail->Body    = "<h2>Verification number</h2>
            <p>OTP: {$this->generateOTP()}</p>";

            $mail->send();
        } catch (Exception $e) {
            header('location: ../../VerifyOTP.php');
        }
    }

    private function generateOTP()
    {
        $otp = rand(000000, 999999);
        session_start();
        $_SESSION['forgototp'] = $otp;

        return $otp;
    }
}
