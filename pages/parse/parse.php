<html>
	
	<form method="POST" name="Form" action="pages/parse/actions/add.php">
		
		Вопрос:
		<br>
		<textarea cols=20 rows=8 name="quest">
		</textarea>
		
		<br>
		Сокращение от предмета (math, bio, kaztar):<br>
		<input type="text" name="topic">
		
		<br>
		Вопрос 1<br>
		<input type="text" name="ans1">
		<input type="checkbox" value="1" name="right">
		
		<br>
		
		Вопрос 2<br>
		<input type="text" name="ans2">
		<input type="checkbox" value="2" name="right">
		
		<br>
		
		Вопрос 3<br>
		<input type="text" name="ans3">
		<input type="checkbox" value="3" name="right">
		
		<br>
		
		Вопрос 4<br>
		<input type="text" name="ans4">
		<input type="checkbox" value="4" name="right">
		
		<br>
		
		Вопрос 5<br>
		<input type="text" name="ans5">
		<input type="checkbox" value="5" name="right">
		<br>
		<input type="submit" value="Добавить">
		
	</form>
	
	<br>
	
</html>

kaztar = "История Казахстана"; <br>
bio = "Биология";<br>
geo = "География";<br>
math = "Математика";<br>
physics = "Физика";<br>
kaztil = "Казахский язык";<br>
rustil = "Русский язык";<br>