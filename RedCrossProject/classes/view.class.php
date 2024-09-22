<?php

class ViewDataReadCross extends Dbh
{
    protected function validateUser($username, $email)
    {
        $stmt1 = $this->connect()->prepare('SELECT username FROM user_db WHERE (username = :username)');

        $stmt1->bindParam(':username', $username);

        if (!$stmt1->execute()) {
            header('location: ../Register.php');
            exit();
        }

        if ($stmt1->rowCount() != 0) {
            header('location: ../Register.php?exist=username');
            exit();
        }

        $stmt2 = $this->connect()->prepare('SELECT email FROM user_db WHERE (email = :email)');

        $stmt2->bindParam(':email', $email);

        if (!$stmt2->execute()) {
            header('location: ../Register.php');
            exit();
        }

        if ($stmt2->rowCount() != 0) {
            header('location: ../Register.php?exist=email');
            exit();
        }
    }



    protected function creatingUserAcc()
    {
        session_start();

        $stmt = $this->connect()->prepare('INSERT INTO user_db( `firstname`, `lastname`, `username`, `email`, `password`) VALUES (:firstname, :lastname, :username, :email, :password)');

        $passwordHash = password_hash($_SESSION['password'], PASSWORD_DEFAULT);

        $stmt->bindParam(':firstname', $_SESSION['fname']);
        $stmt->bindParam(':lastname', $_SESSION['lname']);
        $stmt->bindParam(':username', $_SESSION['uname']);
        $stmt->bindParam(':email', $_SESSION['email']);
        $stmt->bindParam(':password', $passwordHash);

        if (!$stmt->execute()) {
            header('location: ../Register.php');
            exit();
        }

        $id = $this->connect()->prepare('SELECT user_id FROM user_db WHERE (username = :username) AND (email = :email)');

        $id->bindParam(':username', $_SESSION['uname']);
        $id->bindParam(':email', $_SESSION['email']);

        if (!$id->execute()) {
            header('location: ../RedCross.php');
            exit();
        }

        if (!$userID = $id->fetch()) {
            header('location: ../RedCross.php');
            exit();
        }
        $_SESSION['user_id'] = $userID['user_id'];
    }


    protected function calidateCredentials($username, $password)
    {
        $stmt = $this->connect()->prepare('SELECT username, email, password FROM user_db WHERE (username = :username) OR (email = :email)');

        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $username);

        if (!$stmt->execute()) {
            header('location: ../RedCross.php');
            exit();
        }

        if ($stmt->rowCount() <= 0) {
            header('location: ../RedCross.php?error=credentials');
            exit();
        }

        $userData = $stmt->fetch();

        $passwordHash = $userData['password'];
        $userEmail = $userData['email'];

        if (!password_verify($password, $passwordHash)) {
            header('location: ../RedCross.php?error=credentials');
            exit();
        }

        $session = $this->connect()->prepare('SELECT * FROM user_db WHERE (email = :email) AND (password = :password)');

        $session->bindParam(':email', $userEmail);
        $session->bindParam(':password', $passwordHash);

        if (!$session->execute()) {
            header('location: ../RedCross.php');
            exit();
        }

        $userInfo = $session->fetch();

        session_start();

