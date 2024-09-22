<?php
class DeleteQuiz extends ViewDataReadCross
{

    private $quizID;
    private $choiceID;

    public function __construct($quizID, $choiceID)
    {
        $this->quizID = $quizID;
        $this->choiceID = $choiceID;
    }

    public function qzAttr()
    {
        $this->check();

        $this->delQz($this->choiceID);

        header('location: ../AdminQuiz.php?quiz=' . $this->quizID);
        exit();
        //
    }

    private function check()
    {

        if (empty($this->quizID)) {
            header('location: ../Module.php');
            exit();
        }

        if (empty($this->choiceID)) {
            header('location: ../Module.php');
            exit();
        }
        //
    }
}
