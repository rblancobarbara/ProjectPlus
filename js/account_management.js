$(document).ready(function(){
	var f_name;
	var l_name;
	var e_mail;
	var username;
	$("#save-btn").prop("disabled",true); //by default save changes button is disabled
	$("#save-btn").css("background-color","grey");
	$("input").change(function(){
		if(CheckForChange(f_name,l_name,e_mail,username)){ // when input is changed and if new input is not same as the loaded one, button is enabled to save
			$("#save-btn").prop("disabled",false);
			$("#save-btn").css("background-color","#5993E5");
		}
		else{
			$("#save-btn").prop("disabled",true);
			$("#save-btn").css("background-color","grey");
		}
	});
	$("#save-btn").click(function(){
		var full_name = $("#full_name").val().split(" ");
		var f_name_new = full_name[0];
		var l_name_new = full_name[1];
		var e_mail_new = $("#e_mail").val();
		var username_new = $("#username").val();
		$.post("save_acc_changes.php",
			{
				f_name: f_name_new,
				l_name: l_name_new,
				e_mail: e_mail_new,
				username_new: username_new

			},
			function(data,status){
				if(data == 1){
					alert("Changes saved successfully.");
					location.reload();
				}
				if(data == 2){
					alert("Something went wrong, please try again later! Thank you!");
				}
			});
	});
	$.get("get_account_info.php",function(data,status){ //gets acc info
		var vardata = data;
		var info_array = vardata.split(",",4);
		f_name = info_array[0];
		l_name = info_array[1];
		e_mail = info_array[2];
		username = info_array[3];
		$("#full_name").val(f_name + " " + l_name);
		$("#e_mail").val(e_mail);
		$("#username").val(username);
	});
	$("#change-pass-btn").click(function(){ // change pass
		var curr_pass = $("#curr_pass").val();
		var new_pass  = $("#new_pass").val();
		var new_pass_repeat = $("#new_pass_repeat").val();
		if(curr_pass.length > 0 && new_pass == new_pass_repeat && new_pass.length >= 8 && hasNumber(new_pass) == true){
			$.post("change_pass.php",
			{
				old_pass: curr_pass,
				new_pass: new_pass
			},function(data,status){
				if(data == 1){
					alert("Password has been changed successfully! You can use it at your next log in.");
				}
				if(data == 2){
					alert("Something went wrong. Try again later. Thank you :)")
				}
			}
			);
		}
		else{
			var error_message = "";
			if(curr_pass.length == 0){
				$("#curr_pass").css("background-color","#E5343A");
				$("#curr_pass_repeat").css("background-color","#E5343A");
				error_message += ("Passwords do not match\n");
			}
			if(new_pass != new_pass_repeat){
				$("#new_pass").css("background-color","#E5343A");
				$("#new_pass_repeat").css("background-color","#E5343A");
				error_message += ("Passwords do not match\n");
			}
			if(new_pass.length < 8){
				$("#new_pass").css("background-color","#E5343A");
				$("#new_pass_repeat").css("background-color","#E5343A");
				error_message += ("Password is too shot. Must be 8 characters or greater\n");
			}
			if(hasNumber(new_pass) == false){
				$("#new_pass").css("background-color","#E5343A");
				$("#new_pass_repeat").css("background-color","#E5343A");
				error_message += ("Password must contain at least 1 number\n");
			}
			alert(error_message);
		}
	});
});
function hasNumber(string) {
  return /\d/.test(string);
}
function CheckForChange(f_name,l_name,e_mail,username){
	//true if there has been a change, otherwise false
	var full_name = f_name + " " + l_name;
	if($("#full_name").val() != full_name || $("#e_mail").val() != e_mail || $("#username").val() != username){
		return true;
	}
	else{
		return false;
	}
}