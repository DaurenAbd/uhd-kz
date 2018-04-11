<?php

$text = $_POST['hdtext'];
$title = $_POST['title'];
$date = date("Y-m-d h:i:s");

include("../functions.php");
include("../bd.php");

if($text=="" || $text==" " || $title=="" || $title==" ")
{
	error("Введите текст!");
	die();
}

$add = mys("INSERT INTO `news` (`title`,`text`,`date`) VALUES ('$title','$text', '$date')");

if($add)
{
	error("Успешно добавлено!");
	die();
}
else
{
	error("Не удалось добавить запись. Обратитесь к администратору.");
	die();
}


?>