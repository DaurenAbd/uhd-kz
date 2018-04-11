<script type="text/javascript" src="jquery/jquery-ui-1.10.3.custom.min.js"></script>
<script type="text/javascript" src="jquery/jquery-1.9.1.js"></script>
<script type="text/javascript" src="jquery/jquery-ui-1.10.3.custom.js"></script>



<script>
function mailsphp()
	{
		  // Отсылаем паметры
       $.ajax({
                type: "POST",
                url: "pages/notice/contacts.php",
                data: "request=true",
                // Выводим то что вернул PHP
                success: function(html)
				{
					$("#users").empty();
					$("#users").append(html);
                }
        });
	}
	function finished()
	{
		$("#sendresults").append("Отправка закончена!<br>");
	}
	var str, kol, refreshIntervalId;
	function sendmail()
	{
		$.ajax({
                type: "POST",
                url: "pages/notice/send.php",
                data: "email="+str[r],
                // Выводим то что вернул PHP
                success: function(html)
				{
					$("#sendresults").append(kol-r+") "+html);
                }
			});
			r--;
			if(r==0)
			{
				clearInterval(refreshIntervalId);
				setTimeout(finished, 2000);
			}
	}
	function send()
	{
		$("#sendresults").append("Начинаем отправку сообщений...<br>");
		
		 str = $("#users").html();
		 str = str.split('#');
		
		 kol = str[0];
		 r= kol;
		 refreshIntervalId = setInterval(sendmail, 1500);
		 
	}
	mailsphp();
</script>

<a href="#" onClick="send();" ><h3><font color="red"><b>ОТПРАВИТЬ СООБЩЕНИЯ</b></font></h3></a>


<div id="users" style="display:none;">
</div>

<div id="sendresults">

</div>

