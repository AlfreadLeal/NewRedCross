<?php
require 'classes/model.class.php';
require 'classes/view.class.php';

$moduleList = new ViewDataReadCross();

$modules = $moduleList->moduleList();



?>

<div class="content">
    <div class="button">
        <a href="AddModule.php">Add</a>
    </div>
    <div class="table">
        <table>
            <tr>
                <td>Module</td>
                <td>Quiz</td>
                <td>View</td>
            </tr>
            <?php
            while ($module = $modules->fetch()) {

            ?>
                <tr>
                    <td><?php echo $module['module_title'] ?></td>
                    <td>
                        <form action="AdminQuiz.php" method="get">
                            <button type="submit" name="quiz" value="<?php echo $module['quiz_id'] ?>">Quiz</button>
                        </form>
                    </td>
                    <td>
                        <form action="EditModule.php" method="post">
                            <button type="submit" name="module" value="<?php echo $module['module_id'] ?>">edit</button>
                        </form>
                        <form action="process/delete-module.php" method="post">
                            <button type="submit" name="module" value="<?php echo $module['module_id'] ?>">delete</button>
                        </form>

                    </td>
                </tr>
            <?php
            }
            ?>

        </table>
    </div>

</div>