<?php

class QuizControll extends ViewDataReadCross
{

    private $qz_id;

    public function __construct($qz_id)
    {
        $this->qz_id = $qz_id;
    }

    public function qzAttr()
    {
        $this->checkQuiz();
        $this->checkEmpty();

        return null;
        //
    }

    private function checkEmpty()
    {
        if (empty($this->qz_id)) {
            header('location: Modules.php');
            exit();
        }
    }

    private function checkQuiz()
    {
        if (!$this->qzExist($this->qz_id)) {
            header('location: Modules.php');
            exit();
        }
        //
    }
    //
}
