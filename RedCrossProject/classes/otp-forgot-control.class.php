<?php

class ControlOTPForgot
// extends ViewDataReadCross
{
    private $otp;

    public function __construct($otp)
    {
        $this->otp = $otp;
    }

    public function validateotp()
    {
        $this->checkEmpty();
        $this->checkRegex();
        $this->verifyOTP();


        // return 'pass';
        // $this->forgototpValidation($this->otp);
        // $this->sendotpOTP();

        header('location: ../ResetPassword.php');
    }


    private function checkEmpty()
    {
        if (empty($this->otp)) {
            header('location: ../ResetPasswordOTP.php?empty=otp');
            exit();
        }
    }

    private function checkRegex()
    {
        if (!preg_match('/^[0-9]+$/', $this->otp)) {
            header('location: ../ResetPasswordOTP.php?regex=otp');
            exit();
        }
    }

    private function verifyOTP()
    {
        if ($this->otp != $this->sessionOTP()) {
            header('location: ../ResetPasswordOTP.php?otp=notmatch');
            exit();
        }
    }

    private function sessionOTP()
    {
        session_start();

        if (!isset($_SESSION['forgototp'])) {
            header('location: ../Forgotpassword.php');
        }

        if (!isset($_SESSION['userID'])) {
            header('location: ../Forgotpassword.php');
        }

        return $_SESSION['forgototp'];
    }
}
