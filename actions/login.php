<?php
include('./conbd.php'); 

session_start();
// $_SESSION['user_id'];

$user_email = mysqli_real_escape_string($link, $_POST["user_email"]);


$sql_verification = "SELECT * FROM `users` WHERE `email` = '".$user_email."'";

/* echo $sql_verification;		
exit; */
$query_verification = mysqli_query($link,$sql_verification);	
$nblignes_verification=mysqli_num_rows($query_verification);	
if($nblignes_verification==0){
    $message = '../signup.php?message="Compte n\'est pas notre base de donnee"';
    header("Location: " . $message);
    exit; // Stop further execution
}
$password_email = mysqli_real_escape_string($link, $_POST["password_email"]);


$sql = "SELECT * FROM `users` WHERE `email` = '".$user_email."' AND `password` ='".$password_email."'";

    /* echo $sql;		
    exit; */

$query = mysqli_query($link,$sql);	
$nblignes=mysqli_num_rows($query);	
if($nblignes>0){
    $data = mysqli_fetch_array($query);
    $_SESSION['connect'] = $data;
    // Get the JSON data
    $json_data = $_SESSION['connect']['social'];
    // Decode the JSON data
    $data_network = json_decode($json_data, true);
    $_SESSION['connect']['network'] = $data_network;
 
    header("location:../user/");
    exit;
}else{
    header("location:../signup.php");
    exit;
}