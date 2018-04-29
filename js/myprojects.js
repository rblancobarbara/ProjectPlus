$(document).ready(function(){
	$("#projects-list").load("scripts/load_my_projects.php");
});
function OpenDropdown(id) {
	document.getElementById("myDropdown"+id).classList.toggle("show");
}
window.onclick = function(event) {
  if (!event.target.matches('.drop-p')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}