function show_question()
{
	var qtype = $("#qtype").val();
	 $.ajax({
                type: "POST",
                url:  "pages/apps/sources/stamina_quiz/actions/get_question.php",
                data: "qtype="+qtype,
				beforeSend: function()
				{
					$("#gamediv").css('opacity','0.3');
					$("#wait").css('display','block');
				},
                success: function(html)
                {
                                $("#gamediv").css('display','none');
								$("#gamediv").empty();
								$("#gamediv").append(html);
								$("#wait").css('display','none');
								$("#gamediv").css('opacity','1');
								$("#gamediv").slideToggle('slow');
                },
                error: function()
                {
                }
            });
}

function checkans(myid)
{
	var checked = $("#checked").val();
	var corrans = $("#corrans").val();
	
	if(checked=="false")
	{
		if(corrans==myid)
		{
			$("#ans"+myid).css('background-color', 'green');
			$("#checked").val("true");
			var right = $("#hidden_right").val();
			right = parseInt(right,10);
			right += 1;
			$(".right span").empty();
			$(".right span").append(right);
			$("#hidden_right").val(right);
			setTimeout(show_question, 2000);
		}
		else
		{
			$("#ans"+myid).css('background-color', 'red');
			$("#ans"+corrans).css('background-color', 'green');
			$("#checked").val("true");
			var wrong = $("#hidden_wrong").val();
			wrong = parseInt(wrong,10);
			wrong += 1;
			$(".wrong span").empty();
			$(".wrong span").append(wrong);
			$("#hidden_wrong").val(wrong);
			setTimeout(show_question, 2000);
		}
	}
}