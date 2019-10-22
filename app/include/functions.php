<?php
$arry=array();

function find_user($username){
    global $link;
    
    $sql ="SELECT * FROM users WHERE login='".$username."'";
    if ($result = mysqli_query($link, $sql)) {
        
        $student = mysqli_num_rows($result);
    }
    else{
        $student = 0;
    }   
    return $student;
}
function find_full_user($username,$pass)
{
    global $link;
    
    $sql ="SELECT * FROM users WHERE `login` = '$username' AND `password` = '$pass'";
    if ($result = mysqli_query($link, $sql)) {
        
        $student = mysqli_num_rows($result);
    }
    else{
        $student = 0;
    }   
    return $student;
}
function insert_user($email,$username,$password){
    global $link;
    
    $sql="INSERT INTO `users`(`id`, `email`, `login`, `password`) VALUES (NULL,'$email','$username','$password')";
    
    $result = mysqli_query($link, $sql);
    
    if($result){
    $message = "Account succesfully created";}
    else {$message = "Failed to insert data information!";}
    return $message;
}
function get_student(){
    global $link;
    
    $sql="SELECT * FROM `students`";
    
    $result = mysqli_query($link, $sql);
    
    $student= mysqli_fetch_all($result, MYSQLI_ASSOC);
    
    return $student;
}
function get_one_student($student_id){
    global $link;
    
    $sql = "SELECT * FROM students WHERE student_id = ".$student_id;
    
    $result = mysqli_query($link, $sql);
    
    $student = mysqli_fetch_assoc($result);
    
    return $student;
}

function get_faculties(){
    global $link;
    
    $sql = "SELECT * FROM `faculty`";
    
    $result = mysqli_query($link, $sql);
    
    $faculties = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
    return $faculties;
}
function get_faculty($id){
    global $link;
    $sql = "SELECT * FROM `faculty` WHERE id_faculty=$id";
    $tresult = mysqli_query($link, $sql);
    $result= mysqli_fetch_all($tresult,MYSQLI_ASSOC);
    return $result;
}
function find_students($faculty_id, $year, $group_number){
    
    global $link;
    
    $sql="SELECT * FROM `students` WHERE id_faculty=$faculty_id AND year=$year AND studing_group=$group_number";
    
    $result = mysqli_query($link, $sql);
    
    $student_list = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
    return $student_list;
    
    
}
function short_students_info($faculty_id,$year,$group_number){
    $students = find_students($faculty_id, $year, $group_number);
    $faculties = get_faculty($faculty_id);
    $faculty = $faculties[0];
    $info= array();
    
    foreach ($students as $student)
        {
            $info[]=array($student['student_id'],$student['student_FIO'],$student['student_birthdate'],$faculty['name'],$student['year'],$student['studing_group']);
        }
    return $info;
            
}
function get_groups(){
    
    global $link;
    
    $sql="SELECT * FROM `groups`";
    
    $result = mysqli_query($link, $sql);
    
    $groups = mysqli_fetch_all($result,MYSQLI_ASSOC);
    
    return $groups;
    
}

function insert_student($fio,$birthdate,$year,$student_group,$studing_group,$id_faculty){
    global $link;
    global $arry;
    //student_group массив из социальных групп студента
   
    $insert_query = "INSERT INTO students (student_id, student_FIO, student_birthdate, year, studing_group, id_faculty) VALUES (NULL,'$fio','$birthdate','$year','$studing_group','$id_faculty')";
    $result = mysqli_query($link, $insert_query);
    $last_id = mysqli_insert_id($link);
    $text="";
        if($student_group != NULL){
            foreach($student_group as $s_group):
                $text = "INSERT INTO `students_groups`(`id_student`, `id_group`) VALUES ('$last_id','$s_group')";
                mysqli_query($link, $text);
        
            endforeach;
    
        }
    return ;
}
function find_all_soc_groups($student_id){
    global $link;
    $sql= "SELECT groups.name
           FROM students_groups,groups
           WHERE groups.id_group = students_groups.id_group AND students_groups.id_student =$student_id";
    $tresult = mysqli_query($link, $sql);
    $result= mysqli_fetch_all($tresult,MYSQLI_ASSOC);
    return $result;
}
function get_subjects_4_student($student_id){
    global $link;
    
$sql="SELECT subject.id_subject,subject.name
FROM students, study_group,faculty,speciality,curriculum,subject
WHERE students.year = study_group.id_year AND students.studing_group = study_group.id_number AND students.id_faculty = faculty.id_faculty 
AND faculty.id_faculty = speciality.id_faculty AND speciality.id_speciality = study_group.id_speciality AND curriculum.id_speciality = study_group.id_speciality 
AND curriculum.semester < (students.year*2) AND subject.id_subject = curriculum.id_subject AND students.student_id=$student_id";

$result = mysqli_query($link, $sql);
$subjects = mysqli_fetch_all($result);
return $subjects;

}

