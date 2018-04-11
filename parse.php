<?php

$istkaz = file("geo.txt");
$tema = 'geo';
include("pages/bd.php");
include("pages/functions.php");

$n = count ($istkaz);
$k = -1;
$s = array ();
$p = 0;
$s4et = 1;

for ($i = 0; $i < $n; ++$i)
{
	if(isset($istkaz[$i][2]))
	{
	if (preg_match("/\d{1,3}\./",$istkaz[$i],$out) || $istkaz[$i][1] == ')' || $istkaz[$i][2] == ')')
	{
		if ($istkaz[$i][2] == ')')
		{
			$p = $k + 1;
			$istkaz[$i] = substr ($istkaz[$i], 1);
		}
		$a[++$k] = $istkaz[$i];
		if (preg_match("/\d{1,3}\./",$istkaz[$i + 1],$out) || !isset($istkaz[$i + 1][2]))
		{
			$quest = $a[0];
			
			while (!empty ($quest) && $quest[0] == ' ')
				$quest = substr ($quest, 1);
			
			while (!empty ($quest) && $quest[0] != '.')
				$quest = substr ($quest, 1);
			
			$quest = substr ($quest, 1);
			
			while (!empty ($quest) && $quest[0] == ' ')
				$quest = substr ($quest, 1);
				
			$add = mys("INSERT INTO `questions` (`quest`, `topic`) VALUES ('$quest', '$tema') ");
			$q_id = mysql_insert_id();
			
			for ($j = 1; $j <= $k; ++$j)
			{
				$ans = $a[$j];
				
				while (!empty ($ans) && $ans[0] == ' ')
					$ans = substr ($ans, 1);
				
				while (!empty ($ans) && $ans[0] != ')')
					$ans = substr ($ans, 1);
					
				$ans = substr ($ans, 1);
				
				while (!empty ($ans) && $ans[0] == ' ')
					$ans = substr ($ans, 1);
					
				$cor = false;
				if ($j == $p)
					$cor = true;
				$add2 = mys("INSERT INTO `answers` (`q_id`, `ans`, `correct`, `topic`) VALUES ('$q_id', '$ans', '$cor', '$tema')");
				if($add && $add2)echo $s4et."-><font color='green'><b>Успешно!</b></font><br>";
				$s4et++;
			}
			$k = -1;
		}
	}
	else
		$a[$k] .= $istkaz[$i];
	}
}

?>