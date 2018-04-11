<h3>Добавить пробник</h3>

<br>
<form action="pages/addprob/addprob_ac_add.php" method="POST">
Введите название:<br>
<input type="text" name="prob">
<input type="submit" value="Добавить">
</form>

<br><br><br>
<h3>Удалить пробный экзамен</h3>
<b><font color="red">Внимание! Вместе с пробным экзаменом удалятся все связанные с ним результаты!</font></b>
<?php

include("pages/bd.php");
$probniks_query = mys("SELECT * FROM `probniki` ");

echo "<table>";
while($prob_data = mysar($probniks_query))
{
	echo "<tr><td>".$prob_data['desc']."</td><td><a href='pages/addprob/addprob_ac_delete.php?id=".$prob_data['id']."'><b>
	<font color='blue'>Удалить</font>
	</b></a></td></tr>";
}
echo "</table>";
?>