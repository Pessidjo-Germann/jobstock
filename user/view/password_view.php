<div class="dashboard-wrap bg-light">
    <a class="mobNavigation" data-bs-toggle="collapse" href="#MobNav" role="button" aria-expanded="false" aria-controls="MobNav">
        <i class="fas fa-bars mr-2"></i>Dashboard Navigation
    </a>
    <?php include('include/mobnav_dash.php')?>

    <?php 
        if(isset($_GET['message'])){
            echo'<script>
                    alert('.$_GET['message'].');
                </script>';
        }
    ?>
    <div class="dashboard-content">
        <div class="dashboard-tlbar d-block mb-4">
            <div class="row">
                <div class="colxl-12 col-lg-12 col-md-12">
                    <h1 class="mb-1 fs-3 fw-medium">Changer de Mot de passe</h1>
                </div>
            </div>
        </div>
        
        <div class="dashboard-widg-bar d-block">
            
            <div class="card">
                <div class="card-body">
                    <form action="../actions/updateImage.php?u=password" method="post">
                        <div class="row mb-3">
                            <label class="col-xl-2 col-md-12 col-form-label">Old Password</label>
                            <div class="col-xl-7 col-md-12">
                                <input type="password" name="old_password" id="old_password" class="form-control" placeholder="*******">
                            </div>
                        </div> 
                        <div class="row mb-3">
                            <label class="col-xl-2 col-md-12 col-form-label">New Password</label>
                            <div class="col-xl-7 col-md-12">
                                <input type="password" class="form-control" name="new_password" id="new_password" placeholder="*******" onkeyup="confirmpassword()">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-xl-2 col-md-12 col-form-label">Confirm Password</label>
                            <div class="col-xl-7 col-md-12">
                                <input type="password" class="form-control" name="con_new_password" id="con_new_password" placeholder="*******" onkeyup="confirmpassword()">
                                <p id="errorMessage" class="error"></p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-xl-12 col-md-12">
                                <button type="submit" class="btn btn-primary" id="btn_submit">Changer</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        
        <?php include('include/footer_dash.php')?>
    </div>				
</div>