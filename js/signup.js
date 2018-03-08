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
});