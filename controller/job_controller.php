<section class="gray-simple">
    <div class="container">
        <div class="row">
            
            <div class="col-lg-12 col-md-12 col-sm-12">	
                <!-- Start All List -->
                <div class="row justify-content-center gx-xl-3 gx-3 gy-4">                    <?php
                        include('actions/conbd.php'); 
                        
                        // Vérification et nettoyage du terme de recherche
                        $txtSearchField = isset($_GET['research']) ? mysqli_real_escape_string($link, trim($_GET['research'])) : '';
                        
                        if(empty($txtSearchField)) {
                            echo '<div class="col-12"><div class="alert alert-warning text-center">Veuillez saisir un terme de recherche.</div></div>';
                        } else {
                            $sql="SELECT services.id, 
                                        services.pays_service, 
                                        services.title, 
                                        services.ville_service, 
                                        services.salaire_service, 
                                        services.created_at, 
                                        services.description_service,
                                        users.nom,
                                        users.prenom,
                                        users.img
                                    FROM services
                                    INNER JOIN users 
                                    ON services.user_id=users.id
                                    WHERE  CONCAT(services.title, ' ',
                                                    services.pays_service, ' ',
                                                    services.ville_service, ' ',
                                                    users.nom, ' ',
                                                    users.prenom
                                                    ) LIKE '%$txtSearchField%'" ;//see the $ sign here                                //Finally, execute query and get result
                                    /* echo $sql;		
                                    exit; */
                                    $query = mysqli_query($link,$sql);	
                                    $nblignes=mysqli_num_rows($query);	
                                    if($nblignes>0){
                                        echo '<div class="col-12 mb-3"><div class="alert alert-info">'.  $nblignes .' résultat(s) trouvé(s) pour "<strong>'. htmlspecialchars($txtSearchField) .'</strong>"</div></div>';
                                        $i=1;
                                        while($data = mysqli_fetch_array($query)){
                                            $i++;
                                            echo'<div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                                                    <div class="jbs-grid-layout border">
                                                        
                                                        <div class="jbs-grid-emp-head">
                                                            <div class="jbs-grid-emp-content">
                                                                <div class="jbs-grid-emp-thumb"><a href="service.php?job='.$data['id'].'"><figure><img src="images_users/'.$data['img'].'" class="img-fluid circle" alt=""></figure></a></div>
                                                                <div class="jbs-grid-job-caption">
                                                                    <div class="jbs-job-employer-wrap"><span>'.$data['nom'].'</span></div>
                                                                    <div class="jbs-job-title-wrap"><h4><a href="service.php?job='.$data['id'].'" class="jbs-job-title">'.$data['title'].'</a></h4></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="jbs-grid-job-description">
                                                            <p>'.substr($data['description_service'], 0, 200).'... </p>
                                                        </div>
                                                        <div class="jbs-grid-job-edrs">
                                                            <div class="jbs-grid-job-edrs-group">
                                                                <span><i class="fa-solid fa-location-dot me-1"></i>'.$data['ville_service'].','.$data['pays_service'].'</span>
                                                                <span><i class="fa-regular fa-clock me-1"></i>Enternship</span>
                                                                <span><i class="fa-solid fa-calendar-days me-1"></i>1 Days ago</span>
                                                            </div>
                                                        </div>
                                                        <div class="jbs-grid-job-apply-btns">
                                                            <div class="jbs-btn-groups">
                                                                <div class="jbs-sng-blux"><div class="jbs-grid-package-title smalls"><h5>'.$data['salaire_service'].'<span> XFA</span></h5></div></div>
                                                                <div class="jbs-sng-blux"><a href="service.php?job='.$data['id'].'" class="btn btn-md btn-light-primary px-4">Plus Detail</a></div>
                                                            </div>
                                                        </div>
                                                    </div>	
                                                </div>';                                        
                                        }
                                    } else {
                                        echo '<div class="col-12"><div class="alert alert-warning text-center">Aucun résultat trouvé pour "<strong>'. htmlspecialchars($txtSearchField) .'</strong>". <br><br><a href="services.php" class="btn btn-primary">Voir tous les services</a></div></div>';
                                    }
                        }
                    ?>


                    
                </div>
            </div>
        </div>
    </div>		
</section>