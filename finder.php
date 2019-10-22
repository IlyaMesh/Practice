<?php
require_once 'app/include/database.php';
    require_once 'app/include/functions.php';
    require_once 'app/header.php';

$words = explode(" ", $_POST['search']);
$result = find_student($words[0], (int)$words[1], (int)$words[2]);?>
<table border="1">
    <tr><td>ФИО студента</td>
        <td>Дата рождения</td>
        <td>Факультет</td>
        <td>Курс</td>
        <td>Группа</td>
        <td>Подробнее</td>
    </tr>
<?php foreach ($result as $student):?>
    <tr>
        
    <?php $i=0; foreach ($student as $field):
        if($i==0){
        $i++;
        continue;}
        ?>  
        <td><?=$field?></td>
        <?php $i++;?>
        <?php endforeach; ?>
        <td><a href="student.php?id_student=<?=$student['student_id']?>">------></td>
    </tr>
    <?php endforeach;?>
</table>
<?php include 'app/footer.php';?>