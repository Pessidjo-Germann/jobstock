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
                    <h1 class="mb-1 fs-3 fw-medium">Delete Profile</h1>
                </div>
            </div>
        </div>
        
        <div class="dashboard-widg-bar d-block">
            <div class="card">
                <div class="card-header">
                    <h4>Delete Account</h4>
                </div>
                <div class="card-body">
                    <form action="../actions/updateImage.php?u=delete_account" method="post">
                        <div class="row mb-3">
                            <label class="col-xl-12 col-md-12 col-form-label">Enter your password To Delete Account</label>
                            <div class="col-xl-9 col-md-12">
                                <input type="password" name="delete" class="form-control" placeholder="*******">
                            </div>
                        </div> 
                        <div class="row mb-3">
                            <div class="col-xl-12 col-md-12">
                                <button type="submit" class="btn btn-danger">Delete Account</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        
        <?php include('include/footer_dash.php')?>


    </div>				

    </div>