$(document).ready(function(){
	$("#fileToUpload").change(function(){
		$("#profile_preview").attr("src", $("#fileToUpload").val());
		var input = this;
    	var url = $(this).val();
		var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
	    if (input.files && input.files[0]&& (ext == "png" || ext == "jpeg" || ext == "jpg")) 
	     {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	           $('#profile_preview').attr('src', e.target.result);
	        }
	       	reader.readAsDataURL(input.files[0]);
	    }
	    else
	    {
	      $('#profile_preview').attr('src', '/project+/website_picture/default_profile.png');
	    }
	});
	// form
	$("#sign-up-form").submit(function(){
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
	var first_name = $("input[name=first_name]").val();
	var last_name = $("input[name=last_name]").val();
	var email = $("input[name=email]").val();
	var username = $("input[name=username]").val();
	var password = $("input[name=password]").val();
	var password_repeat = $("input[name=password_repeat]").val();
	if(!TestOnlyLetters(first_name) || first_name.length == 0){
		$("input[name=first_name]").css("border","1px solid red");
		pass = false;
	}
	if(!TestOnlyLetters(last_name) || last_name.length == 0){
		$("input[name=last_name]").css("border","1px solid red");
		pass = false;
	}
	if(!validateEmail(email) || email.length == 0){
		$("input[name=email]").css("border","1px solid red");
		pass = false;
	}
	if(username.length == 0){
		$("input[name=username]").css("border","1px solid red");
		pass = false;
	}
	if(password.length == 0){
		$("input[name=password]").css("border","1px solid red");
		pass = false;
	}
	if(password_repeat.length == 0){
		$("input[name=password_repeat]").css("border","1px solid red");
		pass = false;
	}
	if(password != password_repeat){
		$("input[name=password]").css("border","1px solid red");
		$("input[name=password_repeat]").css("border","1px solid red");
		pass = false;
	}
	return pass;
}
function ResetBorder(element){
	$(element).css("border","1px solid #5993E5");
}
function TestOnlyLetters(string){
	return /^[A-Za-z ]+$/.test(string);
}
function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}