function add_perf($id_student,$id_subject,$rating){
    global $link;
    
    $sql = "INSERT INTO perfomance(`id_perfomance`, `id_student`, `id_subject`, `rating`) VALUES (NULL,'$id_student','$id_subject','$rating')";
    
    $result = mysqli_query($link, $sql);
    
    return;
}
function get_perf($id){
    global $link;
    $sql = "SELECT * FROM `perfomance` WHERE id_student=$id";
    $tresult = mysqli_query($link, $sql);
    $result= mysqli_fetch_all($tresult,MYSQLI_ASSOC);
    return $result;
}
function find_rating($id_subject,$array){
    foreach ($array as $subject){
        if($subject['id_subject'] == $id_subject)
            return $subject['rating'];
    }
}
function delete_groups($id){
    global $link;
    $sql="DELETE  FROM `students_groups` WHERE `id_student`=$id";
    mysqli_query($link, $sql);
}
function update_all($id,$fio,$birth,$year,$group,$id_fac,$list)
{
    global $link;
    $sql="UPDATE `students` SET `student_id`='$id',`student_FIO`='$fio',`student_birthdate`='$birth',`year`='$year',`studing_group`='$group',`id_faculty`='$id_fac'";
    mysqli_query($link, $sql);
    
    delete_groups($id);
    if(!empty($list)){
            foreach($list as $s_group):
                
                $text = "INSERT INTO `students_groups`(`id_student`, `id_group`) VALUES ('$id','$s_group')";
                mysqli_query($link, $text);
                
            endforeach;
    }
    return;
}
function delete_ratings($id){
   global $link;
   $sql = "DELETE FROM `perfomance` WHERE `id_student`=$id";
   mysqli_query($link, $sql);
}
function delete_student($id){
    global $link;
    $sql ="DELETE FROM `students` WHERE `student_id`=$id";
    mysqli_query($link, $sql);
}
function find_student($fac_name,$year,$group){
    global $link;
    $sql = "SELECT student_id,student_FIO,student_birthdate,faculty.name,students.year,students.studing_group FROM `students`, faculty";
    if($fac_name == NULL and $year == NULL and $group == NULL){
        $tresult = mysqli_query($link, $sql);
        $result= mysqli_fetch_all($tresult,MYSQLI_ASSOC);
        return $result;
    }
    else{
        $sql.=" WHERE ";
        if($fac_name != NULL)
            $sql.="students.id_faculty=faculty.id_faculty AND faculty.name = '$fac_name' ";
        if($year != NULL)
            $sql.="AND students.year = $year ";
        if($group != NULL)
            $sql.="AND students.studing_group = $group";
    }
    
    $tresult = mysqli_query($link, $sql);
    $result= mysqli_fetch_all($tresult,MYSQLI_ASSOC);
    return $result;
    
}
function count_rating_up($faculty){
    global $link;
    $sql = "SELECT students.student_FIO,students.year,students.studing_group,AVG(perfomance.rating)
FROM students, perfomance,faculty
WHERE perfomance.id_student = students.student_id AND faculty.id_faculty='$faculty'
GROUP BY students.student_FIO, students.year
ORDER BY AVG(perfomance.rating)";
    $tresult = mysqli_query($link, $sql);
    $result= mysqli_fetch_all($tresult,MYSQLI_ASSOC);
    return $result;
}
function count_rating_down($faculty){
    global $link;
    $sql="SELECT students.student_FIO,students.year,students.studing_group,AVG(perfomance.rating)
FROM students, perfomance,faculty
WHERE perfomance.id_student = students.student_id AND faculty.id_faculty='$faculty'
GROUP BY students.student_FIO, students.year
ORDER BY AVG(perfomance.rating) DESC";
    $tresult = mysqli_query($link, $sql);
    $result= mysqli_fetch_all($tresult,MYSQLI_ASSOC);
    return $result;
}




