<?php
//error_reporting(0);
session_start();
$login = $_SESSION['login'];

include_once("pages/bd.php");
include_once("pages/functions.php");
?>

<html>
<head>
<meta charset="utf-8"> 
<title>Дайындық</title>
<script src = "jquery/jquery-1.9.1.js"></script>
<script src = "jquery/jquery-ui-1.10.3.custom.js"></script>
<script src = "jquery/jquery-ui-1.10.3.custom.min.js"></script>
<link href="default.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="outer">
	<div id="header">
		<h1><a href="index.php">ҰБТ 2014</a></h1>
		<h2>11 "А"</h2>
	</div>
	<div id="menu">
		<ul>
			<li class="first"><a href="index.php" accesskey="4" title="">Главная</a></li>
			<li><a href="?page=news" accesskey="1" title="">Новости</a></li>
			
			<?php if(!isset($_SESSION['login']))
			{
			?>
			<li><a href="?page=register" accesskey="2" title="">Регистрация</a></li>
			<?php
			}
			else
			{
				$m=mys("SELECT `text` FROM `messages` WHERE `to`='$login' AND `shown`='0'");
				$total = mysql_numrows($m);
			?>
			<li><a href="?page=profile&user=<?php echo $login;?>" accesskey="2" title="">Мой профиль</a></li>
			<?php
			}
			?>
			<li><a href="?page=chat" accesskey="4" title="">Чат
			<?php
			if($total>0)echo "(".$total." NEW)";
			?>
			</a></li>
			<li><a href="?page=order" accesskey="5" title="">Список учеников</a></li>
			<li><a href="?page=apps" accesskey="6" title="">Вопросы</a></li>
		</ul>
	</div>
	<div id="content">
		<div id="tertiaryContent">
		<?php
		if($_GET['page']!="chat")
		{
			echo "<h3>Последние сообщения</h3><p>";
			$mes_query = mys("SELECT * FROM `messages` WHERE `to`='all' ORDER BY `id` DESC LIMIT 10");
			while($mess_data = mysar($mes_query))
			{
			
				$qas = $mess_data['from'];
				$login_query = mys("SELECT `name`,`surname` FROM `users` WHERE `login`='$qas' ");
				$us_d = mysar($login_query);
				$name = $us_d['name'];
				$surn = $us_d['surname'];
		
				$per_s = first_s($surn);
			
				$mess_data['text'] = iconv("windows-1251", "utf-8", $mess_data['text']);
				echo "<b>".$name." ".$per_s.".</b> : ".$mess_data['text']."<br />";
			}
			echo "</p><div class='xbg'></div>";
		}
		?>
			
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
