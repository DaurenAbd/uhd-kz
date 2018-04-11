<?php


$current_user=$_SESSION['login'];
?>
<input type="hidden" id="user" value="all" />
<input type="hidden" id="tab" value="all" />
<input type="hidden" id="current_user" value="<?php echo $current_user; ?>" />

<link rel="stylesheet" href="pages/chat/chat/chat.css" type="text/css" />

<script type="text/javascript" src="http://www.google.com/jsapi"></script>
	<script type="text/javascript">
		google.load("jquery", "1.3.2");
		google.load("jqueryui", "1.7.2");
	</script>	
	
<script type="text/javascript" src="pages/chat/chat/chat_functions.js"></script>
<script type="text/javascript" src="pages/chat/chat/app_functions.js"></script>

<script type="text/javascript">
var user=$("#user").val();
setInterval(load_messes,3000);
load_messes();
who_online();
setInterval(who_online,5000);
</script>
<br /><br />

<div id="chat_cover">

<table id="chat_table">

<tr><td>
<div id="tabs">
<span id="private_tab" class="all"><a href="#" class="tab" onClick="to_all_chat_span();" >Общий чат</a></span>
</div>
</td>
<td>
<div id="online_list_header">
ОНЛАЙН
</div>
</td>
</tr>

<tr><td>

<div id="messages">
</div>
</td><td>

<div id="online_list">
</div>
</td></tr>

<tr bgcolor="#88AADD"><td>
<div id="send_form">
<form action="javascript:send();" method="POST" id="mess_form">
<input type="text" id="mess_to_send" />
<input type="submit" value="Отправить"/>
</form>
</div>
</td>
<td>
</td>
</tr>
</table>

</div>
<?php
if(isset($_GET['openpriv']))
{
	$opriv = trim(htmlspecialchars(strip_tags($_GET['openpriv'])));
	include("pages/bd.php");
	$usequer = mys("SELECT `login` FROM `users` WHERE `login`='$opriv' ");
	$num = mysql_num_rows($usequer);
	if($num>0)
	{
		echo "<script>open_private('".$opriv."');</script>";
	}
}
?>