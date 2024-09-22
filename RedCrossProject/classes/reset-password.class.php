<?php
class ControlResetPassword extends ViewDataReadCross
{
    private $newPassword;
    private $confirmPassword;

    public function __construct($newPassword, $confirmPassword)
    {
        $this->newPassword = $newPassword;
        $this->confirmPassword = $confirmPassword;
    }

    public function resetAttr()
    {
        $this->checkEmpty();
        $this->checkRegex();
        $this->validatePassword();
        $this->resetUserPassword($this->newPassword);

        session_unset();

        header('location: ../RedCross.php');
    }

    private function checkEmpty()
    {
        if (empty($this->newPassword)) {
            header('location: ../ResetPassword.php?empty=newPassword');
            exit();
        }
        if (empty($this->confirmPassword)) {
            header('location: ../ResetPassword.php?empty=confirmPassword');
            exit();
        }
    }

    private function checkRegex()
    {
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $this->newPassword)) {
            header('location: ../ResetPassword.php?regex=newpassword');
            exit();
        }
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $this->confirmPassword)) {
            header('location: ../ResetPassword.php?regex=confirmPassword');
            exit();
        }
    }

    private function validatePassword()
    {
        if ($this->newPassword != $this->confirmPassword) {
            header('location: ../ResetPassword.php?notmatch=password');
            exit();
        }
    }
}
