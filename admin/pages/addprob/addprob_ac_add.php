<?php

include("../bd.php");
include("../functions.php");

$desc = $_POST['prob'];

$add_query = mys("INSERT INTO `probniki` (`desc`) VALUES ('$desc')");

if($add_query)
{
	error("Успешно добавлено!");
}
else
{
	error("Не удалось добавить!");
}

?>