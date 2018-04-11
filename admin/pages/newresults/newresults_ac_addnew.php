<?php

include("../bd.php");
include("../functions.php");

$users_query = mys("SELECT `login` FROM `users` ");
$probnik_id = $_POST['probnik_id'];


if($probnik_id != 0)
{

while($users_data = mysar($users_query))
{
	$login = $users_data['login'];
	
	if($login != "anuarbek")
	{	
		$kazdili = $_POST['kazdili'.$login];
		$rusdili = $_POST['rusdili'.$login];
		$kaztar = $_POST['kaztar'.$login];
		$matem = $_POST['matem'.$login];
		$pan5 = $_POST['pan5'.$login];
		$total = $kazdili+$rusdili+$kaztar+$matem+$pan5;
	
		$ins_res = mys("INSERT INTO `results` (`login`,`kazdili`,`rusdili`,`kaztar`,`matem`,`pan5`, `total`, `probnik_id`)
					VALUES ('$login','$kazdili','$rusdili','$kaztar','$matem','$pan5', '$total', '$probnik_id')
		");
	
		if($ins_res)
		{
			error("Результаты успешно добавлены!");
		}
		else
		{
			error("Не удалось добавить результаты. Обратитесь к администратору.");
		}
	}	
}
}
else
{
	error("Выберите верный пробный экзамен!");
}
?>