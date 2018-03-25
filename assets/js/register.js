$(document).ready(function()
{
	//get base_url
	var base_url = $('#hidden_base_url').val();

	$('#uname, #uemail').blur(function()
	{
		var uname = $("#uname").val();
		var email = $("#uemail").val();
		
		if (uname != "")
		{
			ajax_check_user(uname);
		}
		if (email != "")
		{
			ajax_check_user(email);
		}
	});

	function ajax_check_user(uname)
	{
		var dataSet = {
			param: uname
		};

		var dataSentUlr = base_url+'handlers/user_handler.php';

		$.ajax({
			type : 'POST', 
			data : dataSet,
			url  : dataSentUlr,
			dataType : 'json',
			success: function(res)
			{
				if (res.status == 'error')
				{
					if (res.param_type == "username")
					{
						$('#uname_error_message').html(res.msg);
						$("input[type=submit]").attr("disabled", true);
					}
					else if (res.param_type == "email")
					{
						$('#email_error_message').html(res.msg);
						$("input[type=submit]").attr("disabled", true);	
					}
				}
				else
				{
					if (res.param_type == "username")
					{
						$('#uname_error_message').html("");
						$("input[type=submit]").attr("disabled", true);
					}
					else if (res.param_type == "email")
					{
						$('#email_error_message').html("");
						$("input[type=submit]").attr("disabled", true);	
					}
					// $("input[type=submit]").attr("disabled", false);
				}
			}
		});
	}
});