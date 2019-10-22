<?php

    require_once 'app/include/database.php';
    require_once 'app/include/functions.php';
    require_once 'app/header.php';
if(isset($_SESSION['session_username'])):
//добавить редактирование и удаление
$student_id = $_GET['id_student'];
$student = get_one_student($student_id);
$stud_faculty = get_faculty($student['id_faculty']);
$stud_groups = find_all_soc_groups($student_id);
$soc_groups = get_groups();
$faculties = get_faculties();
$subjects = get_subjects_4_student($student_id);
$perf = get_perf($student_id);
        ?>
<h1>Данные о студенте</h1>
<form method="post" >
<table border="1">
    <tr>
        <td>Ф.И.О</td>
        <td>Дата рождения</td>
        <td>Факультет</td>
        <td>Курс</td>
        <td>Группа</td>
    </tr>
    <tr>     
        <td><input type="text" name="fio"size="25" value="<?=$student['student_FIO']?>"></td></td>
        <td><input type="date" min="1990-01-01" max="2010-12-12"name="date" value="<?=$student['student_birthdate']?>"></td>
        <td><select size="1" name="faculty" value="<?=$stud_faculty[0]['name']?>">
            <?php foreach($faculties as $faculty):?>
        <option value="<?=$faculty['id_faculty']?>"><?=$faculty['name']?></option>
   
        <?php endforeach;?></select></td>
        <td><select size ='1' name="year" value="<?=$student['year']?>">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value='4'>4</option>
            </select></td>
        <td><select size ='1' name="group" value="<?=$student['studing_group']?>">
        <?php for($i=1;$i<13;$i++): ?>
        <option value="<?=$i?>"><?=$i?></option>
        <?php endfor; ?>
        </select></td>
    </tr>
</table>
<table>
    <tr>
        <?php foreach ($soc_groups as $group):
            if((in_array($stud_groups[0]['name'],$group)) || (in_array($stud_groups[1]['name'],$group)) ||(in_array($stud_groups[2]['name'],$group)) || (in_array($stud_groups[3]['name'],$group))):
                    
                ?>
        <input type="checkbox" name=list[] value="<?=$group['id_group']?>" checked><?=$group['name']?><?php else:?>
        <input type="checkbox" name=list[] value="<?=$group['id_group']?>"><?=$group['name']?><?php endif;?>
        <?php endforeach;?>
    </tr>
</table>
<table>
        <?php foreach ($subjects as $subject):?>
        <tr>
            <td><?=$subject[1]?></td>
        <td><select size ='1' name='number<?=$subject[0]?>' value="<?= find_rating($subject[0], $perf)?>">
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
<?php
if(!empty($_POST)):
   
    update_all($student_id,$_POST['fio'], $_POST['date'], $_POST['year'], $_POST['group'], $_POST['faculty'],$_POST['list']);
    $subjects = get_subjects_4_student($student_id);
    delete_ratings($student_id);
    foreach ($subjects as $subject)
        add_perf($student_id, $subject[0], $_POST["number"."$subject[0]"]);?><a href="student.php?id_student=<?=$student_id?>">
            <script>
                window.location.replace("http://php.loc/index.php");
                </script>
            <?php
endif;
?>
<?php else:?>
                <h1>Данная функция доступна только авторизованным пользователям</h1>
                <a href="login.php">Войти</a>
<?php endif; ?>
