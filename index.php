<?php 
    require_once 'app/include/database.php';
    require_once 'app/include/functions.php';
?>
<?php
  $arr = get_student();
?>
<?php



include 'app/header.php';
$faculties = get_faculties();?>
  <body>
<form method="post" action=''>
    <select size="1" name="faculty">
        <option selected disabled>Выберите факультет</option>
        <?php foreach($faculties as $faculty):?>
        <option value="<?=$faculty['id_faculty']?>"><?=$faculty['name']?></option>
   
        <?php        endforeach;?>
    </select>
    <select size ='1' name="year">
        <option selected disabled>Выберите курс</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value='4'>4</option>
    </select>
    <select size ='1' name="group">
        <option selected disabled>Выберите группу</option>
        <?php for($i=1;$i<13;$i++): ?>
        <option value="<?=$i?>"><?=$i?></option>
        <?php endfor; ?>
    </select>
    <input class="btn btn-info btn-sm"type='submit' value="Send"/>
    
</form>
<?php 


if($_POST['faculty']!=NULL && $_POST['year']!=NULL && $_POST['group']!=NULL):
$faculties = get_faculties();
$arr= short_students_info($_POST['faculty'], $_POST['year'], $_POST['group']);?>
<table border="1" class="table">
    <tr><td>ФИО студента</td>
        <td>Дата рождения</td>
        <td>Факультет</td>
        <td>Курс</td>
        <td>Группа</td>
        <td>Подробнее</td>
    </tr>
<?php foreach ($arr as $student):?>
    <tr>
    <?php for($i=0;$i < count($student); $i++):
        if($i!=0):?>
        <td><?=$student[$i]?></td>
        <?php endif; ?>
        <?php endfor; ?>
        <td><a href="student.php?id_student=<?=$student[0]?>">------></td>
    </tr>
    <?php endforeach;?>
</table>
<a  href="insert.php">Добавить</a>

<?php endif; include 'app/footer.php';
?>
</body>


