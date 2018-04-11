<?php
	
	include ("../../bd.php");
	include ("../../functions.php");
	
	
	$question = $_POST['quest'];
	$topic = $_POST['topic'];
	$correct = $_POST['right'];
	$answer = array ();
	
	for ($i = 1; $i <= 5; ++$i)	
	{
		$answer[$i] = $_POST['ans' . $i];
	}
	
	$add_quest = mys ("INSERT INTO `questions` (`quest`, `topic`) VALUES ('$question', '$topic')");
	
	$myid = mysql_insert_id ();
	
	for ($i = 1; $i <= 5; ++$i)
	{
		$right = ($i == $correct);
		$answer_cur = $answer[$i];
		$add_ans = mys ("INSERT INTO `answers` (`q_id`, `ans`, `correct`, `topic`) VALUES ('$myid', '$answer_cur', '$right', '$topic')");
	}
	
	header("location: ../../../?page=parse");
	
?>