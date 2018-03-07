<?php

class Project{
	var $id;
	var $holder_id;
	var $name;
	var $description;
	var $min_price;
	var $likes;
	var $saves;
	var $category;
	var $status;
	var $datetime;
	function __construct($id,$holder_id,$name,$description,$price,$likes,$saves,$category,$status,$datetime){
		$this->id = $id;
		$this->holder_id = $holder_id;
		$this->name = $name;
		$this->description = $description;
		$this->min_price = $price;
		$this->likes = $likes;
		$this->saves = $saves;
		$this->category = $category;
		$this->status = $status;
		$this->datetime = $datetime;
	}
	function GenerateCard(){
		$conn = new mysqli("localhost","root","","projectplus");
		$query = "SELECT url FROM project_pictures WHERE project_id = ?";
		$result_array = array();
		if($sql = $conn->prepare($query)){
			$sql->bind_param("i",$this->id);
			if($sql->execute()){
				$sql->store_result();
				$sql->bind_result($url);
				while($sql->fetch()){
					array_push($result_array,$url);
				}
				$sql->free_result();
			}
			$sql->close();
		}
		$conn->close();
		if(count($result_array) == 0){
			$result_array[0] = "website_pictures/no-image.jpg";
		}
		$status_tag = "";
		if($this->status == "Not verified" || $this->status == "Declined"){
			$status_tag = "<p id = 'status-text' class = 'text-red'>" . $this->status . "</p>";
		}
		if($this->status == "Private"){
			$status_tag = "<p id = 'status-text' class = 'text-grey'><span class = 'text-green'>Verfied</span>, " . $this->status . "</p>";
		}
		if($this->status == "Public"){
			$status_tag = "<p id = 'status-text' class = 'text-green'><span class = 'text-green'>Verfied</span>, " . $this->status . "</p>";
		}
		echo('<div class = "container project_card">
				<div class = "card-header">
					<div class="dropdown">
					  <p align = "right" onclick="OpenDropdown(' . $this->id . ')" class="text-blue drop-p">Options...</p>
					  <div id="myDropdown' . $this->id . '" class="dropdown-content">
					    <a href="generate_share_link.php?id=' . $this->id . '">Share</a>
					    <a href="edit_project.php?id=' . $this->id . '">Edit</a>
					    <a href="delete_project.php?id=' . $this->id . '">Delete</a>
					    <a href="change_privacy.php?set=Private&id=' . $this->id . '">Set private</a>
					    <a href="change_privacy.php?set=Public&id=' . $this->id . '">Set public</a>
					  </div>
					</div>
				</div>
				<hr class = "hr-black">
				<div class = "row">
					<div class = "col-md-6">

						<div id="carouselExampleIndicators' . $this->id . '" class="carousel slide" data-ride="carousel">
						<div class="carousel-inner" role="listbox">');
								echo('<div class="carousel-item active">
										<img class="d-block img-fluid" src="../' . $result_array[0] .'" alt="First slide">
									</div>');
							for($i = 1; $i < count($result_array);$i++){
								echo('<div class="carousel-item">
										<img class="d-block img-fluid" src="../' . $result_array[$i] .'" alt="First slide">
									</div>');
							}
						echo('</div> <!-- closes carousel-inner -->');
						if(count($result_array) > 1){
							echo('<a class="carousel-control-prev" href="#carouselExampleIndicators' . $this->id . '" role="button" data-slide="prev">
									<span class="carousel-control-prev-icon" aria-hidden="true"></span>
									<span class="sr-only">Previous</span>
								</a>
								<a class="carousel-control-next" href="#carouselExampleIndicators' . $this->id . '" role="button" data-slide="next">
									<span class="carousel-control-next-icon" aria-hidden="true"></span>
									<span class="sr-only">Next</span>
								</a>');
						}

					echo('</div> <!-- closes carousel -->
					</div> <!-- closes col-md-6 -->
					<div class = "col-md-6">
						<h2 align = "left">' . $this->name . '</h2>
						<p id = "price">Price: ' . $this->min_price . '&euro;</p>
						<p align = "right" id = "likes">' . $this->likes . ' <span class = "text-red">&#9825;</span></p><br>
						Status:' . $status_tag . '<br>
						</div>
				</div> <!-- closes row -->
			</div> <!-- closes container -->');
	}
}

?>