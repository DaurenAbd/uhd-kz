<?php

	header('Content-Type: text/html; charset=windows-1251');
	include ("../../../../functions.php");
	include ("../../../../bd.php");
	$top = $_POST['qtype'];
	//$get = mys ("SELECT * FROM `questions` WHERE `id` >= (SELECT FLOOR(MAX(`id`) * RAND()) FROM `questions`) ORDER BY `id` LIMIT 1");
	$maxid_query = mys ("SELECT `id` FROM `questions` WHERE `topic`='$top' ORDER BY `id` DESC LIMIT 1");
	$maxid_array = mysql_fetch_array($maxid_query);
	$minid_query = mys ("SELECT `id` FROM `questions` WHERE `topic`='$top' ORDER BY `id` LIMIT 1");
	$minid_array = mysql_fetch_array($minid_query);
	
	function make_seed()
	{
		list($usec, $sec) = explode(' ', microtime());
		return (float) $sec + ((float) $usec * 100000);
	}
	srand(make_seed());
	
	$maxid = $maxid_array['id'];
	$minid = $minid_array['id'];
	$qnum = rand ($minid, $maxid);
	//$get = mys ("SELECT * FROM `questions` WHERE `id` >= (SELECT FLOOR(MAX(`id`) * ((RAND() + RAND() % 971))) FROM `questions`) AND `topic`='$top' ORDER BY `id` LIMIT 1");
	$get = mys ("SELECT * FROM `questions` WHERE `id` >= '$qnum' AND `topic`='$top' ORDER BY `id` LIMIT 1");
	$question = mysar ($get);
	$myid = $question['id'];
	$q='"';
	$k = 0;
	echo "<input type='hidden' id='checked' value='false'>";
	
	echo "<div class = 'quest'>".$question['quest']."</div><br>";
	$take = mys ("SELECT * FROM `answers` WHERE `q_id` = '$myid'");
	echo '<table>';
	while ($ans = mysar ($take))	
	{
		if ($k % 2 == 0)
			echo '<tr>';
		if($ans['correct']==true)
		{
			echo "<input type='hidden' id='corrans' value='".$ans['id']."'>";
		}
		echo "<td><div class = 'pans".$k++."' id = 'ans".$ans['id']."' onClick = 'checkans(".$q.$ans['id'].$q.");'>".$ans['ans']."</div></td>";
		if ($k % 2 == 1)
			echo "</tr>";
	}
	echo '</table>';
	echo "<div id='wait'><img src='pages/apps/sources/stamina_quiz/images/waiter.gif'></div>";
?>