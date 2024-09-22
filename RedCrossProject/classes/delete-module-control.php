<?php
class DeleteModule extends ViewDataReadCross
{

    private $module;

    public function __construct($module)
    {
        $this->module = $module;
    }

    public function moduleAttr()
    {
        $this->check();

        $this->deleteModule($this->module);

        header('location: ../admin/Module.php');
        exit();
        //
    }

    private function check()
    {

        if (empty($this->module)) {
            header('location: ../admin/Module.php');
            exit();
        }

        if (!preg_match('/^[0-9s]+$/', $this->module)) {
            header('location: ../admin/Module.php');
            exit();
        }
        //
    }
}
