<div id="tablehost"><?phpinclude("pages/bd.php");function own($login){	if($login==$_SESSION['login'])	{		return true;	}return false;}$login="a";if(isset($_GET['user']))$login=trim(htmlspecialchars(strip_tags($_GET['user'])));else $login=$_SESSION['login'];if(strlen($login)<2){	echo "<font color='red'><b>Такого пользователя не существует!</b></font>";}else{$user_query=mys("SELECT * FROM `users` WHERE `login`='$login' ");$num = mysql_num_rows($user_query);if($num==0)echo "<font color='red'><b>Такого пользователя не существует!</b></font>";else{$user_data = mysar($user_query);?><center><h3>Профиль пользователя <?php echo $user_data['surname']." ".$user_data['name'];?></h3></center><?phpif(own($login)){?><table><form action="pages/profile/profile_ac_update.php" method="POST"><input type="hidden" name="login" value="<?php echo $login;?>"><tr><td>Имя:</td><td><input type="text" name="name" value="<?php echo $user_data['name'];?>"></td></tr><tr><td>Фамилия: </td><td><input type="text" name="surname" value="<?php echo $user_data['surname'];?>"></td></tr><tr><td>Почта: </td><td><input type="text" name="email" value="<?php echo $user_data['email'];?>"></td></tr><tr><td><input type="submit" value="Сохранить"></td><td></td></tr></form></table><form action="pages/profile/profile_pass_update.php" method="POST"><input type="hidden" name="login" value="<?php echo $login;?>"><center><h3>Изменить пароль</h3></center><table><tr><td>Старый пароль:</td><td><input type="password" name="oldpassword"></td></tr><tr><td>Новый пароль:</td><td><input type="password" name="newpassword"></td></tr><tr><td>Еще раз новый пароль:</td><td><input type="password" name="renewpassword"></td></tr><tr><td><input type="submit" value="Изменить пароль"></td><td></td></tr></table></form><?php}else{?><table><tr><td>Имя:</td><td><?php echo $user_data['name']; ?></td></tr><tr><td>Фамилия:</td><td><?php echo $user_data['surname']; ?></td></tr><tr><td>Почта:</td><td><?php echo $user_data['email']; ?></td></tr></table><?php}?><?php}?><div id="graph"><center><h3></h3></center><table id="reses">	<caption></caption>	<thead>		<tr>			<td></td>		<?php			$kazdili;			$rusdili;			$kaztar;			$matem;			$pan5;			$res_prob_query = mys("SELECT * FROM `results` WHERE `login`='$login' ORDER BY `id`");						$k=0;						while($probnik_id = mysar($res_prob_query))			{				$prob_id = $probnik_id['probnik_id'];								$kazdili[$prob_id]=$probnik_id['kazdili'];				$rusdili[$prob_id]=$probnik_id['rusdili'];				$kaztar[$prob_id]=$probnik_id['kaztar'];				$matem[$prob_id]=$probnik_id['matem'];				$pan5[$prob_id]=$probnik_id['pan5'];								$ides[$k]=$prob_id;								$prob_desc_query = mys("SELECT `desc` FROM `probniki` WHERE `id`='$prob_id' ");				$prod_desc = mysar($prob_desc_query);				$prob_description = $prod_desc['desc'];								echo "<th scope='col'>".$prob_description."</th>";				$k++;			}					?>								</tr>	</thead>	<tbody>		<tr>			<th scope="row">Каз. язык</th>			<?php			for($i=0; $i<$k; $i++)			{				$pid = $ides[$i];				echo "<td>".$kazdili[$pid]."</td>";			}			?>		</tr>		<tr>			<th scope="row">Рус. язык</th>			<?php			for($i=0; $i<$k; $i++)			{				$pid = $ides[$i];				echo "<td>".$rusdili[$pid]."</td>";			}			?>		</tr>		<tr>			<th scope="row">Ист. Казахстана</th>			<?php			for($i=0; $i<$k; $i++)			{				$pid = $ides[$i];				echo "<td>".$kaztar[$pid]."</td>";			}			?>		</tr>		<tr>			<th scope="row">Матем.</th>			<?php			for($i=0; $i<$k; $i++)			{				$pid = $ides[$i];				echo "<td>".$matem[$pid]."</td>";			}			?>		</tr>			<tr>			<th scope="row">5-ый предмет</th>			<?php			for($i=0; $i<$k; $i++)			{				$pid = $ides[$i];				echo "<td>".$pan5[$pid]."</td>";			}			?>		</tr>				</tbody></table>	</div><?php//Выводим график}?></div>  <link type="text/css" rel="stylesheet" href="css/visualize.jQuery.css"><script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script><script type="text/javascript" src="js/visualize.jQuery.js"></script><script>$('#reses').visualize();</script>