<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">Service Recent</h6>
            </div>
            <div class="card-body">
                
                <!-- Start All List -->
                <div class="row justify-content-start gx-3 gy-4">
                    <?php
                        include('../actions/conbd.php'); 
                        $sql = "SELECT * FROM `services` WHERE `user_id` = ".$_SESSION['connect']['id']."";

                            /* echo $sql;		
                            exit; */
                        $query = mysqli_query($link,$sql);	
                        $nblignes=mysqli_num_rows($query);	
                        if($nblignes>0){
                            $i=1;
                            while($data = mysqli_fetch_array($query)){
                                $i++;
                                echo '<div class="col-xl-12 col-lg-12 col-md-12">
                                            <div class="jbs-list-box border">
                                                <div class="jbs-list-head">
                                                    <div class="jbs-list-head-thunner">
                                                        <div class="jbs-list-job-caption">
                                                            <div class="jbs-job-employer-wrap"><span>'.$data['title'].'</span></div>
                                                            <div class="jbs-job-title-wrap"><h4><a href="../service.php?job='.$data['id'].'" class="jbs-job-title">' .$data['title'].'</a></h4></div>
                                                        </div>
                                                    </div>
                                                    <div class="jbs-list-applied-users">
                                                        <span class="text-sm-muted text-light bg-info label"> '.$data['applied_service'].' Applicants</span>
                                                    </div>
                                                    <div class="jbs-list-postedinfo">
                                                        <p class="m-0 text-sm-muted"><strong>Posted:</strong><span class="text-success"> '.$data['created_at'].'</span></p>
                                                    </div>
                                                    <div class="jbs-list-head-last">
                                                        <a href="update_job.php?id='.$data['id'].'" class="rounded btn-md text-success bg-light-success px-3"><i class="fa-solid fa-pencil"></i></a>
                                                        <a href="../actions/createService.php?delete='.$data['id'].'" class="rounded btn-md text-danger bg-light-danger px-3"><i class="fa-solid fa-trash-can"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
                                    if($i == 2){
                                        break;
                                    }
                            }
                        }	

                        ?>
                    
                    
                    
                </div>
                <!-- End All Job List -->
    
            </div>
        </div>
    </div>	
</div>