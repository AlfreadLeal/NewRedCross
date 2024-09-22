<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<?php
if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $qz_id = htmlspecialchars($_POST['quiz']);

    // echo $qz_id;

    require 'classes/model.class.php';
    require 'classes/view.class.php';
    require 'classes/quiz-control.class.php';

    $check = new QuizControll($qz_id);

    $check->qzAttr();

    $quiz = new ViewDataReadCross();


    $questionsList = $quiz->qzList($qz_id);

    $questions = $questionsList->fetchAll();
    shuffle($questions);


    // session_start();
    date_default_timezone_set('Asia/Manila');

    //yung strtotime data from database

    echo $_SESSION['timer'];


    // $setTime = new DateTime(date('H:i:s', strtotime('+10 min')));


    // unset($_SESSION['timer']);




?>




    <div class="timer">
        time: <span id="time">10:00</span>
    </div>

    <script>
        $(document).ready(function() {
            setInterval(function() {
                $.ajax({
                    url: 'process/setTimer.php',
                    success: function(data) {
                        $('#time').html(data);
                    }
                });
            }, 100);


        });
    </script>





    <form action="process/calcResult.php" method="post" id="test">

        <?php
        $number = '1';

        foreach ($questions as $question) {

            $choicesList = $quiz->choices($question['choices_id']);
            $choices = $choicesList->fetchAll();
            shuffle($choices);
        ?>

            <div class="question-1">
                <p><?php echo $number . '. ' . $question['question']; ?></p>

                <?php
                $letter = 'A';
                foreach ($choices as $choice) {
                    $choices_id = uniqid('letter-');

                ?>
                    <div class="choices">
                        <input type="radio" name="question-<?php echo $number; ?>" id="<?php echo $choices_id; ?>" value="<?php echo $choice['ch_id'] ?>">
                        <label for="<?php echo $choices_id; ?>"><?php echo $letter . '. ' . $choice['answer_text']; ?></label>
                    </div>

                <?php
                    $letter++;
                }
                ?>


            </div>




        <?php
            $number++;
        }

        ?>

        <div class="submit">
            <input type="submit" value="Submit">
        </div>
    </form>

<?php

    //
} else {
    header('location: Modules.php');
    exit();
}
