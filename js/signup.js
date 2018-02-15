$(document).ready(function(){
	$("#submit-btn").click(function(){
		$("#f_name").css("background-color","white");
		$("#l_name").css("background-color","white");
		$("#e_mail").css("background-color","white");
		$("#username").css("background-color","white");
		$("#password").css("background-color","white");
		$("#password_repeat").css("background-color","white");
		var f_name = $("#f_name").val();
		var l_name = $("#l_name").val();
		var e_mail = $("#e_mail").val();
		var username = $("#username").val();
		var password = $("#password").val();
		var password_repeat = $("#password_repeat").val();
		var ok = true;
		var final_message = "";
		if(f_name.length == 0 || l_name.length == 0 || e_mail.length == 0 || username.length == 0 || password.length == 0 || password_repeat.length == 0){
			ok = false;
			final_message += "There are empty fields!\r\n"
		}
		//proverava ime
		if(hasNumber(f_name) == true){
			$("#f_name").css("background-color","#E5343A");
			ok = false;
			final_message += "First name can not contain numbers\r\n";
		}
		//proverava prezime
		if(hasNumber(l_name) == true){
			$("#l_name").css("background-color","#E5343A");
			ok = false;
			final_message += "Last name can not contain numbers\r\n";
		}
		//proverava email
		if(CheckEmail(e_mail) == false){
			$("#e_mail").css("background-color","#E5343A");
			ok = false;
			final_message += "Email is incorrect\r\n";
		}
		//proverava username (ne sme da bude duzi od 16 karaktera)
		if(username.length > 16){
			$("#username").css("background-color","#E5343A");
			final_message += "Username must be less then 16 characters long.\r\n";
			ok = false;
		}
		//proverava sifru (minimum 8 karaktera, mora da ima bar jedan broj)
		if(password.length < 8 || hasNumber(password) == false){
			$("#password").css("background-color","#E5343A");
			final_message += "Password must be greater then 8 characters long and must contain at least 1 number.\r\n";
			ok = false;
		}
		if(password != password_repeat){
			$("#password").css("background-color","#E5343A");
			$("#password_repeat").css("background-color","#E5343A");
			final_message += "Passwords do not match\r\n";
			ok = false;
		}
		if(ok == true){
			$.post(
				"create_account.php",
				{
					first_name: f_name,
					last_name: l_name,
					email: e_mail,
					username: username,
					password: password,
					password_repeat: password_repeat
				},
				function(data,status){
					if(data == "1"){
						alert("Success creating an account!\r\nVerification email has been sent to " + e_mail);
					}
					if(data == "0"){
						alert("Something went wrong! :(");
					}
					if(data == "4"){
						alert("Email or username are already used");
						$("#username").css("background-color","#E5343A");
						$("#e_mail").css("background-color","#E5343A");
					}
					if(data == "2"){
						alert("Not all fields are filled!");
					}
					if(data.includes("Error:")){
						alert(data);
					}
				}
			);
		}
		else{
			alert(final_message);
		}
	});
});
function hasNumber(string) {
  return /\d/.test(string);
}
function CheckEmail(email){
	var includes_at = email.includes("@");
	var includes_dot = email.includes(".");
	var includes_zarez = email.includes(",");
	if(includes_at == true && includes_dot == true && includes_zarez == false){
		var at_ind = email.indexOf("@");
		var dot_ind = email.indexOf(".",at_ind+1);
		var left_sub = email.substring(0,at_ind);
		var right_sub = email.substring(at_ind+1,dot_ind);
		var after_sub = email.substring(dot_ind+1);
		var left_len = left_sub.length;
		var right_len = right_sub.length;
		var after_len = after_sub.length;

		if(left_len == 0 || right_len == 0 || after_len == 0 || after_len > 3){
			return false;
		}
	}
	else{
		return false;
	}
	return true;
}