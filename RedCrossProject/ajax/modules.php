<?php

include '../classes/model.class.php';
include '../classes/view.class.php';

$modules = new ViewDataReadCross();
$module = $modules->modules();

while ($topic = $module->fetch()) {

    $button = uniqid('button-');
    $list = uniqid('list-');
?>
    <table class="table-feed">
        <tr>

            <td class="news-feed">
                <div class="header-news-content">
                    <h1><?php echo $topic["module_title"]; ?></h1>
                </div>
                <div class="body-news-content">
                    sample data
                </div>


                <button on class="view-module <?php echo $button ?>" type="button">View Module</button>




                <div class="list-item <?php echo $list ?>">
                    list here


                    <form action="Instruction.php" method="post">
                        <button type="submit" name="quiz" value="<?php echo $topic["quiz_id"] ?>">Quiz</button>
                    </form>
                </div>
            </td>
        </tr>
    </table>
    <script>
        $(document).ready(function() {

            $('.<?php echo $button ?>').click(function() {
                $('.<?php echo $list ?>').toggle("fast");
            });

        });
    </script>
<?php
}



?>









<?php

?>