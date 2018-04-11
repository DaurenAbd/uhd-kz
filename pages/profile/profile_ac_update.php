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
	$name = $_POST['name'];
	$surname = $_POST['surname'];
	$email = $_POST['email'];
	
	$upd_query = mys("UPDATE `users` SET `name`='$name',`surname`='$surname',`email`='$email' 
						WHERE `login`='$ses_login'
	");
	
	if($upd_query)
	{
		error("Успешно обновлено!");
	}
	else
	{
		error("Не удалось обновить! Обратитесь к администратору!");
	}
}


?>