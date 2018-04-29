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
	// save acc changes
	$("#save-btn").click(function(){
		var full_name = $("#full_name").val().split(" ");
		var f_name_new = full_name[0];
		var l_name_new = full_name[1];
		var e_mail_new = $("#e_mail").val();
		var username_new = $("#username").val();
		$.post("scripts/save_acc_changes.php",
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
	$("#change-pass-btn").click(function(){ // change pass
		var curr_pass = $("#curr_pass").val();
		var new_pass  = $("#new_pass").val();
		var new_pass_repeat = $("#new_pass_repeat").val();
		if(curr_pass.length > 0 && new_pass == new_pass_repeat && new_pass.length >= 8 && hasNumber(new_pass) == true){
			$.post("scripts/change_pass.php",
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
	// show warning div
	// BRINGING FULLSCREEN DIV TO THE FRONT
	$("#del-acc").click(function(){
		$("body").css("overflow","hidden");
		$("#warning-div-wrapper").fadeTo("fast",1,function(){
			$("#warning-div-wrapper").css("z-index","99");
		});
	});
	// SENDING FULLSCREEN DIV TO THE BACK
	$("#close-warning").click(function(){
		$("body").css("overflow","auto");
		$("#warning-div-wrapper").fadeTo("fast",0,function(){
			$("#warning-div-wrapper").css("z-index","-1");
		});
	});
	// ajax to delete acc
	$("#del-acc-perm").click(function(){
		$.ajax({
			url: "delete_acc.php",
			type: "POST",
			success: function(data){
				// full success
				if(data == 1){
					$("#back-info-del").html("Account now deleted, logging out...");
				}
				// partial pass
				if(data == 2){
					$("#back-info-del").html("Account deleted, but some pictures are still here! Nevermind, we will clean this up for you...");
				}
				// error
				if(data == -1){
					$("#back-info-del").removeClass("text-green");
					$("#back-info-del").addClass("text-red");
					$("#back-info-del").html("There was an error, try again later!");
				}
				alert(data);
			}
		});
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