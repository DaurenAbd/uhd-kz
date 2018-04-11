<?php

if(isset($_POST['user']))
{
	session_start();
	$to_user=$_SESSION['login'];
	$from=$_POST['user'];
	include_once("../../../bd.php");
	include_once("../../../functions.php");
	
	$t=mysql_query("UPDATE `messages` SET `shown`='1' WHERE (`to`='$to_user' AND `from`='$from') ");
	
	$m=mysql_query("SELECT * FROM `messages` WHERE `to`='$to_user' AND `shown`='0' GROUP BY `from` ");
	while($unread=mysql_fetch_array($m))
	{
		echo "<script>have_new_message('".$unread['from']."');</script>";
	}
	
	if($from!="all")
	{
	$res=mysql_query("
	SELECT * FROM `messages` WHERE (`to`='$to_user' AND `from`='$from') OR (`to`='$from' AND `from`='$to_user') ORDER BY `id`
	");
	
	}
	else
	{
		$res=mysql_query("SELECT * FROM `messages` WHERE `to`='all' ORDER BY `id`");
	}
	while($data=mysql_fetch_array($res))
	{
		$qas = $data['from'];
		$login_query = mys("SELECT `name`,`surname` FROM `users` WHERE `login`='$qas' ");
		$us_d = mysar($login_query);
		$name = $us_d['name'];
		$surn = $us_d['surname'];
		
		$per_s = first_s($surn);
		
		$data['text'] = iconv("windows-1251","utf-8",$data['text']);
		echo "<font color='";
		if ($data['from'] == $to_user)
		 echo 'blue';
		else
		 echo 'red';
		echo "'><b>".$name." ".$per_s.".</b></font><br><font color='black'>".$data['text']."</font><br>";
	}
}
?>