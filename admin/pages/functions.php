<?php
function mys($query)
{
	return mysql_query($query);
}
function mysar($qr)
{
	return mysql_fetch_array($qr);
}

function error($text)
{
	header("location: ../../index.php?page=error&error=".$text);
}

function p_path($page)
{
	return "pages/".$page."/".$page.".php";
}


?>