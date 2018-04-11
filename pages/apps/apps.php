<?php

include("pages/apps/class.php");


print ("<link rel='stylesheet' href='pages/apps/sources/stamina_quiz/stamina_quiz.css' />");

if (isset ($_GET['qtype']))
{
	include ("pages/apps/sources/stamina_quiz/stamina_quiz.php");
	$game = new stamina_quiz();
	echo "<div><a href = '?page=apps'>Назад к выбору предмета</a></div>";
	echo "<center><h3>Предмет: <font color='blue'>".$game -> sopos[$_GET['qtype']]."</font></h3></center>";
	
	echo '<input type = "hidden" id = "qtype" value="'.htmlspecialchars($_GET['qtype']).'"/>';
	
	$game -> init();

}

else
{
	echo "<center><h3>Выберите предмет</h3></center>";
	$dir = "pages/apps/sources";

	$apps_files = scandir($dir);

	for($i=2; $i<count($apps_files); $i++)
	{
		include("pages/apps/sources/".$apps_files[$i]."/".$apps_files[$i].".php");
	
		$app_class = new $apps_files[$i]();
	
		print("<table>");
		print("<tr>");
		print("<td>");
	
		$app_class -> Out();
	
		print("</td>");
		print("</tr>");
		print("</table>");
	}
}
?>
