<?php

include("pages/bd.php");

$art_query = mys("SELECT * FROM `news` ORDER BY `date` DESC");

while($data = mysar($art_query))
{
	echo "<blockquote>".$data['title']."</blockquote>";
	echo "<br>";
	echo "<div style='border:1px solid silver;padding:10px;margin-top:-35px;'>".$data['text']."</div>";
	echo "<br>";
	echo "<p align='right'>".$data['date']."</p>";
}

?>

