<?php
// session_start();
if ((isset($_SESSION['module']) && empty($_SESSION['module'])) || $_SERVER['REQUEST_METHOD'] === 'POST') {





    if (isset($_SESSION['module']) && empty($_SESSION['module'])) {
        $module = $_SESSION['module'];
    } else {

        if (!isset($_POST['module'])) {
            header('location: Module.php');
            exit();
        }

        if (empty($_POST['module'])) {
            header('location: Module.php');
            exit();
        }

        $module = htmlspecialchars($_POST['module']);
    }

    require 'classes/model.class.php';
    require 'classes/view.class.php';

    $viewModule = new ViewDataReadCross();

    $module = $viewModule->indexModule($module);

    $moduleData = $module->fetch();


?>
    <section>
        <h1>Edit Module</h1>
        <form action="process/edit-module.php" method="post" enctype="multipart/form-data">
            <div class="form-input">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" value="<?php echo $moduleData['module_title']; ?>" required>
            </div>
            <div class="form-input">
                <label for="module">Pdf Module</label>
                <input type="file" name="module" id="module">
                <a href="../<?php echo $moduleData['module_path']; ?>" download="<?php echo $moduleData['module_title']; ?>.pdf"><?php echo $moduleData['module_title']; ?></a>
            </div>

            <input type="hidden" name="module" value="<?php echo $moduleData['module_id']; ?>">

            <div class="form-input">
                <input type="submit" value="Proceed">
            </div>
        </form>
    </section>
<?php

    //
} else {
    header('location: Module.php');
    exit();
}