        $_SESSION['user_id'] = $userInfo['user_id'];
        $_SESSION['firstname'] = $userInfo['firstname'];
        $_SESSION['lastname'] = $userInfo['lastname'];
        $_SESSION['username'] = $userInfo['username'];
        $_SESSION['email'] = $userInfo['email'];
    }

    protected function adminCredentials($username, $password)
    {
        $stmt = $this->connect()->prepare('SELECT username, password FROM admin_db WHERE (username = :username)');

        $stmt->bindParam(':username', $username);

        if (!$stmt->execute()) {
            header('location: ../RedCross.php');
            exit();
        }

        if ($stmt->rowCount() == 0) {
            header('location: ../RedCross.php?error=credentials');
            exit();
        }

        $adminData = $stmt->fetch();

        $passwordHash = $adminData['password'];
        $username = $adminData['username'];

        if (!password_verify($password, $passwordHash)) {
            header('location: ../RedCross.php?error=credentials');
            exit();
        }

        $session = $this->connect()->prepare('SELECT * FROM admin_db WHERE (username = :username) AND (password = :password)');

        $session->bindParam(':username', $username);
        $session->bindParam(':password', $passwordHash);

        if (!$session->execute()) {
            header('location: ../RedCross.php');
            exit();
        }

        $adminInfo = $session->fetch();

        session_start();

        $_SESSION['admin_id'] = $adminInfo['admin_id'];
        $_SESSION['username'] = $adminInfo['username'];
    }

    protected function forgotEmailValidation($email)
    {
        $stmt = $this->connect()->prepare('SELECT user_id FROM user_db WHERE email = :email');

        $stmt->bindParam(':email', $email);

        if (!$stmt->execute()) {
            header('location: ../Forgotpassword.php');
            exit();
        }

        if ($stmt->rowCount() != 1) {
            header('location: ../Forgotpassword.php?email=notexist');
            exit();
        }

        $userID = $stmt->fetch();

        session_start();

        $_SESSION['userID'] = $userID['user_id'];

        return null;
    }

    protected function resetUserPassword($newPassword)
    {
        session_start();

        $passwordHash = password_hash($newPassword, PASSWORD_DEFAULT);

        $stmt = $this->connect()->prepare('UPDATE user_db SET password = :password WHERE user_id = :user_id');

        $stmt->bindParam(':user_id', $_SESSION['userID']);
        $stmt->bindParam(':password', $passwordHash);

        if (!$stmt->execute()) {
            header('location: ../Forgotpassword.php');
            exit();
        }
    }

    public function modules()
    {

        $stmt = $this->connect()->prepare('SELECT * FROM module');

        $stmt->execute();

        return $stmt;

        //
    }

    protected function qzExist($qz_id)
    {
        $stmt = $this->connect()->prepare('SELECT * FROM quiz_table WHERE quiz_id = :quiz_id');

        $stmt->bindParam(':quiz_id', $qz_id);

        if (!$stmt->execute()) {
            header('location: Modules.php');
            exit();
        }

        if (!$stmt->rowCount() == 1) {
            header('location: Modules.php');
            exit();
        }

        return true;
    }

    public function qzList($qz_id)
    {

        $stmt = $this->connect()->prepare('SELECT * FROM quiz_table WHERE quiz_id = :quiz_id');

        $stmt->bindParam(':quiz_id', $qz_id);

        if (!$stmt->execute()) {
            header('location: Modules.php');
            exit();
        }

        return $stmt;
        //
    }

    public function choices($ch_id)
    {
        $stmt = $this->connect()->prepare('SELECT * FROM choices_table WHERE choices_id = :choices_id');

        $stmt->bindParam(':choices_id', $ch_id);

        if (!$stmt->execute()) {
            header('location: Modules.php');
            exit();
        }

        return $stmt;
        //
    }







    // public function addTopic()
    // {
    //     $stmt = $this->connect()->prepare('ALTER TABLE user_db ADD COLUMN quiz_one_score varchar(100) DEFAULT 0');

    //     // $stmt = $this->connect()->prepare('ALTER TABLE user_db DROP COLUMN quiz_one_score');

    //     $stmt->execute();

    //     return 'pass';
    //     //
    // }








    public function moduleList()
    {
        $stmt = $this->connect()->prepare('SELECT * FROM module');

        $stmt->execute();

        return $stmt;
    }

    protected function checkModuleTitle($title)
    {
        $stmt = $this->connect()->prepare('SELECT * FROM module WHERE module_title = :module_title');

        $stmt->bindParam(':module_title', $title);

        if (!$stmt->execute()) {
            header('location: ../admin/AddModule.php');
            exit();
        }

        if ($stmt->rowCount() >= 1) {
            header('location: ../admin/AddModule.php?error=duplicateTitle');
            exit();
        }

        return null;
    }

    protected function addModule($title, $fileTmpPath, $fileName)
    {
        $fileTmpPath = $_FILES['module']['tmp_name'];
        $fileName = $_FILES['module']['name'];

        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Allowed file extensions
        $allowedfileExtensions = array('pdf');

        if (!in_array($fileExtension, $allowedfileExtensions)) {
            header('location: ../admin/AddModule.php?notpdf');
            exit();
        }

        $uniqid = uniqid($title . '-');

        $destination = "../modulefile/" . $uniqid . '.' . $fileExtension;

        $module_path = "modulefile/" . $uniqid . '.' . $fileExtension;

        $qz_id = uniqid('quiz_');
        $colName = uniqid('rc_');



        move_uploaded_file($fileTmpPath, $destination);
        $stmt = $this->connect()->prepare('INSERT INTO module( `module_title`, `module_path`, `quiz_id`, `col_name_score`) VALUES( :module_title, :module_path, :quiz_id, :col_name_score)');

        $stmt->bindParam(':module_title', $title);
        $stmt->bindParam(':module_path', $module_path);
        $stmt->bindParam(':quiz_id', $qz_id);
        $stmt->bindParam(':col_name_score', $colName);

        if (!$stmt->execute()) {
            header('location: ../admin/AddModule.php');
            exit();
        }

        $sql = 'ALTER TABLE user_db ADD COLUMN ' . $colName . ' VARCHAR(1000) DEFAULT 0';

        $alter = $this->connect()->prepare($sql);

        if (!$alter->execute()) {
            header('location: ../admin/AddModule.php');
            exit();
        }

        return null;
        //
    }

    public function deleteModule($module)
    {
        $stmt = $this->connect()->prepare('SELECT col_name_score, module_path FROM module WHERE module_id = :module_id ');

        $stmt->bindParam(':module_id', $module);

        if (!$stmt->execute()) {
            header('location: ../admin/Module.php');
            exit();
        }

        $colName = $stmt->fetch();

        $removeFile = '../' . $colName['module_path'];

        unlink($removeFile);

        $sql = 'ALTER TABLE user_db DROP COLUMN ' . $colName['col_name_score'];

        $alter = $this->connect()->prepare($sql);

        if (!$alter->execute()) {
            header('location: ../admin/Module.php');
            exit();
        }

        $delete = $this->connect()->prepare('DELETE FROM module WHERE module_id = :module_id');

        $delete->bindParam(':module_id', $module);

        if (!$delete->execute()) {
            header('location: ../admin/Module.php');
            exit();
        }

        return null;
        //
    }

    public function indexModule($module)
    {
        $stmt = $this->connect()->prepare('SELECT * FROM module WHERE module_id = :module_id');

        $stmt->bindParam(':module_id', $module);

        if (!$stmt->execute()) {
            header('location: ../admin/Module.php');
            exit();
        }

        return $stmt;
        //
    }

    public function updateModule($module, $title, $fileTmpPath, $fileName)
    {

        if (empty($fileTmpPath) && empty($fileName)) {

            $update = $this->connect()->prepare('UPDATE module SET module_title = :module_title WHERE module_id = :module_id');

            $update->bindParam(':module_title', $title);
            $update->bindParam(':module_id', $module);

            if (!$update->execute()) {
                header('location: ../admin/AddModule.php');
                exit();
            }

            unset($_SESSION['module']);

            return null;
        } else {

            $stmt = $this->connect()->prepare('SELECT module_path FROM module WHERE module_id = :module_id');

            $stmt->bindParam(':module_id', $module);

            if (!$stmt->execute()) {
                header('location: ../admin/AddModule.php');
                exit();
            }

            $path = $stmt->fetch();

            $removeFile = '../' . $path['module_path'];

            unlink($removeFile);

            $update = $this->connect()->prepare('UPDATE module SET module_title = :module_title, module_path = :module_path WHERE module_id = :module_id');



            $fileTmpPath = $_FILES['module']['tmp_name'];
            $fileName = $_FILES['module']['name'];

            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));

            // Allowed file extensions
            $allowedfileExtensions = array('pdf');

            if (!in_array($fileExtension, $allowedfileExtensions)) {
                header('location: ../admin/AddModule.php?notpdf');
                exit();
            }

            $uniqid = uniqid($title . '-');

            $destination = "../modulefile/" . $uniqid . '.' . $fileExtension;

            $module_path = "modulefile/" . $uniqid . '.' . $fileExtension;

            move_uploaded_file($fileTmpPath, $destination);

            $update->bindParam(':module_id', $module);
            $update->bindParam('module_title', $title);
            $update->bindParam('module_path', $module_path);

            if (!$update->execute()) {
                header('location: ../admin/AddModule.php');
                exit();
            }

            unset($_SESSION['module']);

            return null;
        }
        //
    }



















    public function viewQuizList($quiz)
    {
        $stmt = $this->connect()->prepare('SELECT * FROM quiz_table WHERE quiz_id = :quiz_id');

        $stmt->bindParam(':quiz_id', $quiz);

        if (!$stmt->execute()) {
            header('location: ../admin/Module.php');
            exit();
        }

        return $stmt;
        //
    }


    public function indexModuleQuiz($id)
    {
        $stmt = $this->connect()->prepare('SELECT quiz_id FROM `module` WHERE `quiz_id` = :quiz_id');

        $stmt->bindParam(':quiz_id', $id);

        if (!$stmt->execute()) {
            header('location: ../admin/Module.php');
            exit();
        }

        $count = $stmt->fetch();

        if ($count == 1) {
            header('location: ../admin/Module.php');
            exit();
        }
        //
    }


    public function addQuiz($quiz)
    {
        // return $quiz['correctAnswer'];s

        $choicesID = uniqid('cs-');

        $question = $this->connect()->prepare('INSERT INTO quiz_table (`quiz_id`, `question`, `choices_id`)VALUES (:quiz_id, :question, :choices_id)');

        $question->bindParam(':quiz_id', $quiz['quizID']);
        $question->bindParam(':question', $quiz['question']);
        $question->bindParam(':choices_id', $choicesID);

        if (!$question->execute()) {
            header('location: ../admin/Module.php');
            exit();
        }

        foreach ($quiz['choices'] as $choice) {

            if ($choice == $quiz['correctAnswer']) {
                $guess = 1;
                //
            } else {
                $guess = 0;
            }

            $choices = $this->connect()->prepare('INSERT INTO choices_table(`choices_id`, `answer_text`, `guess`) VALUES (:choices_id, :answer_text, :guess)');

            $choices->bindParam(':choices_id', $choicesID);
            $choices->bindParam(':answer_text', $choice);
            $choices->bindParam(':guess', $guess);

            if (!$choices->execute()) {
                header('location: ../admin/Module.php');
                exit();
            }
        }

        return null;

        //
    }

    public function indexQuiz($choices_id)
    {
        $stmt = $this->connect()->prepare('SELECT * FROM quiz_table WHERE choices_id = :choices_id');

        $stmt->bindParam(':choices_id', $choices_id);

        if (!$stmt->execute()) {
            header('location: ../admin/Module.php');
            exit();
        }

        return $stmt;

        //
    }

    public function indexChoice($choices_id)
    {
        $stmt = $this->connect()->prepare('SELECT * FROM choices_table WHERE choices_id = :choices_id');

        $stmt->bindParam(':choices_id', $choices_id);

        if (!$stmt->execute()) {
            header('location: ../admin/Module.php');
            exit();
        }

        return $stmt;
        //
    }


    public function updateQuiz($quiz)
    {

        $stmt = $this->connect()->prepare('DELETE FROM choices_table WHERE choices_id = :choices_id');

        $stmt->bindParam(':choices_id', $quiz["choiceID"]);

        if (!$stmt->execute()) {
            header('location: ../admin/Module.php');
            exit();
        }

        $choicesID = $quiz["choiceID"];

        $question = $this->connect()->prepare('UPDATE quiz_table SET question = :question WHERE choices_id = :choices_id');

        $question->bindParam(':choices_id', $quiz['choiceID']);
        $question->bindParam(':question', $quiz['question']);

        if (!$question->execute()) {
            header('location: ../admin/Module.php');
            exit();
        }

        foreach ($quiz['choices'] as $choice) {

            if ($choice == $quiz['correctAnswer']) {
                $guess = 1;
                //
            } else {
                $guess = 0;
            }

            $choices = $this->connect()->prepare('INSERT INTO choices_table(`choices_id`, `answer_text`, `guess`) VALUES (:choices_id, :answer_text, :guess)');

            $choices->bindParam(
                ':choices_id',
                $choicesID
            );
            $choices->bindParam(':answer_text', $choice);
            $choices->bindParam(':guess', $guess);

            if (!$choices->execute()) {
                header('location: ../admin/Module.php');
                exit();
            }
        }
        //
    }

    protected function delQz($choiceID)
    {
        $quiz  = $this->connect()->prepare('DELETE FROM `quiz_table` WHERE choices_id = :choices_id');

        $quiz->bindParam(':choices_id', $choiceID);
        if (!$quiz->execute()) {
            header('location: ../admin/Module.php');
            exit();
        }

        $choice  = $this->connect()->prepare('DELETE FROM `choices_table` WHERE choices_id = :choices_id');

        $choice->bindParam(':choices_id', $choiceID);
        if (!$choice->execute()) {
            header('location: ../admin/Module.php');
            exit();
        }

        return null;
        //
    }
}
