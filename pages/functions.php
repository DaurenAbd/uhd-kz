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

function first_s ($str)
{
	$str = iconv ("utf-8","windows-1251",$str);
		$per_s = $str[0];
		$per_s = iconv("windows-1251", "utf-8",$per_s);
		return $per_s;
}

?>