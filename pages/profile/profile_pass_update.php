<?php

include("../bd.php");
include("../functions.php");
session_start();

$ses_login = $_SESSION['login'];
$post_login = $_POST['login'];

if($ses_login!=$post_login)
{
	error("Вы не можете изменять чужие профили!");
}
else
{
	
	$oldpass = $_POST['oldpassword'];
	$newpass = $_POST['newpassword'];
	$renewpass = $_POST['renewpassword'];
	
	$oldpassquery = mys("SELECT `password` FROM `users` WHERE `login`='$ses_login' ");
	$oldpas = mysar($oldpassquery);
	$oldpassword = $oldpas['password'];
	
	
	if($oldpassword!=$oldpass)
	{
		error("Неверно введен старый пароль!");
		die();
	}
	else
	{
	
	if($newpass!=$renewpass)
	{
		error("Не совпадают новые пароли!");
		die();
	}
	else
	{
	if(strlen($newpass)<6)
	{
		error("Длина нового пароля меньше 6 символов!");
	}
	else
	{
	$upd_query = mys("UPDATE `users` SET `password`='$newpass'
						WHERE `login`='$ses_login'
	");
	
	if($upd_query)
	{
		error("Пароль успешно обновлен!");
	}
	else
	{
		error("Не удалось обновить! Обратитесь к администратору!");
	}
	}
	}
	}
}


?>