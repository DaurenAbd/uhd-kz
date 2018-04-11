<?php

include("../bd.php");
include("../functions.php");

$myid = $_GET['id'];

$del_res = mys("DELETE FROM `results` WHERE `probnik_id`='$myid' ");
$add_query = mys("DELETE FROM `probniki` WHERE `id`='$myid' ");

if($add_query && $del_res)
{
	error("Успешно удалено!");
}
else
{
	error("Не удалось удалить!");
}

?>