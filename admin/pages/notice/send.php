<?php

if(isset($_POST['email']))
{
	$email = $_POST['email'];
	
	//Отправляем письмо
	
	$mess = "Обязательно посмотрите новые события на сайте uhd.kz!";
	$mess = iconv("utf-8","windows-1251",$mess);
	
	if(mail($email, "Новые события uhd.kz!", $mess))
	echo $email." - <font color='green'><b>Успешно!</b></font><br>";
	else
	{
		echo $email." - <font color='red'><b>Не удалось отправить!</b></font><br>";
	}
	
}

?>