<?php
   require_once 'app/include/database.php';
    require_once 'app/include/functions.php';

    $faculties = get_faculties();
    ?>
<form  method="post">
    <table>
        
    <tr><td><p><b>Введите ФИО студента:</b></p>
            <input type="text" name="fio"size="40"></td>
    <td><p><b>Дата рождения:</b></p>
        <input type="date" min="1990-01-01" max="2010-12-12"name="date"></td>
    </tr>
    <tr><td><select size="1" name="faculty">
                <option selected disabled>Выберите факультет</option>
            <?php foreach($faculties as $faculty):?>
        <option value="<?=$faculty['id_faculty']?>"><?=$faculty['name']?></option>
   
        <?php        endforeach;?></select></td>
        <td><select size ='1' name="year">
        <option selected disabled>Выберите курс</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value='4'>4</option>
            </select></td>
            <td><select size ='1' name="group">
        <option selected disabled>Выберите группу</option>
        <?php for($i=1;$i<13;$i++): ?>
        <option value="<?=$i?>"><?=$i?></option>
        <?php endfor; ?>
                </select></td></tr>
    <tr><td><p><b>Принадлежит ли студент одной или нескольким группам</b></p>
    <?php $groups = get_groups();
        foreach ($groups as $group):?>
    <input type="checkbox" name=list[] value="<?=$group['id_group']?>"><?=$group['name']?>
    <?php endforeach;?></td></tr>
    <tr><td><input class="btn btn-info btn-sm"type='submit' value="Send"/></td></tr></table>           
        </form>
    <?php  
    
    
    if (isset($_POST['list'])):
    $list = $_POST['list'];    
    
    insert_student($_POST['fio'], $_POST['date'], $_POST['year'], $list, $_POST['group'], $_POST['faculty']);
   
    
    else:
        insert_student($_POST['fio'], $_POST['date'], $_POST['year'], NULL, $_POST['group'], $_POST['faculty']);
           
    ?>
<script>
                //window.location.replace("http://php.loc/index.php");
                </script>
                <?php endif;?>


