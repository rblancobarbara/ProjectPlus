$(document).ready(function(){
	$("#logo").click(function(){
		if(window.location.pathname != "/project+/index.php" && window.location.pathname != "/project+/"){
			window.location.href = "index.php";	
		}
	});
	// BULB LIGHTING UP ON HOVER OVER LOGO
	$("#slide-logo").mouseover(function(){
		$("#slide-logo").attr("src","/project+/website_pictures/logo-blue-lights-on.png");
	});
	$("#slide-logo").mouseleave(function(){
		$("#slide-logo").attr("src","/project+/website_pictures/logo.png");
	});
	$("#logo").mouseover(function(){
		$("#logo").attr("src","/project+/website_pictures/logo-lights-on.png");
	});
	$("#logo").mouseleave(function(){
		$("#logo").attr("src","/project+/website_pictures/logo-white.png");
	});
	// SLIDING MENU
	$("#collapse-menu-btn").html("&#9776;");
	$("#collapse-menu-btn").click(function(){
		if($("#sliding-menu-list").css("display") == "none"){
			$("#sliding-menu").animate({"width":"250px"},"fast","swing");
			$("#sliding-menu-list").css("display","block");
			$("#collapse-menu-btn").html("&#9747;");
		}
		else{
			$("#sliding-menu").animate({"width":"0px"},"fast","swing");
			$("#sliding-menu-list").css("display","none");
			$("#collapse-menu-btn").html("&#9776;");
		}
	});
});