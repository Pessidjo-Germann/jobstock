<?php

	$servername_db = "localhost";
	$username_db = "root";
	$password_db = "";
	$database_name_db="digexbooker";
	
	// Create connection
	$link = mysqli_connect($servername_db,$username_db,$password_db ,$database_name_db);

	// Check connection
	if (!$link){
		die("Connection failed: " . mysqli_connect_error());
	}
	
	// permet de forcer les caractères accentués et spéciaux
	// mysqli_set_charset($link, "utf8");
	mysqli_set_charset($link, "utf8mb4");  
	  
?>


 