$(document).ready(function(){
	// BRINGING FULLSCREEN DIV TO THE FRONT
	$("#open-div-btn").click(function(){
		$("#fullscreen-div").fadeTo("fast",1,function(){
			$("#fullscreen-div").css("z-index","99");
			$("body").css("overflow","hidden");
		});
	});
	// SENDING FULLSCREEN DIV TO THE BACK
	$("#div-close").click(function(){
		$("#fullscreen-div").fadeTo("fast",0,function(){
			$("#fullscreen-div").css("z-index","-1");
			$("body").css("overflow","auto");
		});
	});
});