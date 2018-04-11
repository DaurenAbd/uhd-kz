<script type="text/javascript" src="jquery/jquery-ui-1.10.3.custom.min.js"></script>
<script type="text/javascript" src="jquery/jquery-1.9.1.js"></script>
<script type="text/javascript" src="jquery/jquery-ui-1.10.3.custom.js"></script>

<script>
function showaddres()
{
	$("#addres").toggle('slow');
}
</script>

<a href="#" onClick="showaddres();"><h3>Добавить результаты</h3></a>
<?php
include("pages/bd.php");
?>

<div id="addres" style="display:none;">

<form action="pages/newresults/newresults_ac_addnew.php" method="POST">

<b>Выберите пробник для которого нужно добавить результаты:</b><br>

<select name="probnik_id">
<?php
$prob_id_query = mys("SELECT * FROM `probniki` ");
while($prob_id = mysar($prob_id_query))
{
	$desc = $prob_id['desc'];
	$myid = $prob_id['id'];
	$addrt_q = mys("SELECT `probnik_id` FROM `results` WHERE `probnik_id`='$myid' ");
	$number_rows = mysql_num_rows($addrt_q);
	if($number_rows==0)
	{
	echo "<option value='".$myid."'>";
	echo $desc;
	echo "</option>";
	}
}
?>
</select>

<div id="addnewres">
<table>
<th>
<tr class="rowH">
<td>Ученик</td><td>Каз. язык</td><td>Рус. язык</td><td>Ист. Каз.</td><td>Матем.</td>
<td>5-ый предмет</td>

</tr>
</th>
<?php


$users_query = mys("SELECT * FROM `users` ");
$k=1;
while($users_data = mysar($users_query))
{
	$name = $users_data['name'];
	$surname = $users_data['surname'];
	$login = $users_data['login'];
	
	if($login != "anuarbek")
	{
	$r='"';
	
		if($k%2==0)echo "<tr class='rowA'>";else echo "<tr class='rowB'>";
		echo "<td>".$name." ".$surname."</td>";
		echo "<td><input type='text' id='newresultinput' class='kazdili".$login."' name='kazdili".$login."' /></td>";
		echo "<td><input type='text' id='newresultinput' name='rusdili".$login."' /></td>";
		echo "<td><input type='text' id='newresultinput' name='kaztar".$login."' /></td>";
		echo "<td><input type='text' id='newresultinput' name='matem".$login."' /></td>";
		echo "<td><input type='text' id='newresultinput' name='pan5".$login."' /></td>";
		echo "</tr>";
	}
	$k++;
}

?>
</table>
</div>

Перед добавлением, обязательно проверьте введенные данные!<br><br>
<input type="submit" style="padding:3px;" value="ДОБАВИТЬ РЕЗУЛЬТАТЫ">

</form>
</div>

<br><br>
<h3>Редактировать результаты</h3>

<?php

include("pages/bd.php");
$probniks_query = mys("SELECT * FROM `probniki` ");

echo "<table>";
while($prob_data = mysar($probniks_query))
{
	$myid2 = $prob_data['id'];
	$addrt_q = mys("SELECT `probnik_id` FROM `results` WHERE `probnik_id`='$myid2' ");
	$number_rows = mysql_num_rows($addrt_q);
	if($number_rows>0)
	{
	echo "<tr><td>".$prob_data['desc']."</td><td><a href='?page=editres&id=".$prob_data['id']."'><b>
	<font color='green'>Редактировать</font>
	</b></a></td></tr>";
	}
}
echo "</table>";
?>

