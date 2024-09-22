<?php
class EditModule extends ViewDataReadCross
{

    private $module;
    private $title;
    private $fileTmpPath;
    private $fileName;

    public function __construct($module, $title, $fileTmpPath, $fileName)
    {

        $this->module = $module;
        $this->title = $title;
        $this->fileTmpPath = $fileTmpPath;
        $this->fileName = $fileName;
    }

    public function moduleAttr()
    {
        $this->check();
        // $this->checkModuleTitle($this->title);
        $this->updateModule($this->module, $this->title, $this->fileTmpPath, $this->fileName);

        header('location: ../AdminModule.php');
        exit();
        //
    }

    public function check()
    {
        session_start();
        $_SESSION['module'] = $this->module;

        if (empty($this->module)) {
            header('location: ../EditModule.php?error=empty');
            exit();
        }

        if (!preg_match('/^[0-9]+$/', $this->module)) {
            header('location: ../EditModule.php?error=notvalid');
            exit();
        }


        if (empty($this->title)) {
            header('location: ../EditModule.php?error=empty');
            exit();
        }

        if (!preg_match('/^[a-zA-Z\s]+$/', $this->title)) {

            return 'X';
            header('location: ../EditModule.php?error=notvalid');
            exit();
        }
        //
    }
}
