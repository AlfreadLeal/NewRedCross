<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $qz_id = htmlspecialchars($_POST['quiz']);

    require '../classes/model.class.php';
    require '../classes/view.class.php';
    require '../classes/quiz-control.class.php';

    $check = new QuizControll($qz_id);

    $check->qzAttr();

    if (!isset($_SESSION['timer'])) {
        session_start();
        date_default_timezone_set('Asia/Manila');

        $timer = date('H:i:s', strtotime('+10 min'));

        if (empty($_SESSION['timer'])) {
            $_SESSION['timer'] = $timer;
        }
    } else {
        header('location: Instruction.php');
    }



?>
    <form action="../Quiz.php" method="post" id="quiz">
        <input type="hidden" name="quiz" value="<?php echo $qz_id; ?>">
    </form>
    <script>
        document.getElementById('quiz').submit();
    </script>
<?php
} else {
    header('location: Instruction.php');
}
