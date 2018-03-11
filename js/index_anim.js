$(document).ready(function(){
	// add type to top text
	var typed = new Typed('#typed', {
	  strings: ["THINK.","CREATE.","SHARE."],
	  startDelay: 800,
	  backDelay:2000,
	  backSpeed: 40,
	  typeSpeed: 60,
	  loop: true
	});
	// fade in the image from left
	$(".image-holder").addClass("animated fadeInLeft");
	// fade in top text from right
	$("#tcs").addClass("animated fadeInRight");
	// fade in bottom text
	$("#tpwict").addClass("animated fadeIn");
	//think create share div add fade in
	$(".step").addClass("animated fadeIn");
	// add fade in from right to mission header
	$("#our-mission-h").addClass("animated fadeInRight");
	// add fade in from left to mission text
	$("#mission-p").addClass("animated fadeInLeft");
	// add fade in from left to even team memebers
	$(".team-memeber-even").addClass("animated fadeInLeft");
	// add fade in from tight to odd team memebers
	$(".team-memeber-odd").addClass("animated fadeInRight");
});