<?php
// Inclure les fonctions de routage
include_once('includes/routing.php');

// Vérification de la présence du paramètre 'job'
if(!isset($_GET['job']) || empty($_GET['job'])) {
    redirectWithError('services.php', 'service_not_specified');
}

// Vérifier si le service_id est numérique
if(!validateNumericId($_GET['job'])) {
    redirectWithError('services.php', 'invalid_service_id');
}

if(isset($_GET['job'])){
		$service = $_GET['job'];
		include('actions/conbd.php');
				// Nettoyer l'ID du service
		$service_id = sanitizeInput($service);
		$sql_update = "UPDATE `services` SET `view_service`=(view_service+1) WHERE `id` = $service_id ";
		$query_update = mysqli_query($link,$sql_update);

		$sql="SELECT services.id as 'service_id', 
		services.title, 
		services.expired, 
		services.pays_service, 
		services.ville_service, 
		services.experience_service, 
		services.description_service,
		services.salaire_service, 
		services.skill_service,
		services.applied_service,
		services.created_at, 
		services.updated_at, 
		users.id as 'user_id',
		users.img,
		users.nom,
		users.ville,
		users.pays,
		users.prenom,
		users.email,
		users.emplois,
		users.sexe,
		users.number,
		users.experience,
		users.social
		FROM services
		
		INNER JOIN users 
		ON services.user_id=users.id 
		WHERE services.id = $service_id;";/* echo $sql;		
		exit; */
		$query = mysqli_query($link,$sql);	
		$nblignes=mysqli_num_rows($query);	
		if($nblignes>0){
			$i=1;
			while($data = mysqli_fetch_array($query)){
				$now = time(); // or your date as well
				$your_date = strtotime($data['updated_at']);
				$datediff = $now - $your_date;
				
				$since = round($datediff / (60 * 60 * 24));
                
?>
<!-- ============================ Header Top Start================================== -->
<section class="bg-cover primary-bg-dark position-relative py-4">
    <div class="position-absolute top-0 end-0 z-0">
        <img src="assets/img/shape-3-soft-light.svg" alt="SVG" width="100">
    </div>
    <div class="position-absolute top-0 start-0 me-10 z-0">
        <img src="assets/img/shape-1-soft-light.svg" alt="SVG" width="150">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-9 col-md-12">
                <div class="bread-wraps breadcrumbs light">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Accueil</a></li>
                            <li class="breadcrumb-item"><a href="services.php">Services</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?=$data['title']?></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ============================ Header Top End ================================== -->

<!-- ================================  Job Detail ========================== -->
<section class="gray-simple position-relative">
    <div class="position-absolute top-0 start-0 primary-bg-dark ht-200 end-0"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="jbs-blocs style_03 border-0 b-0 mb-md-4 mb-sm-4">
                    <div class="jbs-blocs-body">
                        <div class="jbs-content px-4 py-4 border-bottom">
                            <div class="jbs-head-bodys-top">
                                <div class="jbs-roots-y1 flex-column justify-content-start align-items-start">
                                    <div class="jbs-roots-y1-last">
                                        <div class="jbs-title-iop mb-1"><h2 class="m-0 fs-2"><?=$data['title']?></h2></div>
                                        <div class="jbs-locat-oiu text-sm-muted text-light d-flex align-items-center">
                                            <span class="text-muted"><i class="fa-solid fa-location-dot me-1"></i><?=$data['ville_service']?>, <?=$data['pays_service']?></span>
                                            <div class="jbs-kioyer-groups ms-3">
                                                <span class="fa-solid fa-star active"></span>
                                                <span class="fa-solid fa-star active"></span>
                                                <span class="fa-solid fa-star active"></span>
                                                <span class="fa-solid fa-star active"></span>
                                                <span class="fa-solid fa-star"></span>
                                                <span class="aal-reveis">4.6</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="jbs-roots-y6 py-1 d-flex align-items-start flex-wrap">
                                        <div class="exloip-wraps me-4 my-2">
                                            <div class="drixko-box d-flex align-items-center">
                                                <div class="drixko-box-ico me-2">
                                                    <span class="square--30 rounded-2 bg-light-primary text-primary"><i class="fa-solid fa-briefcase"></i></span>
                                                </div>
                                                <div class="drixko-box-caps"><span class="text-medium fw-medium"> <?=$data['experience_service']?> Exp.</span></div>
                                            </div>
                                        </div>
                                        
                                        <div class="exloip-wraps my-2 mb-0">
                                            <div class="drixko-box d-flex align-items-center">
                                                <div class="drixko-box-ico me-2">
                                                    <span class="square--30 rounded-2 bg-light-primary text-primary"><i class="fa-solid fa-sack-dollar"></i></span>
                                                </div>
                                                <div class="drixko-box-caps"><span class="text-medium fw-medium"> <?=$data['salaire_service']?> XFA</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="jbs-roots-y2">
                                    <div class="jbs-roots-action-groups">
                                        <div class="jbs-roots-action-btns">
                                            <button type="button" class="btn btn-md btn-primary" data-bs-toggle="modal" data-bs-target="#applyjob">Contacter Maintenant</button>
                                        </div>
                                        <div class="jbs-roots-action-info">
                                            <span class="text-sm fw-medium text-success ms-2">Depuis <?=$since?> jours</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="jbs-content px-4 py-4 border-bottom">
                            <h5>Description du Service</h5>
                            <p class="m-0"><?=$data['description_service']?>.</p>
                        </div>
                        <?php if($data['skill_service']){
                            $skills = explode(',',$data['skill_service']);
                            ?>
                            <div class="jbs-content-body px-4 py-4">		
                                <div class="jbs-content">
                                    <h6>Les Skills</h6>
                                    <ul class="p-0 m-0 d-flex align-items-center flex-wrap">
                                        <?php
                                            foreach($skills as $skill){
                                                echo' <li class="me-1 mb-1"><span class="label bg-light-primary text-primary fw-medium">'.strtoupper($skill).'</span></li>';
                                            }
                                        ?>
                                    </ul>
                                </div>
                                
                            </div>
                        <?php }?>
                    </div>
                    <div class="jbs-blox-footer">
                        <div class="blox-first-footer">
                            <div class="ftr-share-block">
                                <ul>
                                    <li><strong>Share This Job:</strong></li>
                                    <li><a href="JavaScript:Void(0);"><i class="fa-brands fa-facebook"></i></a></li>
                                    <li><a href="JavaScript:Void(0);"><i class="fa-brands fa-linkedin"></i></a></li>
                                    <li><a href="JavaScript:Void(0);"><i class="fa-brands fa-google-plus"></i></a></li>
                                    <li><a href="JavaScript:Void(0);"><i class="fa-brands fa-twitter"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="blox-last-footer">
                            <div class="jbs-roots-action-btns">
                                <p class="m-0"><span class="text-muted me-1"><?=$data['applied_service']?> Demandes</span>|<span class="text-muted ms-1"><?=$data['created_at']?></span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="side-jbs-info-blox bg-white mb-4">
                    <div class="side-jbs-info-header">
                        <div class="side-jbs-info-thumbs">
                            <figure><img src="images_users/<?=$data['img']?>" class="img-fluid" alt="" style="height: 70px; width: 70px;"></figure>
                        </div>
                        <div class="side-jbs-info-captionyo ps-3">
                            <div class="sld-info-title">
                                <h5 class="rtls-title mb-1"><?=$data['prenom'].' '.$data['nom']?></h5>
                                <div class="jbs-locat-oiu text-sm-muted">
                                    <span class="me-1"><i class="fa-solid fa-location-dot me-1"></i><?=$data['ville']?>, <?=$data['pays']?></span>.<span class="ms-1"><?=$data['emplois']?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="side-jbs-info-middle">
                        <div class="row align-items-center justify-content-between gy-4">
                            <div class="col-xl-12 col-lg-12 col-md-12">
                                <div class="cdtx-infr-box">
                                    <div class="cdtx-infr-icon"><i class="fa-solid fa-envelope-open-text"></i></div>
                                    <div class="cdtx-infr-captions">
                                        <h5><?=$data['email']?></h5>
                                        <p>Mail Address</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12">
                                <div class="cdtx-infr-box">
                                    <div class="cdtx-infr-icon"><i class="fa-solid fa-phone-volume"></i></div>
                                    <div class="cdtx-infr-captions">
                                        <h5><?=$data['number']?></h5>
                                        <p>Phone No.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12">
                                <div class="cdtx-infr-box">
                                    <div class="cdtx-infr-icon"><i class="fa-regular fa-user"></i></div>
                                    <div class="cdtx-infr-captions">
                                        <h5><?=$data['sexe']?></h5>
                                        <p>Gender</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <form action="actions/message.php?message=message" method="post" class="detail-side-block bg-white mb-4">
                    <div class="detail-side-heads mb-2">
                        <h3>Enovoyer un message</h3>
                        <input type="hidden" class="form-control" name="type_message" value="message">
                        <input type="hidden" class="form-control" name="user_id_message" value="<?=$data['user_id']?>">	
                        <input type="hidden" class="form-control" name="service_id_message" value="<?=$data['service_id']?>">	
                    </div>
                    <div class="detail-side-middle">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="nom_message" placeholder="">
                            <label>Votre nom:</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="email_message" placeholder="">
                            <label>Votre email:</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="telephone_message" placeholder="">
                            <label>Votre Numero de telephone:</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="surjet_message" placeholder="">
                            <label>Surjet:</label>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea class="form-control simple" name="message_message" placeholder=""></textarea>
                            <label>Message:</label>
                        </div>
                        
                        <div class="form-group">
                            <button type="submit"  class="btn btn-primary full-width fw-medium font-sm">Soumettre la damande</button>
                        </div>
                    </div>
                </form>						
            </div>
        </div>
    </div>
</section>
<!-- =============================== Job Detail ================================== -->
    

<!-- Apply Job Modal -->
<div class="modal fade" id="applyjob" tabindex="-1" role="dialog" aria-labelledby="applyjobs" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered applyjob-pop-form" role="document">
        <div class="modal-content" id="applyjobs">
            <span class="mod-close" data-bs-dismiss="modal" aria-hidden="true"><i class="fas fa-close"></i></span>
            <div class="modal-body">
                <form action="actions/message.php?demande=demande" method="post" class="detail-side-block bg-white">
                    <div class="detail-side-heads mb-2">
                        <h3>Faire Un Demande?</h3>
                        <input type="hidden" class="form-control" name="user_id_message" value="<?=$data['user_id']?>">	
                        <input type="hidden" class="form-control" name="service_id_message" value="<?=$data['service_id']?>">	
                    </div>
                    <div class="detail-side-middle">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="nom_message" placeholder="">
                            <label>Votre nom:</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="email_message" placeholder="">
                            <label>Votre email:</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="telephone_message" placeholder="">
                            <label>Votre Numero de telephone:</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="surjet_message" placeholder="">
                            <label>Surjet:</label>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea class="form-control simple" name="message_message" placeholder=""></textarea>
                            <label>Message:</label>
                        </div>
                        
                        <div class="form-group">
                            <button type="submit"  class="btn btn-primary full-width fw-medium font-sm">Soumettre la damande</button>
                        </div>
                    </div>
                </form>
                
            </div>
            <div class="modal-footer">
                <p>Vous n'avez pas encore un compte?<a href="signup.php" class="text-primary font--bold ms-1">Sign Up</a></p>

            </div>
        </div>
    </div>
</div>
<!-- End Modal -->

<?php
		}	} else {
		// Service non trouvé - utiliser la fonction de routage
		redirectWithError('services.php', 'service_not_found');
	}
} else {
	redirectWithError('services.php', 'service_not_specified');
}
?>