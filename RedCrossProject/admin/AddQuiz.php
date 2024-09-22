<?php
if (!isset($_GET['quiz'])) {
    header('location: Module.php');
    exit();
}

if (empty($_GET['quiz'])) {
    header('location: Module.php');
    exit();
}

$quiz = htmlspecialchars($_GET['quiz']);
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<section>
    <h1>Add Quiz</h1>
    <form action="process/add-quiz.php" method="post">
        <div class="form-input">
            <input type="hidden" name="quizID" value="<?php echo $quiz; ?>">
            <label for="question">Question</label>
            <input type="text" name="question" id="question">
        </div>

        <div class="add-choice">
            <label for="">Input choices</label>
            <input type="text" id="choice-text">

            <button type="button" id="add-choice">Add</button>
        </div>

        <table id="choices">
        </table>

        <input type="submit" value="Submit  ">

    </form>
</section>
<script>
    $(document).ready(function() {

        var count = 1;

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