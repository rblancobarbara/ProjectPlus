$(document).ready(function(){
	$("#log-in-form").submit(function(){
		return ValidateInput();
	});
	$("input").focus(function(){
		if($(this).css("border") != "1px solid rgb(255, 0, 0)"){
			$(this).css("border","1px solid #5993E5");
		}
	});
	$("input").blur(function(){
		if($(this).css("border") != "1px solid rgb(255, 0, 0)"){
			$(this).css("border","1px solid #d2d2d2");
		}
	});
	$("input").on("input",function(){
		ResetBorder(this);
	});
});
function ValidateInput(){
	var pass = true;
	var username = $("input[name=username]").val();
	var password = $("input[name=password]").val();
	if(username.length == 0){
		$("input[name=username]").css("border","1px solid red");
		pass = false;
	}
	if(password.length == 0){
		$("input[name=password]").css("border","1px solid red");
		pass = false;
	}
	return pass;
}
function ResetBorder(element){
	$(element).css("border","1px solid #5993E5");
}