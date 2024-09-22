<?php
class AddQuiz extends ViewDataReadCross
{

    private $quiz;

    public function __construct($quiz)
    {
        $this->quiz = $quiz;
    }

    public function attrQuiz()
    {

        $this->checkEmpty();
        $this->countChoices();

        $this->checkQuizIDExist();

        $this->addQuiz($this->quiz);

        header('location: ../AdminQuiz.php?quiz=' . $this->quiz['quizID']);
        exit();
        //
    }

    public function checkEmpty()
    {
        if (empty($this->quiz['quizID'])) {
            header('location: ../Modules.php?noquizId');
            exit();
        }

        if (empty($this->quiz['question'])) {
            header('location: ../AddQuiz.php?');
            exit();
        }

        if (empty($this->quiz['correctAnswer'])) {
            header('location: ../AddQuiz.php??');
            exit();
        }

        foreach ($this->quiz['choices'] as $choice) {
            if (empty($choice)) {
                header('location: ../AddQuiz.php???');
                exit();
            }
        }
        //
    }

    public function countChoices()
    {

        $countChoice = count($this->quiz['choices']);

        if ($countChoice <= 1) {
            header('location: ../AddQuiz.php?mustmorethanone');
            exit();
        }
        // 
    }

    public function checkQuizIDExist()
    {
        return $this->indexModuleQuiz($this->quiz['quizID']);
        //
    }
    //
}
