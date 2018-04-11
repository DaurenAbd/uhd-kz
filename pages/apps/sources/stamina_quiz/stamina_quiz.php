<?php
class stamina_quiz extends APPS
{
	public $sopos = array();
	public $PROPS = array();
	
	public function stamina_quiz()
	{
		$this->sopos['kaztar'] = "История Казахстана";
		$this->sopos['bio'] = "Биология";
		$this->sopos['geo'] = "География";
		$this->sopos['math'] = "Математика";
		$this->sopos['physics'] = "Физика";
		$this->sopos['kaztil'] = "Казахский язык";
		$this->sopos['rustil'] = "Русский язык";
	
		$this -> PROPS['desc']  = "Проверьте свою выносливость. Просто отвечайте на вопросы!";
		$this -> PROPS['screen'] = "pages/apps/screen/stamina_quiz.jpg";
		$this -> PROPS['name']   = "stamina_quiz";
		$this -> PROPS['appname'] = "Stamina quizzz!";
	}
	public function Out()
	{
		print ("<script src='pages/apps/sources/stamina_quiz/stamina_quiz.js'></script>");
		$query = mys("SELECT * FROM `questions` GROUP BY `topic` ");
		
		while($data = mysar($query)){
			$point = '"';
			print ("<a id = 'unique' href = '?page=apps&qtype=");
			print ($data['topic']);
			print("'><div class='pans0'>");
			print($this->sopos[$data['topic']]);
			print("</div></a>");
			print("<br>");
		}
	}
	
	public function init ()
	{
		$this -> include_js($this -> PROPS['name'], $this -> PROPS['name']);
		
		print ("<div id = 'gamediv'>");
		
		$this -> script("show_question();");

		print ("</div>");
		print("<input type='hidden' value='0' id='hidden_right' />");
		print("<input type='hidden' value='0' id='hidden_wrong' />");
		print("<br><p class='right'>Верно: <span>0</span></p><p class='wrong'>Неверно: <span>0</span></p>");
	}
	
	
}

?>