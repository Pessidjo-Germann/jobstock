<section>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-7 col-md-10 text-center">
                <div class="sec-heading center">
                    <h2>Services</h2>
                </div>
            </div>
        </div>
        
        <div class="row justify-content-center gx-xl-3 gx-3 gy-4">
            <?php
                include('actions/conbd.php'); 
                $sql = "SELECT * FROM `users` ";
                /* echo $sql;		
                            exit; */
                $query = mysqli_query($link,$sql);	
                $nblignes=mysqli_num_rows($query);	
                if($nblignes>0){
                    $i=1;
                    while($data = mysqli_fetch_array($query)){
                        $i++;
                        if(trim($data['img']) > 0){
                            $image = 'images_users/'.$data['img'];
                        }else{
                            $image = 'assets/img/user.png';
                        }
                        echo'<div class="col-xl-3 col-lg-3  col-md-4 col-sm-12">
                                <div class="job-instructor-layout border">
                                    <div class="job-instructor-thumb">
                                        <a href="candidat.php?user='.$data['id'].'"><img src="'.$image.'" class="img-fluid circle" alt=""></a>
                                    </div>
                                    <div class="job-instructor-content">
                                        <h4 class="instructor-title"><a href="candidat.php?user='.$data['id'].'">'.$data['nom'].'</a></h4>
                                        <div class="text-center text-sm-muted">
                                            <span><i class="fa-solid fa-location-dot me-2"></i>'.$data['ville'].', '.$data['pays'].'</span>
                                        </div>
                                        <div class="jbs-grid-job-edrs-group center mt-2">';?>
                                        
                                        <?php $sql_service = "SELECT * FROM `services` WHERE `user_id` = ".$data['id']."";
                                        /* echo $sql;		
                                        exit; */
                                        $query_service = mysqli_query($link,$sql_service);	
                                        $nblignes_service =mysqli_num_rows($query_service);	
                                        if($nblignes_service>0){
                                            $j=1;
                                            while($data_service = mysqli_fetch_array($query_service)){
                                                $j++;
                                                echo' <a href="service.php?job='.$data_service['id'].'"><span> '.$data_service['title'].'</span></a>';
                                                if($j ==3){
                                                    break;
                                                }
                                            }
                                        }
                                        ?>
                                            
                                        
                                        
                                        <?php echo'</div>
                                    </div>
                                    <div class="jbs-grid-job-apply-btns px-3 py-3">
                                        <div class="jbs-btn-groups justify-content-center">
                                            <div class="jbs-sng-blux"><a href="candidat.php?user='.$data['id'].'" class="btn btn-md btn-light-primary px-4">Plus Detail</a></div>
                                        </div>
                                    </div>
                                </div>	
                            </div>';
                            if($i ==5){
                                break;
                            }
                        }
                    }
            ?>
            
                                
            
        </div>
        <div class="row justify-content-center gx-xl-3 gx-3 gy-4 m-5">
            <!-- Single Item -->
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                <div class="job-instructor-layout border">
                    <div class="jbs-grid-job-apply-btns  px-3 py-3">
                        <div class="jbs-btn-groups justify-content-center">
                            <div class="jbs-sng-blux"><a href="services.php" class="btn btn-md btn-primary px-4">Plus De Service</a></div>
                        </div>
                    </div>
                </div>	
            </div>	
        </div>
    </div>
</section>