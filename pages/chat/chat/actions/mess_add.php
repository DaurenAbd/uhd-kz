<?php
if(isset($_POST['mess']) && $_POST['mess']!='')
{
	$mess=$_POST['mess'];
	$to=$_POST['to'];
	$mess=iconv("utf-8","windows-1251",$mess);
	session_start();
	$from=$_SESSION['login'];
	include_once("../../../bd.php");
	$res=mysql_query("INSERT INTO `messages` (`from`,`to`,`text`) VALUES ('$from','$to','$mess') ");
}
?>