<?php
 require_once 'app/include/database.php';
    require_once 'app/include/functions.php';
    require_once 'app/header.php';
    if(isset($_SESSION['session_username'])):
    $student_id = $_GET['id_student'];

    delete_ratings($student_id);
    delete_groups($student_id);
    delete_student($student_id);?>
     <script>
                window.location.replace("http://php.loc/index.php");
                </script>
<?php else:?>
                <h1>Данная функция доступна только авторизованным пользователям</h1>
                <a href="login.php">Войти</a>
<?php endif; ?>

