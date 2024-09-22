<?php
// session_start();
if (isset($_GET['quiz']) && isset($_GET['choices'])) {

    if (empty($_GET['quiz']) || empty($_GET['choices'])) {
        header('location: Module.php');
        exit();
    }

    $quiz = htmlspecialchars($_GET['quiz']);
    $choices = htmlspecialchars($_GET['choices']);

    require 'classes/model.class.php';
    require 'classes/view.class.php';

    $quizAttr = new ViewDataReadCross();

    $quiz = $quizAttr->indexQuiz($choices)->fetch();
    $quizAttr->indexChoice($choices);

    $choices = $quizAttr->indexChoice($choices)->fetchAll();

    $count = count($choices);

?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <section>
        <h1>Add Quiz</h1>
        <form action="process/edit-quiz.php" method="post">
            <div class="form-input">
                <input type="hidden" name="quizID" value="<?php echo $quiz['quiz_id']; ?>">
                <input type="hidden" name="choiceID" value="<?php echo $quiz['choices_id']; ?>">
                <label for="question">Question</label>
                <input type="text" name="question" id="question" value="<?php echo $quiz['question']; ?>">
            </div>

            <div class="add-choice">
                <label for="">Input choices</label>
                <input type="text" id="choice-text">

                <button type="button" id="add-choice">Add</button>
            </div>

            <table id="choices">
                <?php
                foreach ($choices as $choice => $data) {
                ?>
                    <tr>
                        <td>
                            <button type="button" class="cancel">cancel</button>
                            <div class="choice-<?php echo $choice + 1 ?>">
                                <label for="choice"><?php echo $data['answer_text'] ?></label>
                                <input type="hidden" name="data[]" value="<?php echo $data['answer_text'] ?>">
                                <input type="radio" name="right-answer" id="choice-<?php echo $choice + 1 ?>" value="<?php echo $data['answer_text'] ?>" <?php if ($data['guess'] == 1) {
                                                                                                                                                                echo 'checked';
                                                                                                                                                            } ?>>
                            </div>
                        </td>
                    </tr>
                <?php

                    //
                }
                ?>
            </table>

            <input type="submit" value="Submit  ">

        </form>
    </section>
    <script>
        $(document).ready(function() {

            var count = <?php echo $count ?>;

            $('#add-choice').click(function() {


                var text = $('#choice-text').val();

                if (text.trim()) {
                    if (count <= 4) {

                        var choicesHTML = `<tr>
                                        <td>
                                            <button type="button" class="cancel">cancel</button>
                                            <div class="choice-${count}">
                                                <label for="choice">${text}</label>
                                                <input type="hidden" name="data[]" value="${text}">
                                                <input type="radio" name="right-answer" id="choice-${count}" value="${text}">
                                            </div>
                                        </td>
                                    </tr>`;

                        $('#choices').append(choicesHTML);
                        count++;
                        $('#choice-text').val('');
                        //
                    }
                }
            });

            $('#choices').on('click', '.cancel', function() {
                $(this).closest("tr").remove();
                count--;
            });
            //
        });
    </script>
<?php

    //
} else {
    header('location: Module.php');
    exit();
}
