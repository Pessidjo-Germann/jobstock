<?php
include('./conbd.php'); 
session_start();
mysqli_autocommit($link, false);

if($_GET['u'] == 'image'){
    if(!empty($_FILES["myfile"])){
        $DOSSIER = rand(100,999);				
        $extension_file  = array("jpg", "gif", "png", "jpeg", "JPG", "GIF","PNG", "JPEG");
        
        if(!is_dir("../images_users")){
            mkdir("../images_users");
        }
        
        if(!is_dir("../images_users/".$DOSSIER)){
            mkdir("../images_users/".$DOSSIER);
        }				
        
        $extension_file_upload = pathinfo($_FILES["myfile"]["name"], PATHINFO_EXTENSION);
        $PHOTO_USER = "digex_".rand(100,999).".".$extension_file_upload;
        move_uploaded_file($_FILES["myfile"]["tmp_name"], "../images_users/".$DOSSIER."/".$PHOTO_USER);					
        $FILE_URL = $DOSSIER."/".$PHOTO_USER;					
        $PHOTO = mysqli_real_escape_string($link, $PHOTO_USER);
        $DOSSIER_PHOTO = mysqli_real_escape_string($link,$DOSSIER);						
        
        $sql = "UPDATE `users` SET `img`='".$FILE_URL."' WHERE  `id` = ".$_SESSION['connect']['id']."";

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
        // echo $reponse_json = json_encode($reponse, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE | JSON_FORCE_OBJECT);
        $url = "../images_users/".$FILE_URL; 
        echo $url;
        exit;
    }
}

if($_GET['u'] == 'contact'){
    $email = mysqli_real_escape_string($link, $_POST['email']);
    $number = mysqli_real_escape_string($link, $_POST['number']);
    $ville = mysqli_real_escape_string($link, $_POST['ville']);
    $pays = mysqli_real_escape_string($link, $_POST['pays']);
    $updated_at = mysqli_real_escape_string($link, date('Y-m-d H:i:s'));	
    $sql = "UPDATE `users` 
            SET `email`='".$email."',`number`='".$number."',`ville`='".$ville."',
            `pays`='".$pays."',`updated_at`='".$updated_at."' WHERE `id` = ".$_SESSION['connect']['id']."";
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
    // return;
    header('location:../user/profile.php');
    exit;

    // echo $reponse_json = json_encode($reponse, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE | JSON_FORCE_OBJECT);
    
}


if($_GET['u'] == 'basic'){
    $nom = mysqli_real_escape_string($link, $_POST['nom']);
    $prenom = mysqli_real_escape_string($link, $_POST['prenom']);
    $date_naissance = mysqli_real_escape_string($link, $_POST['age']);
    $experience = mysqli_real_escape_string($link, $_POST['experience']);
    $description = mysqli_real_escape_string($link, $_POST['description']);
    $emplois = mysqli_real_escape_string($link, $_POST['emplois']);
    $updated_at = mysqli_real_escape_string($link, date('Y-m-d H:i:s'));	
    $sql = "UPDATE `users` 
            SET `nom`='".$nom."',`prenom`='".$prenom."',`date_naissance`='".$date_naissance."',
            `description`='".$description."',`experience`='".$experience."',
            `emplois`='".$emplois."',`updated_at`='".$updated_at."' WHERE `id` = ".$_SESSION['connect']['id']."";
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
    header('location:../user/profile.php');
    exit;

}


if($_GET['u'] == 'social'){
    
    $facebook = mysqli_real_escape_string($link, $_POST['fb']);
    $instagram = mysqli_real_escape_string($link, $_POST['ig']);
    $linkin = mysqli_real_escape_string($link, $_POST['li']);
    $tweeter = mysqli_real_escape_string($link, $_POST['x']);
    // Sample data
    $data = [
        "facebook" => $facebook,
        "tweeter" => $tweeter,
        "instagram" => $instagram,
        "linkin" => $linkin
    ];

    // Encode data as JSON
    $json_data = json_encode($data);
    $updated_at = mysqli_real_escape_string($link, date('Y-m-d H:i:s'));	
    $sql = "UPDATE `users` 
            SET `social`=  '".$json_data."',`updated_at`='".$updated_at."' WHERE `id` = ".$_SESSION['connect']['id']."";
       /*  echo $sql;		
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
    header('location:../user/profile.php');
    exit;
}

if($_GET['u'] == 'langue'){
    $langue = mysqli_real_escape_string($link, $_POST['langue']);
    $langues_old = explode(",",$_SESSION['connect']['langue']);

    array_push($langues_old,$langue);
   /*  print_r( $langues_old);		
    exit;     */
    $langues = implode(',',$langues_old);
    
    $sql_langue = "UPDATE `users` SET `langue`= '".$langues."' WHERE `id` = ".$_SESSION['connect']['id']."";
     /* print_r( $sql_langue);		

    exit;  */   
    $query = mysqli_query($link,$sql_langue);
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
    header('location:../user/profile.php');
    exit;
}


if($_get['u'] ='delete_langue'){
    $langue_index = $_GET['id'];
    $langues_old = explode(",",$_SESSION['connect']['langue']);
    unset($langues_old[$langue_index]);
    /* print_r( $langues_old);		
    exit;  */   
    $langues = implode(',',$langues_old);
    $sql = "UPDATE `users` 
            SET `langue`=  '".$langues."',`updated_at`='".$updated_at."' WHERE `id` = ".$_SESSION['connect']['id']."";
       /*  echo $sql;		
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
    header('location:../user/profile.php');
    exit;
}


if($_GET['u'] == 'change_password'){

    if($_SESSION['connect']['password'] !== $_POST['old_password']){
        header('location:../user/password.php?message="Mot de passe incorrect"');
        exit;
    }

    $password = mysqli_real_escape_string($link, $_POST['new_password']);
    $sql_langue = "UPDATE `users` SET `password`= '".$password."' WHERE `id` = ".$_SESSION['connect']['id']."";
     print_r( $sql_langue);		

    exit;    
    $query = mysqli_query($link,$sql_langue);
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
    header('location:../user/profile.php');
    exit;
}


if($_GET['u'] == 'delete_account'){
        if($_SESSION['connect']['password'] !== $_POST['delete']){
            header('location:../user/delete.php?message="Mot de passe incorrect"');
            exit;
        }
       					 
        $sql = "DELETE `users` WHERE  `id` = ".$_SESSION['connect']['id']."";

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

        header('location:../');

        exit;
    
}