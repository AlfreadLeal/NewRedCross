<?php

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $qz_id = htmlspecialchars($_POST['quiz']);

    require 'classes/model.class.php';
    require 'classes/view.class.php';
    require 'classes/quiz-control.class.php';

    $check = new QuizControll($qz_id);

    $check->qzAttr();

?>
    <section>
        <div class="instruction">
            <h1>Instruction</h1>
            <div class="content">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. At error, id incidunt doloremque sed officiis, cumque modi laudantium enim possimus alias iure blanditiis perferendis numquam repellendus laboriosam consequuntur, totam sequi?
            </div>
        </div>

        <form action="process/quiz-session.php" method="post">
            <button type="submit" name="quiz" value="<?php echo $qz_id ?>">Start</button>
        </form>
    </section>



<?php

    //
} else {
    header('location: Modules.php');
    exit();
}
