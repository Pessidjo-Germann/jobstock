<?php
include('./conbd.php'); 
session_start();
mysqli_autocommit($link, false);
$detect_transaction_error = false;
$error_transaction=array();
$transaction_id = date('YmdHis')."_".rand(100, 999)."_".rand(100, 999);		

/* ======================================================================================================================== */
        /* =============================================== DEBUT INSERT  ====================================== */
/* ======================================================================================================================== */		
if(isset($_GET['message'])){
    $user_id = mysqli_real_escape_string($link, $_POST["user_id_message"]);
    $type_message = mysqli_real_escape_string($link, "Message");
    $nom_message = mysqli_real_escape_string($link, string: $_POST["nom_message"]);
    $email_message = mysqli_real_escape_string($link, string: $_POST["email_message"]);
    $surjet_message = mysqli_real_escape_string($link, string: $_POST["surjet_message"]);
    $numero_message = mysqli_real_escape_string($link, string: $_POST["telephone_message"]);
    $message = mysqli_real_escape_string($link, string: $_POST["message_message"]);
    $service_id = mysqli_real_escape_string($link, string: $_POST["service_id_message"]);
   
    $created_at = mysqli_real_escape_string($link, date('Y-m-d H:i:s'));	

    $sql_update = "UPDATE `services` SET `applied_service`=(applied_service+1) WHERE `id` = $service_id ";
	$query_update = mysqli_query($link,$sql_update);

    $sql = "INSERT INTO `messages`(`user_id`, `type_message`, `nom_message`, 
                        `email_message`, `surjet_message`, `numero_message`, 
                        `message`, `service_id`, `created_at`) 
            VALUES ('".$user_id."','".$type_message."','".$nom_message."',
                    '".$email_message."','".$surjet_message."','".$numero_message."',
                    '".$message."','".$service_id."','".$created_at."')";

        /* echo $sql;		
        exit; */
    $query = mysqli_query($link,$sql);	
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

    header('location:../services.php');
    exit;
}



if(isset($_GET['demande'])){
    $user_id = mysqli_real_escape_string($link, $_POST["user_id_message"]);
    $type_message = mysqli_real_escape_string($link, "Demande");
    $nom_message = mysqli_real_escape_string($link, string: $_POST["nom_message"]);
    $email_message = mysqli_real_escape_string($link, string: $_POST["email_message"]);
    $surjet_message = mysqli_real_escape_string($link, string: $_POST["surjet_message"]);
    $numero_message = mysqli_real_escape_string($link, string: $_POST["telephone_message"]);
    $message = mysqli_real_escape_string($link, string: $_POST["message_message"]);
    $service_id = mysqli_real_escape_string($link, string: $_POST["service_id_message"]);
   
    $created_at = mysqli_real_escape_string($link, date('Y-m-d H:i:s'));	

    $sql_update = "UPDATE `services` SET `applied_service`=(applied_service+1) WHERE `id` = $service_id ";
	$query_update = mysqli_query($link,$sql_update);

    $sql = "INSERT INTO `messages`(`user_id`, `type_message`, `nom_message`, 
                        `email_message`, `surjet_message`, `numero_message`, 
                        `message`, `service_id`, `created_at`) 
            VALUES ('".$user_id."','".$type_message."','".$nom_message."',
                    '".$email_message."','".$surjet_message."','".$numero_message."',
                    '".$message."','".$service_id."','".$created_at."')";

        /* echo $sql;		
        exit; */
    $query = mysqli_query($link,$sql);	
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

    header('location:../services.php');
    exit;
}