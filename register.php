<?php 
    require_once 'app/include/database.php';
    require_once 'app/include/functions.php';
?>
<?php
if(isset($_POST["register"])){
	
if(!empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['password'])) {
    
 $email=htmlspecialchars($_POST['email']);
 $username=htmlspecialchars($_POST['username']);
 $password=htmlspecialchars($_POST['password']);
 $numrows = find_user($username);
// $query=mysql_query("SELECT * FROM users WHERE username='".$username."'");
// $numrows=mysql_num_rows($query);
if($numrows==0)
   {
//	$sql="INSERT INTO users
//  (email, username,password)
//	VALUES('$email', '$username', '$password')";
//  $result=mysql_query($sql);
// if($result){
//	$message = "Account Successfully Created";
//} else {
// $message = "Failed to insert data information!";
$message = insert_user($email, $username, $password);
  }
 else {
	$message = "That username already exists! Please try another one!";
   }
   echo ".$message";
}

 }
//	>?

	//<?php 
//        if(!empty($message)) {echo ".$message";}
?>
<html lang="en">
	<head>
	<meta charset="utf-8"> 
 <title> Как с помощью PHP и MySQL создать систему регистрации и авторизации пользователей</title>
<link href="css/style.css" media="screen" rel="stylesheet">
	</head>
	<body>
<div class="container mregister">
<div id="login">
 <h1>Регистрация</h1>
<form action="register.php" id="registerform" method="post"name="registerform">
<p><label for="user_pass">E-mail<br>
<input class="input" id="email" name="email" size="32"type="email" value=""></label></p>
<p><label for="user_pass">Имя пользователя<br>
<input class="input" id="username" name="username"size="20" type="text" value=""></label></p>
<p><label for="user_pass">Пароль<br>
<input class="input" id="password" name="password"size="32"   type="password" value=""></label></p>
<p class="submit"><input class="button" id="register" name= "register" type="submit" value="Зарегистрироваться"></p>
	  <p class="regtext">Уже зарегистрированы? <a href= "login.php">Введите имя пользователя</a>!</p>
 </form>
</div>
</div>
</body>
</html>

