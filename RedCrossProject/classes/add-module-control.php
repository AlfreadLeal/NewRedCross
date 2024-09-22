<?php
class AddModule extends ViewDataReadCross
{

    private $title;
    private     $fileTmpPath;
    private $fileName;

    public function __construct($title, $fileTmpPath, $fileName)
    {

        $this->title = $title;
        $this->fileTmpPath = $fileTmpPath;
        $this->fileName = $fileName;
    }

    public function moduleAttr()
    {
        $this->check();
        $this->checkModuleTitle($this->title);
        $this->addModule($this->title, $this->fileTmpPath, $this->fileName);

        header('location: ../AdminModule.php');
        exit();
        //
    }

    public function check()
    {

        if (empty($this->title)) {
            header('location: ../AddModule.php?error=empty');
            exit();
        }

        if (!preg_match('/^[a-zA-Z\s]+$/', $this->title)) {
            header('location: ../AddModule.php?error=notvalid');
            exit();
        }

        if (empty($this->fileTmpPath)) {
            header('location: ../AddModule.php');
            exit();
        }
        if (empty($this->fileName)) {
            header('location: ../AddModule.php');
            exit();
        }
        //
    }
}
