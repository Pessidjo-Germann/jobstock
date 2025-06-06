<div class="dashboard-wrap bg-light">
    <a class="mobNavigation" data-bs-toggle="collapse" href="#MobNav" role="button" aria-expanded="false" aria-controls="MobNav">
        <i class="fas fa-bars mr-2"></i>Dashboard Navigation
    </a>
    <?php include('include/mobnav_dash.php')?>						
    <div class="dashboard-content">
        <div class="dashboard-tlbar d-block mb-5">
            <div class="row">
                <div class="colxl-12 col-lg-12 col-md-12">
                    <h1 class="mb-1 fs-3 fw-medium">Candidate Dashboard</h1>
                    
                </div>
            </div>
        </div>
        <div class="dashboard-profle-wrapper mb-4">
            <div class="dash-prf-end">
                <div class="dash-prfs-caption">
                    <div class="dash-prfs-title">
                        <h4><?=$_SESSION['connect']['prenom'] .' '.$_SESSION['connect']['nom']?></h4>	
                    </div>
                    <div class="dash-prfs-subtitle">
                        <div class="jbs-job-mrch-lists">
                            <div class="single-mrch-lists">
                                <span><?=$_SESSION['connect']['emplois']?></span>.<span><i class="fa-solid fa-location-dot me-1"></i><?=$_SESSION['connect']['ville'].', '.$_SESSION['connect']['pays']?></span>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="dash-prf-caption-end">
                    <div class="dash-prf-infos">
                        <div class="single-dash-prf-infos">
                            <div class="single-dash-prf-infos-icons"><i class="fa-solid fa-envelope-open-text"></i></div>
                            <div class="single-dash-prf-infos-caption">
                                <p class="text-sm-muted mb-0">Email</p>
                                <h5><?=$_SESSION['connect']['email']?></h5>
                            </div>
                        </div>
                        <div class="single-dash-prf-infos">
                            <div class="single-dash-prf-infos-icons"><i class="fa-solid fa-phone-volume"></i></div>
                            <div class="single-dash-prf-infos-caption">
                                <p class="text-sm-muted mb-0">Call</p>
                                <h5><?=$_SESSION['connect']['number']?></h5>
                            </div>
                        </div>
                        <div class="single-dash-prf-infos">
                            <div class="single-dash-prf-infos-icons"><i class="fa-solid fa-briefcase"></i></div>
                            <div class="single-dash-prf-infos-caption">
                                <p class="text-sm-muted mb-0">Exp.</p>
                                <h5><?=$_SESSION['connect']['experience']?></h5>
                            </div>
                        </div>
                    </div>
                    <div class="dash-prf-completion">
                        <p class="text-sm-muted">Profile Completed</p>
                        <div class="progress" role="progressbar" aria-label="Example Success with label" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar bg-success" style="width: 75%">75%</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Statistique de l'utilisateur -->

        <?php include('controller/stat_controller.php')?>

        <!-- service de l'utilisateur -->
        <?php include('controller/serviceUser_controller.php')?>
        
        <!-- Header Wrap -->
        <?php include('include/footer_dash.php')?>


    </div>				
    
</div>