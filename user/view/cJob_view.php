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
                <form action="../actions/createService.php?create=" method="post">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Job Title</label>
                                <input type="text" name="title" id="title" class="form-control">
                            </div>
                        </div>
                        
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Pays</label>
                                <input type="text" name="pays" id="pays" class="form-control">
                            </div>
                        </div>
                        
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Ville</label>
                                <input type="text" name="ville" id="ville" class="form-control">
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
                                <input type="number" name="salaire" id="salaire" class="form-control">
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Skills, Use Commas for saperate</label>
                                <input type="text" name="skill" class="form-control">
                            </div>
                        </div>
                        
                        <div class="col-xl-12 col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>Job Description</label>
                                <textarea class="form-control simple" name="description" id="description" placeholder=""></textarea>
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