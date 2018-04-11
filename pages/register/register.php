
<?php
if(isset($_SESSION['login']))
{
	echo("Вы уже авторизованы!");
}
else
{
?>
<h2>Регистрация</h2>
<h3>(Указывайте правильные данные для верного просчета статистики!)</h3>

<form action="pages/register/register_ac_1.php" method="POST">

<table>

<tr>

<td>Логин:</td>
<td>
<input type="text" name="login1">
</td>

</tr>

<tr>

<td>Пароль:</td>
<td>
<input type="password" name="password1">
</td>

</tr>

<tr>

<td>
Повторите пароль:
</td>
<td>
<input type="password" name="repassword">
</td>

</tr>

<tr>

<td>
Имя:
</td>
<td>
<input type="text" name="name">
</td>

</tr>

<tr>

<td>
Фамилия:
</td>
<td>
<input type="text" name="surname">
</td>

</tr>

<tr>

<td>
E-mail:
</td>
<td>
<input type="text" name="email">
</td>

</tr>

<tr>

<td>
Кто Вы?
</td>
<td>
<select name="type">
<option value="student">Ученик</option>
<option value="parent">Родитель</option>
<option value="teacher">Учитель</option>
</select>
</td>

</tr>

<td>
</td>
<td>
<input type="submit" value="Зарегистрироваться">
</td>

</tr>

</tr>

</table>
<?php
}
?>
