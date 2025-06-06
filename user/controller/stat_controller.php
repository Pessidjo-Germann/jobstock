<?php
    include('../actions/conbd.php'); 
    $sql = "SELECT * FROM `services` WHERE `user_id` = ".$_SESSION['connect']['id']."";

        /* echo $sql;		
        exit; */
    $query = mysqli_query($link,$sql);	
    $nblignes=mysqli_num_rows($query);	
    if($nblignes>0){
        $i=1;
        $total_applied = 0;
        $total_vue = 0;
        $total = 0;
        while($data = mysqli_fetch_array($query)){
            $i++;
            $total_vue += $data['view_service'];
            $total_applied +=  $data['applied_service'];
        }
        $total = $total_applied + $total_vue;
    }	
?>
<div class="dashboard-widg-bar d-block">
    <!-- Row Start -->
    <div class="row align-items-center gx-4 gy-4 mb-4">
        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
            <div class="dash-wrap-bloud">
                <div class="dash-wrap-bloud-icon">
                    <div class="bloud-icon text-success bg-light-success">
                        <i class="fa-solid fa-business-time"></i>	
                    </div>
                </div>
                <div class="dash-wrap-bloud-caption">
                    <div class="dash-wrap-bloud-content">
                        <h5 class="ctr"><?=$total_applied?></h5>
                        <p>Demande de service</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
            <div class="dash-wrap-bloud">
                <div class="dash-wrap-bloud-icon">
                    <div class="bloud-icon text-danger bg-light-danger">
                        <i class="fa-solid fa-eye"></i>
                    </div>
                </div>
                <div class="dash-wrap-bloud-caption">
                    <div class="dash-wrap-bloud-content">
                        <h5 class="ctr"><?=$total_vue?></h5>
                        <p>Vues service</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
            <div class="dash-wrap-bloud">
                <div class="dash-wrap-bloud-icon">
                    <div class="bloud-icon text-info bg-light-info">
                        <i class="fa-sharp fa-solid fa-comments"></i>
                    </div>
                </div>
                <div class="dash-wrap-bloud-caption">
                    <div class="dash-wrap-bloud-content">
                        <h5 class="ctr"><?=$total?></h5>
                        <p>Total</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Row End -->
</div>