<?php

$login = trim(htmlspecialchars(strip_tags($_POST['login1'])));
$password = trim(htmlspecialchars(strip_tags($_POST['password1'])));
$repassword = trim(htmlspecialchars(strip_tags($_POST['repassword'])));
$name = trim(htmlspecialchars(strip_tags($_POST['name'])));
$surname = trim(htmlspecialchars(strip_tags($_POST['surname'])));
$email = trim(htmlspecialchars(strip_tags($_POST['email'])));
$type = $_POST['type'];

include_once("../bd.php");
include_once("../functions.php");

$check = mys("SELECT `login` FROM `users` WHERE `login`='$login' ");
$login_arr = mysar($check);

if($login_arr['login']!="" && $login_arr['login']!=" ")
{
	error("Такой логин уже зарегистрирован!");
	die();
}
if($password!=$repassword)
{
	error("Пароли не совпадают!");
	die();
}


if(strlen($login)<4){error("Длина логина меньше 4 символов!");die();}
if(strlen($password)<4){error("Длина пароля меньше 4 символов!");die();}
if(strlen($name)<3){error("Длина имени меньше 4 символов!");die();}
if(strlen($surname)<4){error("Длина фамилии меньше 4 символов!");die();}
if(strlen($email)<4){error("Длина почты меньше 4 символов!");die();}

$reg = mys("INSERT INTO `users` (`login`,`password`, `name`,`surname`,`email`, `type`) 
			VALUES ('$login','$password','$name','$surname','$email', '$type')
			");
			
if($reg)
{
	error("Вы успешно зарегистрированы!");
	die();
}
	
?>