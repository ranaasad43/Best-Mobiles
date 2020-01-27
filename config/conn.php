<?php 
	
	$conn = mysqli_connect('localhost','root','','bestmobiles');

	if(!$conn){
		echo "db connection error:".mysqli_connect_error();
	}

	

 ?>