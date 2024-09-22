<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

class ControlRegister extends ViewDataReadCross
{


    private $fname;
    private $lname;
    private $uname;
    private $email;
    private $password;
    private $confirmPassword;



    public function __construct($fname, $lname, $uname, $email, $password, $confirmPassword)
    {
        $this->fname = $fname;
        $this->lname = $lname;
        $this->uname = $uname;
        $this->email = $email;
        $this->password = $password;
        $this->confirmPassword = $confirmPassword;
    }

    public function validateData()
    {
        $this->checkEmpty();
        $this->checkRegex();
        $this->validatePassword();
        $this->validateUser($this->uname, $this->email);
        $this->sendEmailOTP();

        header('location: ../VerifyOTP.php');
    }


    private function checkEmpty()
    {
        if (empty($this->fname)) {
            header('location: ../Register.php?empty=fname');
            exit();
        }
        if (empty($this->lname)) {
            header('location: ../Register.php?empty=lname');
            exit();
        }
        if (empty($this->uname)) {
            header('location: ../Register.php?empty=uname');
            exit();
        }
        if (empty($this->email)) {
            header('location: ../Register.php?empty=email');
            exit();
        }
        if (empty($this->password)) {
            header('location: ../Register.php?empty=password');
            exit();
        }
        if (empty($this->confirmPassword)) {
            header('location: ../Register.php?empty=password');
            exit();
        }
    }

    private function checkRegex()
    {
        if (!preg_match('/^[a-zA-Z]+$/', $this->fname)) {
            header('location: ../Register.php?regex=fname');
            exit();
        }
        if (!preg_match('/^[a-zA-Z]+$/', $this->lname)) {
            header('location: ../Register.php?regex=lname');
            exit();
        }
        if (!preg_match('/^[a-zA-Z]+$/', $this->uname)) {
            header('location: ../Register.php?regex=uname');
            exit();
        }
        if (!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $this->email)) {
            header('location: ../Register.php?regex=email');
            exit();
        }
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $this->password)) {
            header('location: ../Register.php?regex=password');
            exit();
        }
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $this->password)) {
            header('location: ../Register.php?regex=password');
            exit();
        }
    }

    private function validatePassword()
    {
        if ($this->password != $this->confirmPassword) {
            header('location: ../Register.php?regex=password');
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
            $mail->addAddress($this->email, "{$this->fname} {$this->lname}");  //email & username

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'RedCross OTP';
            $mail->Body    = "<h2>Verification number</h2>
        <p>OTP: {$this->generateOTP()}</p>";

            $mail->send();
        } catch (Exception $e) {
            header('location: ../../Register.php');
        }
    }

    private function generateOTP()
    {
        $otp = rand(000000, 999999);
        session_start();
        $_SESSION['otp'] = $otp;

        $_SESSION['fname'] = $this->fname;
        $_SESSION['lname'] = $this->lname;
        $_SESSION['uname'] = $this->uname;
        $_SESSION['email'] = $this->email;
        $_SESSION['password'] = $this->password;

        return $otp;
    }
}
