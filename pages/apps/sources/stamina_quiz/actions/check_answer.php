<?php
	header('Content-Type: text/html; charset=windows-1251');
	
	include ("../../../../functions.php");
	include ("../../../../bd.php");
	
	$questid = $_POST['questid'];
	$get = mys ("SELECT * FROM `answers` WHERE `q_id` = '$questid'");
	
	while ($ans = mysar ($get))
	{
		if ($ans['correct'] == true)
		{
			echo $ans['id'];
			break;
		}
	}
	
?>