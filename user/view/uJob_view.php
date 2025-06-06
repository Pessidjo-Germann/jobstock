
<?php
if(isset($_GET['id'])){
    $service = $_GET['id'];
    include('../actions/conbd.php'); 
    $sql_update = "UPDATE `services` SET `view_service`=(view_service+1) WHERE `id` = $service ";
    $query_update = mysqli_query($link,$sql_update);

    $sql="SELECT * FROM services
    WHERE `id` = $service;";
    /* echo $sql;		
    exit; */
    $query = mysqli_query($link,$sql);	
    $nblignes=mysqli_num_rows($query);	
    if($nblignes>0){
        $i=1;
        while($data = mysqli_fetch_array($query)){
?>
<div class="dashboard-wrap bg-light">
    <a class="mobNavigation" data-bs-toggle="collapse" href="#MobNav" role="button" aria-expanded="false" aria-controls="MobNav">
        <i class="fas fa-bars mr-2"></i>Dashboard Navigation
    </a>
    
    <?php include('include/mobnav_dash.php')?>

    
    <div class="dashboard-content">
        <div class="dashboard-tlbar d-block mb-4">
            <div class="row">
                <div class="colxl-12 col-lg-12 col-md-12">
                    <h1 class="mb-1 fs-3 fw-medium">Post Jobs</h1>
                    
                </div>
            </div>
        </div>
        
        <div class="dashboard-widg-bar d-block">
            
            <!-- Card Row -->
            <div class="card">
                <div class="card-header">
                    <h4>Basic Detail</h4>
                </div>
                <div class="card-body">
                    <form action="../actions/createService.php?update=" method="post">
                        <div class="row">
                            <input type="hidden" name="id" id="id" value="<?=$data['id']?>">

                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>Job Title</label>
                                    <input type="text" name="title" id="title" class="form-control" value="<?=$data['title']?>">
                                </div>
                            </div>
                            
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>Pays</label>
                                    <input type="text" name="pays" id="pays" class="form-control" value="<?=$data['pays_service']?>">
                                </div>
                            </div>
                            
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>Ville</label>
                                    <input type="text" name="ville" id="ville" class="form-control" value="<?=$data['ville_service']?>">
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>Experience</label>
                                    <div class="select-ops">
                                        <select name="experience">
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
                            
                            
                            
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>Salaire (XFA)</label>
                                    <input type="number" name="salaire" id="salaire" class="form-control" value="<?=$data['salaire_service']?>">
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>Skills, Use Commas for saperate</label>
                                    <input type="text" name="skill" class="form-control" value="<?=$data['skill_service']?>">
                                </div>
                            </div>
                            
                            <div class="col-xl-12 col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label>Job Description</label>
                                    <textarea class="form-control simple" name="description" id="description"><?=$data['description_service']?></textarea>
                                </div>
                            </div>
                            
                        </div> 
                        <!-- Submit Busston -->
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <button type="submit" class="btn ft--medium btn-light-primary">Save</button>
                            </div>	
                        </div>
                    </form>
                </div>
            </div>
            <!-- Card Row End -->
            
            

        </div>
        
        <?php include('include/footer_dash.php')?>

    </div>				
    
</div>

<?php
}
}
}
?>