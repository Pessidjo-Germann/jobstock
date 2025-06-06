<?php
include('./conbd.php'); 

mysqli_autocommit($link, false);
$detect_transaction_error = false;
$error_transaction=array();
$transaction_id = date('YmdHis')."_".rand(100, 999)."_".rand(100, 999);		

/* ======================================================================================================================== */
        /* =============================================== DEBUT INSERT  ====================================== */
/* ======================================================================================================================== */		

$nom = mysqli_real_escape_string($link, $_POST["nom"]);
$prenom = mysqli_real_escape_string($link, $_POST["prenom"]);

$email = mysqli_real_escape_string($link, $_POST["email"]);

$sql_verification = "SELECT * FROM `users` WHERE `email` = '".$email."'";

/* echo $sql;		
exit; */
$query_verification = mysqli_query($link,$sql_verification);	
$nblignes_verification=mysqli_num_rows($query_verification);	
if($nblignes_verification>0){
    header('location:../signup.php?message="Email deja utilisé"');
    exit;
}

$sexe = mysqli_real_escape_string($link, $_POST["sexe"]);

$pays = mysqli_real_escape_string($link, $_POST["pays"]);

$ville = mysqli_real_escape_string($link, $_POST["ville"]);

$password = mysqli_real_escape_string($link, $_POST["password"]);
$hashed_password = password_hash($password, PASSWORD_DEFAULT);


$number = mysqli_real_escape_string($link, $_POST["number"]);

$type = mysqli_real_escape_string($link, "user");
$langue = mysqli_real_escape_string($link, "francais");
$abonnement = mysqli_real_escape_string($link, "starter");
$created_at = mysqli_real_escape_string($link, date('Y-m-d H:i:s'));	

$sql = "INSERT INTO `users`( `nom`, `prenom`, 
                            `email`, `number`, `sexe`,`password`,
                            `type`, `langue`,  
                            `ville`, `pays`, 
                            `abonnement`, `created_at`,
                             `updated_at`) 
        VALUES ('".$nom."','".$prenom."',
                '".$email."','".$number."','".$sexe."','".$password."',
                '".$type."','".$langue."',
                '".$ville."','".$pays."',
                '".$abonnement."','".$created_at."',
                '".$created_at."')";

    /* echo $sql;		
    exit; */
$query = mysqli_query($link,$sql);	
$last_id = $link->insert_id;
if ($query) {
    echo "Insertion réussie !";
    echo $sql;

} else {
    echo "Erreur lors de l'insertion : " . mysqli_error($link);
}
if (!$detect_transaction_error) {	
    mysqli_commit($link);
    //echo "All queries were executed successfully";
}else{
    mysqli_rollback($link);
    //echo "All queries were rolled back";
}	
ob_clean();		
echo $reponse_json = json_encode($reponse, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE | JSON_FORCE_OBJECT);


session_start();

$_SESSION['connect']['id'] = $last_id;
header('location:../user/profile.php');
exit;