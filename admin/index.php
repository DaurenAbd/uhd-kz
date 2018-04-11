<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />

<title>Дайындық</title>

<link href="default.css" rel="stylesheet" type="text/css" />



</head>
<?php
error_reporting(0);
session_start();
include_once("pages/functions.php");
$login = $_SESSION['login'];

$statusqwe = $_SESSION['status'];
if($statusqwe != "admin")die();

?>

<body>
<div id="outer">
	<div id="header">
		<h1><a href="index.php">Панель управления</a></h1>
		<h2><a href="../index.php"><span style="color:white;">На сайт</span></a></h2>
	</div>
	<div id="menu">
		<ul>
			<li class="first"><a href="?page=add" accesskey="1" title="">Записи</a></li>
			<li><a href="?page=files" >Библиотека файлов</a></li>
			<li><a href="?page=newresults">Результаты</a></li>
			<li><a href="?page=addprob">Пробники</a></li>
			<li><a href="?page=notice">Уведомления</a></li>
		</ul>
	</div>
	<div id="content">
		<div id="tertiaryContent">
		
		</div>
		<div id="primaryContentContainer">
			<div id="primaryContent">
				
				<?php
				
				
				
				if(isset($_GET['page']))
				{
					$page=trim(htmlspecialchars(strip_tags($_GET['page'])));
				}
				else
				{
					$page="main";
				}
				
				if(file_exists(p_path($page)))
				{
					include_once(p_path($page));
				}
				else
				{
					echo "Такой страницы нет!";
				}
				
				?>
				
				
			</div>
		</div>
		<div id="secondaryContent">
			<?php
			include_once("pages/loginform/loginform.php");
			?>

			<div class="xbg"></div>
		</div>
		<div class="clear"></div>
	</div>
	<div id="footer">
	
	</div>
</div>
</body>
</html>
