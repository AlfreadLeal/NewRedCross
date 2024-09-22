<?php

class OTPProcess extends ViewDataReadCross
{
    private $otp;

    public function __construct($otp)
    {
        $this->otp = $otp;
    }

    public function creatingAcc()
    {
        $this->checkEmpty();
        $this->checkRegex();
        $this->sessionCheck();
        $this->validateOTP();
        $this->creatingUserAcc();
        header('location: ../Home.php');
    }

    private function checkEmpty()
    {
        if (empty($this->otp)) {
            header('location: ../VerifyOTP.php?empty=otp');
            exit();
        }
    }

    private function checkRegex()
    {
        if (!preg_match('/^[0-9]+$/', $this->otp)) {
            header('location: ../VerifyOTP.php?regex=otp');
            exit();
        }
    }

    private function sessionCheck()
    {
        session_start();

        if (!isset($_SESSION['otp'])) {
            header('location: ../Register.php?timeout_session');
            exit();
        }

        if (!isset($_SESSION['fname'])) {
            header('location: ../Register.php?timeout_session');
            exit();
        }
        if (!isset($_SESSION['lname'])) {
            header('location: ../Register.php?timeout_session');
            exit();
        }
        if (!isset($_SESSION['uname'])) {
            header('location: ../Register.php?timeout_session');
            exit();
        }
        if (!isset($_SESSION['email'])) {
            header('location: ../Register.php?timeout_session');
            exit();
        }
        if (!isset($_SESSION['password'])) {
            header('location: ../Register.php?timeout_session');
            exit();
        }
    }

    private function validateOTP()
    {
        session_start();

        if ($this->otp != $_SESSION['otp']) {
            header('location: ../VerifyOTP.php?notmatch=otp');
            exit();
        }
    }
}
