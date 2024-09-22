<?php

class ControlLogin extends ViewDataReadCross
{


    private $username;
    private $password;

    // $username, $password

    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    public function validateData()
    {
        $this->checkEmpty();
        $this->checkRegex();

        $explode = explode('.', $this->username);

        $count = count($explode);


        if ($count == 3) {

            $this->adminCredentials($this->username, $this->password);

            header('location: ../Dashboard.php');
            exit();
        } else {
            $this->calidateCredentials($this->username, $this->password);
            header('location: ../Home.php');
            exit();
        }
    }


    private function checkEmpty()
    {
        if (empty($this->username)) {
            header('location: ../RedCross.php?empty=username');
            exit();
        }
        if (empty($this->password)) {
            header('location: ../RedCross.php?empty=password');
            exit();
        }
    }

    private function checkRegex()
    {
        if (!preg_match('/^[a-zA-Z0-9.]+$/', $this->username) && !preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $this->username)) {
            header('location: ../RedCross.php?regex=uname');
            exit();
        }

        // if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $this->password)) {
        //     header('location: ../RedCross.php?regex=password');
        //     exit();
        // }
    }
}
