<?php

include("../functions.php");
include("../bd.php");

session_start();
$myid=trim(htmlspecialchars(strip_tags($_GET['id'])));

if($_SESSION['status']!="admin")
{
	error("Вы не можете удалять записи, так как не имеете прав администратора!");
	die();
}
else
{
	$del = mys("DELETE FROM `news` WHERE `id`='$myid' ");
	if($del)
	{
		error("Успешно удалено!");
		die();
	}
}

?>