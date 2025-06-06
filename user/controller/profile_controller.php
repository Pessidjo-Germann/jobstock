<?php 

include('../actions/conbd.php'); 
$sql = "SELECT * FROM `users` WHERE `id` = ".$_SESSION['connect']['id']."";

    /* echo $sql;		
    exit; */
$query = mysqli_query($link,$sql);	
$nblignes=mysqli_num_rows($query);	
if($nblignes>0){
	$i=1;
	while($data = mysqli_fetch_array($query)){
		$_SESSION['connect'] = $data;
		// Get the JSON data
        $json_data = $_SESSION['connect']['social'];
        
        // Decode the JSON data
        $data_network = json_decode($json_data, true);
		$_SESSION['connect']['network'] = $data_network;
 	}
}	
?>