<script type="text/javascript" src="jquery/jquery-ui-1.10.3.custom.min.js"></script>
<script type="text/javascript" src="jquery/jquery-1.9.1.js"></script>
<script type="text/javascript" src="jquery/jquery-ui-1.10.3.custom.js"></script>


<script>
function showaddfile()
{
	$("#addfile").toggle('slow');
}
function waiter()
{
	$("#wait").innerHTML="<font color='red'><b>Подождите, файл загружается...</b></font>";
}
</script>

<a href="#" onClick="showaddfile();"><h4>Добавить файл</h4></a>

<div id="wait"></div>

<div id="addfile" style="display:none;">

<form action="pages/files/files_ac_upload.php" method="POST" ENCTYPE="multipart/form-data">
><b>Введите описание файла (обязательно!):</b>
<br>
Например: АТТ номер 13
<br>
<textarea cols=30 rows=4 name="desc" id="desc"></textarea>

<br>
<b>Выберите файл:</b>
<br>

<input id="file_upload" name="file_upload" type="file" multiple="true">
<br><br>
<input type="submit" value="Загрузить" style="padding:5px;" onClick="waiter();this.disable;">

</form>

<br>
<br>
<br><br>
	
</div>



<?php

include("pages/bd.php");


$files_query = mys("SELECT * FROM `files`");

print_r("<table style='border:1px silver solid;'>");
echo "<tr><td><b>Ссылка на файл</b></td><td><b>Описание файла</b></td></tr>";
while($files_data = mysar($files_query))
{
	$myid=$files_data['id'];
	if(!file_exists("../exams/".$files_data['link']))
	mys("DELETE FROM `files` WHERE `id`='$myid' ");

	echo "<tr><td><div style='width:300px;word-wrap:break-word;'>http://uhd.kz/exams/".$files_data['link']."</td><td>".$files_data['descrip']."</td>
	<td>
	<a href='pages/files/files_ac_delete.php?id=".$files_data['id']."'>
	<font color='red'><b>Удалить</b></font>
	</a>
	</td>
	</tr>";
	
	
}
print_r("</table>");
?>













