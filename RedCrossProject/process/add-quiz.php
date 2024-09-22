<?php
if ($_SERVER['REQUEST_METHOD'] === "POST") {

    if (!isset($_POST['data']) && !isset($_POST['question']) && !isset($_POST['right-answer'])) {
        header('location: ../admin/AddQuiz.php');
        exit();
    }

    $quizID = htmlspecialchars($_POST['quizID']);
    $question = htmlspecialchars($_POST['question']);
    $correctAnswer = htmlspecialchars($_POST['right-answer']);


    $quiz = [
        'quizID' => $quizID,
        'question' => $question,
        'correctAnswer' => $correctAnswer,
        'choices' => []
    ];

    foreach ($_POST['data'] as $choice) {

        $quiz['choices'][] = filter_var($choice, FILTER_SANITIZE_STRING);
    }

    include '../classes/model.class.php';
    include '../classes/view.class.php';
    include '../classes/add-quiz-control.php';

    $addQuiz = new AddQuiz($quiz);

    echo '<pre>';
    // var_dump($quiz);
    var_dump($addQuiz->attrQuiz());

    echo '</pre>';




    //
} else {
    header('location: ../admin/AddQuiz.php');
    exit();
}
