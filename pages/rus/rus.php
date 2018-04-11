<?php
	
	include ("../../bd.php");
	include ("../../functions.php");
	
	$a = array ();
	$a = file ("pages/rus/text.txt");
	$n = count ($a);
	
	for ($i = 0; $i < 6; $i += 6)
	{
		iconv ('windows-1251', 'utf-8', $a[$i]);
		//echo "Вопрос номер " . ($i / 6 + 1) . "<br>" . $a[$i] . "<br>";
		$add = mys ("INSERT INTO `questions` (`quest`, `topic`) VALUES ('$$a[$i]', 'rustil')");
		$lid =  mysql_insert_id ();
		for ($j = 1; $j <= 5; ++$j)
		{
			$res = $a[$j][0];
			$m = strlen ($a[$j]);
			$ans = "";
			for ($k = 1; $k < $m; ++$k)
				$ans .= $a[$j][$k];
			iconv ('windows-1251', 'utf-8', $ans);
			//echo $ans . " " . $res . "<br>";
			$qadd = mys ("INSERT INTO `answers` (`q_id`, `ans`, `correct`, `topic`) VALUES ('$lid', '$ans', '$res', 'rustil')");
		}
	}
?>