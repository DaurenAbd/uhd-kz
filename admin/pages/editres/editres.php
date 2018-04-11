

<?php

include("pages/bd.php");
$myid = $_GET['id'];

$res_query = mys("SELECT * FROM `results` WHERE `probnik_id`='$myid' ");
$num = mysql_num_rows($res_query);

if($num==0)echo "<font color='red'><b>Вы еще не добавили результаты для этого экзамена!</b></font>";
else
{
?>
<form action="pages/editres/editres_ac_update.php" method="POST">
<input type="hidden" name="probnik_id" value="<?php echo $_GET['id']?>">
<table>
<th>
<tr class="rowH">
<td>Ученик</td><td>Каз. язык</td><td>Рус. язык</td><td>Ист. Каз.</td><td>Матем.</td>
<td>5-ый предмет</td>

</tr>
</th>
<?php

while($d = mysar($res_query))
{
	$login = $d['login'];
	$rty = mys("SELECT * FROM `users` WHERE `login`='$login' ");
	$data = mysar($rty);
	
	$name=$data['name'];
	$surname=$data['surname'];
	$kazdili=$d['kazdili'];
	$rusdili=$d['rusdili'];
	$kaztar=$d['kaztar'];
	$matem=$d['matem'];
	$pan5=$d['pan5'];
	
	if($k%2==0)echo "<tr class='rowA'>";else echo "<tr class='rowB'>";
	echo "<td>".$name." ".$surname."</td>";
	echo "<td><input type='text' id='newresultinput' name='kazdili".$login."' value='".$kazdili."' /></td>";
	echo "<td><input type='text' id='newresultinput' name='rusdili".$login."' value='".$rusdili."' /></td>";
	echo "<td><input type='text' id='newresultinput' name='kaztar".$login."' value='".$kaztar."' /></td>";
	echo "<td><input type='text' id='newresultinput' name='matem".$login."' value='".$matem."' /></td>";
	echo "<td><input type='text' id='newresultinput' name='pan5".$login."' value='".$pan5."' /></td>";
	echo "</tr>";
	$k++;
}

?>

</table>

Перед обновлением, обязательно проверьте введенные данные!<br><br>
<input type="submit" style="padding:3px;" value="ОБНОВИТЬ РЕЗУЛЬТАТЫ">

</form>
<?php
}
?>