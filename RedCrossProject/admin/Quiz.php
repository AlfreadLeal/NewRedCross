<?php
if (isset($_GET['quiz'])) {

    // if (!isset($_POST['quiz'])) {
    //     header('location: Module.php');
    //     exit();
    // }

    if (empty($_GET['quiz'])) {
        header('location: Module.php');
        exit();
    }

    $quiz = htmlspecialchars($_GET['quiz']);

    require 'classes/model.class.php';
    require 'classes/view.class.php';

    $quizList = new ViewDataReadCross();

    $quizzes = $quizList->viewQuizList($quiz);

?>
    <section>
        <h1>Questions</h1>
        <div class="content">
            <form action="AddQuiz.php" method="get">
                <button type="submit" name="quiz" value="<?php echo $quiz; ?>">Add</button>
            </form>

            <table>
                <tr>
                    <td>Question</td>
                    <td>Edit</td>
                    <td>Delte</td>
                </tr>
                <?php
                while ($quiz = $quizzes->fetch()) {
                ?>
                    <tr>
                        <td><?php echo $quiz['question'] ?></td>
                        <td>
                            <form action="EditQuiz.php" method="get">
                                <input type="hidden" name="quiz" value="<?php echo $quiz['quiz_id']; ?>">
                                <input type="hidden" name="choices" value="<?php echo $quiz['choices_id']; ?>">
                                <input type="submit" value="Edit">
                            </form>
                        </td>
                        <td>
                            <form action="process/delete-quiz.php" method="post">
                                <input type="hidden" name="quiz" value="<?php echo $quiz['quiz_id']; ?>">
                                <input type="hidden" name="choices" value="<?php echo $quiz['choices_id']; ?>">
                                <input type="submit" value="Delete">
                            </form>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
    </section>
    <?php




    while ($quiz = $quizzes->fetch()) {
        echo $quiz['question'];
    ?>


<?php
    }


    //
} else {
    header('location: Module.php');
    exit();
}
