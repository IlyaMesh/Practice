<?php
    require_once 'app/include/database.php';
    require_once 'app/include/functions.php';
    include 'app/header.php';
    //header("Refresh:0");
//добавить редактирование и удаление
$student_id = $_GET['id_student'];
$student = get_one_student($student_id);
$faculty = get_faculty($student['id_faculty']);
$groups = find_all_soc_groups($student_id);
        ?>
<h1>Данные о студенте</h1>
<table border="1">
    <tr>
        
        <td><?=$student['student_FIO']?></td>
        <td><?=$student['student_birthdate']?></td>
        <td><?=$faculty[0]['name']?></td>
        <td><?=$student['year']?></td>
        <td><?=$student['studing_group']?></td>
    </tr>
</table>
<table>
    <tr>
        <?php foreach ($groups as $group):?>
        <td><?=$group['name']?></td>
        <?php                endforeach;?>
    </tr>
</table>

<?php 
//если нет успеваемости то кнопка с добавлением, если есть то успеваемость таблицей
$subjects = get_subjects_4_student($student_id);

//print_r($student_id);
//print_r(get_perf($student_id));
$perf = get_perf($student_id);
if(empty($perf)):?>
    <form method="POST">
    <table>
        <?php foreach ($subjects as $subject):?>
        <tr>
            <td><?=$subject[1]?></td>
            <td><select size ='1' name='number<?=$subject[0]?>'>
        <option selected disabled>Выберите оценку</option>
        <option value="5">5</option>
        <option value="4">4</option>
        <option value="3">3</option>
        <option value="2">2</option>
    </select>
        </td></tr>
        <?php endforeach;?>
    </table>
    
    <input class="btn btn-info btn-sm"type='submit' value="Send"/>
</form>
<script>
                //window.location.replace("http://php.loc/app/student.php?id_student=<?=$student_id?>");
                </script>
<?php
else:
?>
<h1>Успеваемость</h1>
<table border="1">
    <?php foreach ($subjects as $subject):?>
    <tr>
        <td>
            <?=$subject[1]?>
        </td>
        <td>
            <?= find_rating($subject[0], $perf)?>
        </td>
        
    </tr>
    <?php endforeach;?>
</table>
<?php endif;
?>
<?php
if(!empty($_POST)){
    $student_id = $_GET['id_student'];
    $subjects = get_subjects_4_student($student_id);
    
//    print_r($_POST);
//    $subject = $subjects[0];
//    print_r($subject[0]);
//    print_r($_POST["number"."$subject[0]"]);
    foreach ($subjects as $subject)
        add_perf ($student_id, $subject[0], $_POST["number"."$subject[0]"]);
}
?>
<a href="update.php?id_student=<?=$student_id?>">Редактировать</a>
<a href="delete.php?id_student=<?=$student_id?>">Удалить</a>
<?php //echo file_get_contents('http://php.loc/app/student.php?id_student=83');?>


