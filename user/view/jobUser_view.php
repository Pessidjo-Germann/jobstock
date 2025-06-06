<div class="dashboard-wrap bg-light">
    <a class="mobNavigation" data-bs-toggle="collapse" href="#MobNav" role="button" aria-expanded="false" aria-controls="MobNav">
        <i class="fas fa-bars mr-2"></i>Dashboard Navigation
    </a>
    <?php include('include/mobnav_dash.php')?>
    <div class="dashboard-content">
        <div class="dashboard-tlbar d-block mb-4">
            <div class="row">
                <div class="colxl-12 col-lg-12 col-md-12">
                    <h1 class="mb-1 fs-3 fw-medium">Manage jobs</h1>
                </div>
            </div>
        </div>
        
        <div class="dashboard-widg-bar d-block">
            <!-- Header Wrap -->
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- Start All List -->
                            <div class="row justify-content-start gx-3 gy-4">
                                <?php include('controller/jobUser_controller.php')?>
                            </div>
                            <!-- End All Job List -->
                        </div>
                    </div>
                </div>	
            </div>
            <!-- Header Wrap -->

        </div>
        
        <?php include('include/footer_dash.php')?>


    </div>				
    
</div>