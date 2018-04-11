<?php

$ok=mysql_connect("localhost","ruslan","qwerty96");
if($ok)
{
	$ok2=mysql_select_db("uhd");
	mysql_query("SET NAMES 'cp1251'");
}
else
{
	die("Не могу подключить к базе данных!");
}

?>