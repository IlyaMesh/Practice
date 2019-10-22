<?php
require_once 'app/include/database.php';
    require_once 'app/include/functions.php';
    require_once 'app/header.php';
    $faculties = get_faculties();
    ?>
<form method="post">
    <select size="1" name="faculty">
        <option selected disabled>Выберите факультет</option>
        <?php foreach($faculties as $faculty):?>
        <option value="<?=$faculty['id_faculty']?>"><?=$faculty['name']?></option>
   
        <?php        endforeach;?>
    </select>
    <select size="1" name="order">
        <option selected disabled>Выберите характер сравнения</option>
        <option value="up">по возрастанию</option>
        <option value="down">по убыванию</option>
    </select>
    <input class="btn btn-info btn-sm"type='submit' value="Send"/>
</form>
<?php
if(isset($_POST['order'])):
    if($_POST['order'] == 'down')
        $res=count_rating_up ($_POST['faculty']);
    else
        $res = count_rating_down ($_POST['faculty']);
    ?>
<table class="table" border="1">
    <tr>
        <td>ФИО</td>
        <td>Курс</td>
        <td>Группа</td>
        <td>Средний балл</td>
    </tr>
    <?php        
    foreach ($res as $student):?>
    <tr>
        <?php foreach ($student as $field):?>
        <td><?=$field?></td>
        <?php endforeach?>
    </tr>
    <?php endforeach;?>
</table>
        
<?php endif;
?>


