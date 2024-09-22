<?php
if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $quizID = htmlspecialchars($_POST['quiz']);
    $choiceID = htmlspecialchars($_POST['choices']);

    include '../classes/model.class.php';
    include '../classes/view.class.php';
    include '../classes/delete-quiz-control.php';

    $delete = new DeleteQuiz($quizID, $choiceID);


    $delete->qzAttr();

    //
} else {
    header('location: ../admin/AddQuiz.php');
    exit();
}
