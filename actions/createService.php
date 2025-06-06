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
if(isset($_GET['create'])){
    $title = mysqli_real_escape_string($link, $_POST["title"]);

    $pays = mysqli_real_escape_string($link, $_POST["pays"]);

    $ville = mysqli_real_escape_string($link, $_POST["ville"]);

    $experience = mysqli_real_escape_string($link, $_POST["experience"]);

    $salaire = mysqli_real_escape_string($link, $_POST["salaire"]);

    $skill = mysqli_real_escape_string($link, $_POST["skill"]);
    $description = mysqli_real_escape_string($link, $_POST["description"]);
    $exigences = mysqli_real_escape_string($link, $_POST["exigences"]);

    $created_at = mysqli_real_escape_string($link, date('Y-m-d H:i:s'));	

    $sql = "INSERT INTO `services`( `user_id`, `title`, 
                        `pays_service`, `ville_service`, `experience_service`,
                        `description_service`, `salaire_service`, `skill_service`, 
                        `created_at`, `updated_at`) 
            VALUES ('".$_SESSION['connect']['id']."','".$title."',
                '".$pays."','".$ville."','".$experience."',
                '".$description."','".$salaire."','".$skill."',
                '".$created_at."','".$created_at."')";

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

    header('location:../user/create_job.php');
    exit;
}

/* ======================================================================================================================== */
        /* =============================================== DEBUT MODIFICAION  ====================================== */
/* ======================================================================================================================== */		




if(isset($_GET['update'])){
    $id = mysqli_real_escape_string($link, string: $_POST["id"]);

    $title = mysqli_real_escape_string($link, $_POST["title"]);

    $pays = mysqli_real_escape_string($link, $_POST["pays"]);

    $ville = mysqli_real_escape_string($link, $_POST["ville"]);

    $experience = mysqli_real_escape_string($link, $_POST["experience"]);

    $salaire = mysqli_real_escape_string($link, $_POST["salaire"]);

    $skill = mysqli_real_escape_string($link, $_POST["skill"]);

    $description = mysqli_real_escape_string($link, $_POST["description"]);

    $created_at = mysqli_real_escape_string($link, date('Y-m-d H:i:s'));	

    $sql = "UPDATE `services` 
            SET `title`='".$title."',
                `pays_service`='".$pays."',
                `ville_service`='".$ville."',
                `experience_service`='".$experience."',
                `description_service`='".$description."',
                `salaire_service`='".$salaire."',
                `skill_service`='".$skill."',
                `updated_at`='".$created_at."' 
            WHERE `id`='".$id."'";

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

    header('location:../user/create_job.php');
    exit;
}