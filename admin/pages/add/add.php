
<script type="text/javascript" src="jquery/jquery-ui-1.10.3.custom.min.js"></script>
<script type="text/javascript" src="jquery/jquery-1.9.1.js"></script>
<script type="text/javascript" src="jquery/jquery-ui-1.10.3.custom.js"></script>


<script type="text/javascript" src="ckeditor/ckeditor.js"></script>

<br>

<script>
function showaddart()
{
	$("#addart").toggle('slow');
}
</script>

<a href="#" onClick="showaddart();"><h4>Добавить запись</h4></a>

<div id="addart" style="display:none;">

<form action="pages/add/add_ac_addarticle.php" method="POST">


<input type="hidden" id="hdtext" name="hdtext">
<b>Заголовок записи:</b><br>
<input type="text" name="title" style="padding:3px;width:420px;"><br>
<b>Текст записи:</b><br>
<textarea name="text" id="text" cols=30 rows=10>
</textarea>

<script type="text/javascript">
CKEDITOR.replace( 'text',
{
toolbar:
        [
            ['Link', 'Image'],
            ['Bold', 'Italic', 'Underline', 'Strike', '-', 'Subscript', 'Superscript'],
            ['RemoveFormat','FontSize'],
			['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
			['Font'],
			[ 'TextColor','BGColor' ]
        ]
}
);
function reload_div(text)
{
			document.getElementById("hdtext").value=text;
            //рекурсивный вызов
            setTimeout('reload_div(CKEDITOR.instances.text.getData())', 200);
}
reload_div();
</script>

<input type="submit" style="padding:5px;" value="Добавить запись">
</form>

</div>

<br><br>
<?php

include("pages/bd.php");

$art_query = mys("SELECT * FROM `news` ORDER BY `date` DESC");

while($data = mysar($art_query))
{
	echo "<blockquote>".$data['title']."</blockquote>";
	echo "<br>";
	echo "<div style='border:1px solid silver;padding:10px;margin-top:-35px;'>".$data['text']."</div>";
	echo "<br>";
	echo "<p align='right'>".$data['date']."&nbsp;|&nbsp;<a href='pages/add/add_ac_delete.php?id=".$data['id']."'><font color='red'><b>Удалить</b></font></a></p>";
}

?>














