<div class="dashboard-wrap bg-light">
    <a class="mobNavigation" data-bs-toggle="collapse" href="#MobNav" role="button" aria-expanded="false" aria-controls="MobNav">
        <i class="fas fa-bars mr-2"></i>Dashboard Navigation 
    </a>

    <?php include('include/mobnav_dash.php')?>
    
    <?php include('controller/profile_controller.php')?>
    <div class="dashboard-content">
        <div class="dashboard-tlbar d-block mb-4">
            <div class="row">
                <div class="colxl-12 col-lg-12 col-md-12">
                    <h1 class="mb-1 fs-3 fw-medium">Update Profile</h1>
                </div>
            </div>
        </div>
        
        <div class="dashboard-widg-bar d-block">
        
            <div class="dashboard-profle-wrapper mb-4">
                <div class="dash-prf-start">
                    <div class="dash-prf-start-upper mb-2">
                        <div class="dash-prf-start-thumb jbs-verified">
                            <figure class="mb-0"><img src="../images_users/<?=$_SESSION['connect']['img']?>" id="user_avatar" class="img-fluid rounded" alt="<?=$_SESSION['connect']['nom']?>" style="width: 100px;height: 100px;"></figure>
                        </div>
                    </div>
                    <form action="" id="image_form" class="dash-prf-start-bottom">
                        <div class="upload-btn-wrapper small">
                            <button class="btn">changer</button>
                            <input type="file" name="myfile" id="myfile" onchange="updateImage()">
                        </div>
                    </form>
                </div>
                
            </div>
            
            <!-- Card Row -->
            <div class="card">
                <div class="card-header">
                    <h4>Basic Detail</h4>
                </div>
                <div class="card-body">
                    <form action="../actions/updateImage.php?u=basic" method="post">
                        <div class="row">
                        
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>Votre nom</label>
                                    <input type="text" id="nom" name="nom" value="<?=$_SESSION['connect']['nom']?>" class="form-control">
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>Votre Prenom</label>
                                    <input type="text" name="prenom" id="prenom" value="<?=$_SESSION['connect']['prenom']?>" class="form-control">
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>Titre D'emploi</label>
                                    <input type="text" name="emplois" id="emplois" value="<?=$_SESSION['connect']['emplois']?>" class="form-control">
                                </div>
                            </div>
                            
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>Age</label>
                                    <input type="date" name="age" value="<?=$_SESSION['connect']['date_naissance']?>" class="form-control">
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>Experience</label>
                                    <div class="select-ops">
                                        <select name="experience" id="experience">
                                            <option value="Debutant">Debutant</option>
                                            <option value="+1 an">+1 an</option>
                                            <option value="+2 ans">+2 ans</option>
                                            <option value="+3 ans">+3 ans</option>
                                            <option value="+4 ans">+4 ans</option>
                                            <option value="+5 ans">+5 ans</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                                
                            <div class="col-xl-6 col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label>Apropos de vous</label>
                                    <textarea class="form-control ht-80" name="description" id="description"> <?=$_SESSION['connect']['description']?></textarea>
                                </div>
                            </div>
                            
                        </div> 
                        <!-- Submit Busston -->
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <button type="submit" class="btn ft--medium btn-primary">Save Profile</button>
                            </div>	
                        </div>
                    </form>
                </div>
            </div>
            <!-- Card Row End -->
            
            

            <!-- Card Row -->
            <div class="card">
                <div class="card-header">
                    <h4>Contact Detail</h4>
                </div>
                <div class="card-body">
                    <form action="../actions/updateImage.php?u=contact" method="post">
                        <div class="row">
                        
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>Votre Email</label>
                                    <input type="text" name="email" value="<?=$_SESSION['connect']['email']?>" class="form-control">
                                </div>
                            </div>
                            
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>Phone no.</label>
                                    <input type="number" name="number" id="number" value="<?=$_SESSION['connect']['number']?>" class="form-control">
                                </div>
                            </div>
                            
                            
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>Country</label>
                                    <input type="text" name="pays" id="pays" value="<?=$_SESSION['connect']['pays']?>" class="form-control">
                                </div>
                            </div>
                            
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>Ville</label>
                                    <input type="text" name="ville" id="ville" value="<?=$_SESSION['connect']['ville']?>" class="form-control">
                                </div>
                            </div>
                        </div>
                        <!-- Submit Busston -->
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <button type="submit" class="btn ft--medium btn-primary">Save Profile</button>
                            </div>	
                        </div>
                    </form>
                </div>
            </div>
            <!-- Card Row End -->

            <!-- Card Row -->
            <div class="card">
                <div class="card-header">
                    <h4>Social Login</h4>
                </div>
                <div class="card-body">
                    <form action="../actions/updateImage.php?u=social" method="post">
                        <div class="row">
                        
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>Facebook</label>
                                    <input type="text" class="form-control" name="fb" id="fb" value="<?=$_SESSION['connect']['network']['facebook']?>">
                                </div>
                            </div>
                            
                            
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>Instagram</label>
                                    <input type="text" class="form-control" name="ig" id="ig" value="<?=$_SESSION['connect']['network']['instagram']?>">
                                </div>
                            </div>
                            
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>Linked In</label>
                                    <input name="li" id="li" type="text" class="form-control" value="<?=$_SESSION['connect']['network']['linkin']?>">
                                </div>
                            </div>
                            
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>Twitter</label>
                                    <input name="x" id="x" type="text" class="form-control" value="<?=$_SESSION['connect']['network']['tweeter']?>">
                                </div>
                            </div>
                        </div> 
                        <!-- Submit Busston -->
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <button type="submit" class="btn ft--medium btn-primary">Save Profile</button>
                            </div>	
                        </div>
                    </form>
                </div>
            </div>
            <!-- Card Row End -->
            
            <!-- Row Start -->
            <div class="card">
                <div class="card-header">
                    <h4>Language</h4>
                </div>
                <div class="card-body">
                    <?php
                        if(isset($_SESSION['connect']['langue'])  && ($_SESSION['connect']['langue'] != '')){
                            
                            $langues = explode(",",$_SESSION['connect']['langue']);
                            $i=0;
                            foreach($langues as $langue){
                                
                                echo'<div class="single-edc-wrap">
                                        <div class="single-edc-box">
                                            <div class="single-edc-remove-box"><div class="cd-resume-cancel"><a href="../actions/updateImage.php?u=delete_langue&id='.$i.'" class="cancel-link"><i class="fa-solid fa-xmark"></i></a></div></div>
                                            <div class="single-edc-title-box">
                                                <a class="btn btn-collapse" data-bs-toggle="collapse" href="#secondarySchool" role="button" aria-expanded="false" aria-controls="secondarySchool">'.$langue.'</a>
                                            </div>
                                        </div>
                                    </div>';
                                    $i++;
                                    }
                    
                        }
                    ?>
                    <div class="single-edc-wrap">
                        <a href="JavaScript:Void(0);" data-bs-toggle="modal" data-bs-target="#education" class="add-light-btn">Ajouter une langue</a>
                    </div>
                    
                </div>
            </div>	
            <!-- End Row -->

        </div>
        <?php include('include/footer_dash.php')?>


    </div>				
    
</div>