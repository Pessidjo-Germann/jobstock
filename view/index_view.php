<!-- ============================ Hero Banner  Start================================== -->
<div class="image-bg hero-header" style="background:#237eFF url(assets/img/simple-banner.jpg) no-repeat;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-md-11 col-sm-12">
                <div class="inner-banner-text text-center">
                    <!-- <div class="inner-banner-eclips mb-2"><span class="label p-2 px-4 rounded-5 fw-medium text-light bg-primary">Get Your Hot Jobs</span></div> -->
                    <h1>Trouve la solution a<br>Ton probleme</h1>
                    <p class="fs-5">Resoudre un proleme n'est jamais facile. Vérifiez les nouvelles solution que nous vous réservons sur Digex Booker.</p>
                </div>                <div class="search-from-clasic mt-5">
                    <form action="job.php" method="get" class="hero-search-content" onsubmit="return validateSearch()">
                        <div class="row"> 								
                            <div class="col-xl-10 col-lg-10 col-md-9 col-sm-12">
                                <div class="classic-search-box">
                                    <div class="form-group full">
                                        <div class="input-with-icon">
                                            <input type="text" class="form-control" name="research" id="searchInput" placeholder="Rechercher une localité, un point de repère, un projet ou un constructeur" required minlength="2">
                                            <img src="assets/img/pin.svg" width="20" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-xl-2 col-lg-2 col-md-3 col-sm-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary full-width"><i class="fa-solid fa-magnifying-glass  me-2"></i></button>
                                </div>
                            </div>
                                    
                        </div>
                    </form>
                    
                    <script>
                    function validateSearch() {
                        const searchInput = document.getElementById('searchInput');
                        const searchValue = searchInput.value.trim();
                        
                        if (searchValue.length < 2) {
                            alert('Veuillez saisir au moins 2 caractères pour effectuer une recherche.');
                            searchInput.focus();
                            return false;
                        }
                        return true;
                    }
                    </script>
                </div>
                
            </div>
        </div>
    </div>
</div>
<!-- ============================ Hero Banner End ================================== -->

<!-- ============================ Statistique Start ================================== -->
<section class="primary-bg-dark py-4">
    <div class="container">     
        <div class="row align-items-center justify-content-center gx-3 gy-3">
            <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                <div class="d-flex align-items-center justify-content-start">
                    <div class="tryui-pos"><h2 class="display-4 fw-medium text-light m-0"><span class="ctr">87</span>%</h2></div>
                    <div class="exploi ps-3">
                        <p class="m-0 text-light lh-base">
                            Pourcentage d'emploi trouvé sur la plateforme
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                <div class="d-flex align-items-center justify-content-start">
                    <div class="tryui-pos"><h2 class="display-4 fw-medium text-light m-0"><span class="ctr">68</span>X</h2></div>
                    <div class="exploi ps-3">
                        <p class="m-0 text-light lh-base">
                            Augmentation potentielle du trafic du site Web.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                <div class="d-flex align-items-center justify-content-start">
                    <div class="tryui-pos"><h2 class="display-4 fw-medium text-light m-0"><span class="ctr">5</span>K</h2></div>
                    <div class="exploi ps-3">
                        <p class="m-0 text-light lh-base">Des milliers de travailleurs sont en partenariat avec nous</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                <div class="d-flex align-items-center justify-content-start">
                    <div class="tryui-pos"><h2 class="display-4 fw-medium text-light m-0"><span class="ctr">8</span>K</h2></div>
                    <div class="exploi ps-3">
                        <p class="m-0 text-light lh-base">Des clients satisfaits du monde entier grâce à nos services</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="clearfix"></div>
<!-- ============================ Statistique End ================================== -->

<!-- ============================ IA Assistant Start ================================== -->
<?php include("view/gemini_ai_section.php")?>
<!-- ============================ IA Assistant End ================================== -->

<!-- ============================ Services Start ================================== -->
<?php include("controller/service_controller_index.php")?>
<!-- ============================ Services End ================================== -->


<!-- ============================ Side Caption Start ================================== -->
<div class="position-relative">
    <div class="container">
        <div class="row justify-content-end align-items-md-center">
        
            <div class="d-none d-lg-block col-lg-6 position-absolute top-0 start-0 bg-cover h-100 rounded-end" style="background-image: url(assets/img/lu_3.jpg);"></div>
            <div class="d-lg-none mb-5 mb-md-0">
                <img class="img-fluid rounded" src="assets/img/lu_1.jpg" alt="Image Description">
            </div>

            <div class="col-lg-6 align-self-center">
                <div class="p-lg-5 p-md-0 pt-md-5">
                    <!-- Heading -->
                    <div class="mb-4 mb-sm-4">
                        <!-- <span class="font--bold label-light-success px-3 py-2 rounded mb-2">Our Showcase</span> -->
                        <h2 class="lh-base mt-2">
                            Plateforme de prestation
                            <br>de service
                        </h2>
                        <p class="fw-light fs-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>
                    <!-- End Heading -->

                    <div class="row mb-sm-4">
                        <div class="col-sm-6 col-md-12 col-lg-6">
                            <!-- List Checked -->
                            <ul class="colored-list">
                            <li>Corporate Business jobs</li>
                            <li>Creative Services</li>
                            <li>New Business Innovation</li>
                            <li>Online E-commerce</li>
                            <li>Residential Services</li>
                            </ul>
                            <!-- End List Checked -->
                        </div>
                        <!-- End Col -->

                        <div class="col-sm-6 col-md-12 col-lg-6">
                            <!-- List Checked -->
                            <ul class="colored-list">
                            <li>Company Showcase</li>
                            <li>News & Updates</li>
                            <li>Online Bookings</li>
                            <li>and much more...</li>
                            </ul>
                            <!-- End List Checked -->
                        </div>
                        <!-- End Col -->
                    </div>
                    <!-- End Row -->
                
                    
                </div>
            </div>
            <!-- End Col -->
            
        </div>
        <!-- End Row -->
    </div>
</div>
<!-- ============================ Side Caption End ================================== -->


<!-- ============================ Valuable Step Start ================================== -->
<?php include("includes/step.php")?>
<!-- ============================ Valuable Step End ================================== -->


<!-- ============================== Price Box =================================== -->
<?php include("includes/price.php")?>
<!-- ============================== Price Box =================================== -->

<!-- ============================ Top Features & Process Start ================================== -->
<?php include("includes/temoignage.php")?>
<!-- ============================ Top Features & Process End ================================== -->

