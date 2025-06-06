<section class="gray-simple">
    <div class="container">
        <div class="row">
            
            <div class="col-lg-12 col-md-12 col-sm-12">	
                <!-- Start All List -->
                <div class="row justify-content-center gx-xl-3 gx-3 gy-4">                    <?php
                        include('actions/conbd.php'); 
                        $sql="SELECT services.id, 
                                    services.pays_service, 
                                    services.title, 
                                    services.ville_service, 
                                    services.salaire_service, 
                                    services.view_service, 
                                    services.updated_at, 
                                    services.description_service,
                                    users.nom,
                                    users.prenom,
                                    users.img
                                FROM services
                                INNER JOIN users 
                                ON services.user_id=users.id
                                ORDER BY services.updated_at DESC;";
                        /* echo $sql;		
                                    exit; */
                                    $query = mysqli_query($link,$sql);	
                                    $nblignes=mysqli_num_rows($query);	
                                    if($nblignes>0){
                                        echo '<div class="col-12 mb-3"><div class="alert alert-info">'. $nblignes .' service(s) disponible(s)</div></div>';
                                        $i=1;
                                        while($data = mysqli_fetch_array($query)){
                                            $i++;
                                            // Calculer le temps écoulé depuis la dernière mise à jour
                                            $now = time();
                                            $updated_time = strtotime($data['updated_at']);
                                            $time_diff = $now - $updated_time;
                                            $days_ago = round($time_diff / (60 * 60 * 24));
                                            
                                            $time_display = '';
                                            if($days_ago == 0) {
                                                $time_display = "Aujourd'hui";
                                            } elseif($days_ago == 1) {
                                                $time_display = "Hier";
                                            } else {
                                                $time_display = $days_ago . " jours";
                                            }
                                            
                                            echo'<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                                                    <div class="jbs-grid-layout border">
                                                        <div class="jbs-grid-emp-head">
                                                            <div class="jbs-grid-emp-content">
                                                                <div class="jbs-grid-emp-thumb"><a href="service.php?job='.$data['id'].'"><figure><img src="images_users/'.$data['img'].'" class="img-fluid circle" alt="'.htmlspecialchars($data['nom']).'"></figure></a></div>
                                                                <div class="jbs-grid-job-caption">
                                                                    <div class="jbs-job-employer-wrap"><span>'.htmlspecialchars($data['nom']).'</span></div>
                                                                    <div class="jbs-job-title-wrap"><h4><a href="service.php?job='.$data['id'].'" class="jbs-job-title">'.htmlspecialchars($data['title']).'</a></h4></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="jbs-grid-job-description">
                                                            <p>'.htmlspecialchars(substr($data['description_service'], 0, 100)).'... </p>
                                                        </div>
                                                        <div class="jbs-grid-job-edrs">
                                                            <div class="jbs-grid-job-edrs-group">
                                                                <span><i class="fa-solid fa-location-dot me-1"></i>'.htmlspecialchars($data['ville_service']).', '.htmlspecialchars($data['pays_service']).'</span>
                                                                <span><i class="fa-solid fa-calendar-days me-1"></i>'.$time_display.'</span>
                                                                <span><i class="fa-solid fa-eye me-1"></i>'.$data['view_service'].' vues</span>
                                                            </div>
                                                        </div>
                                                        <div class="jbs-grid-job-apply-btns">
                                                            <div class="jbs-btn-groups">
                                                                <div class="jbs-sng-blux"><div class="jbs-grid-package-title smalls"><h5>'.number_format($data['salaire_service']).'<span> XFA</span></h5></div></div>
                                                                <div class="jbs-sng-blux"><a href="service.php?job='.$data['id'].'" class="btn btn-md btn-light-primary px-4">Plus Détail</a></div>
                                                            </div>
                                                        </div>
                                                    </div>	
                                                </div>';
                                        
                                        }
                                    } else {
                                        echo '<div class="col-12"><div class="alert alert-warning text-center">
                                                <h4>Aucun service disponible</h4>
                                                <p>Il n\'y a actuellement aucun service disponible. Revenez plus tard !</p>
                                              </div></div>';
                                    }
                    ?>
                </div>
            </div>
        </div>
    </div>		
</section>