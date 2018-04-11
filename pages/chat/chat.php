<html>
 
<title>Чат</title>
 
<head>
</head>
 
<body>
<?php
//Запускаем сессию для работы с кукис файлами
session_start();
//Если отсутствуют логин и айди,
//отображаем форму входа и регистрации
if(!isset($_SESSION['login']) || !isset($_SESSION['status']))
{
?>
Авторизуйтесь или зарегистрируйтесь!
<?php
}
//Если сессия запущена, то есть присутствуют файлы 
//кукис, и в них есть логин и айди
//то отображаем профиль пользователя
//Для этого достаем из базы все данные по логину
//и выводим их на странице
if(isset($_SESSION['login']) && isset($_SESSION['status']))
{
    include("pages/bd.php");
	include_once("pages/chat/chat/main.php");
}
?>
</body>
 
</html>