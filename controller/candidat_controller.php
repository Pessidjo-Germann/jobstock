<?php
if(isset($_GET['user'])){
		$user = $_GET['user'];
		include('actions/conbd.php'); 
		$sql = "SELECT * FROM `users` WHERE `id` = ".$user."";

		/* echo $sql;		
		exit; */
		$query = mysqli_query($link,$sql);	
		$nblignes=mysqli_num_rows($query);	
		if($nblignes>0){
			$i=1;
			while($data = mysqli_fetch_array($query)){
				if(trim($data['img']) > 0){
					$image = 'images_users/'.$data['img'];
				}else{
					$image = 'assets/img/user.png';
				}
                
?>


<!-- ============================ Header Information Start================================== -->
<section class="primary-bg-dark position-relative">
    <div class="position-absolute top-0 start-0">
        <img src="assets/img/circle.png" alt="SVG" width="200">
    </div>
    <div class="position-absolute bottom-0 start-0 me-10">
        <img src="assets/img/line.png" alt="SVG" width="200">
    </div>
    <div class="position-absolute top-0 end-0">
        <img src="assets/img/curve.png" alt="SVG" width="200">
    </div>
    <div class="position-absolute bottom-0 end-0">
        <img src="assets/img/circle.png" alt="SVG" width="200">
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-9 col-lg-10 col-md-12">
                <div class="cndt-head-block center-align">
                    
                    <div class="cndt-head-left">
                        <div class="cndt-head-thumb rounded">
                            <figure><img src="<?=$image?>" class="img-fluid rounded" alt="" style="height: 150px; width: 150px;"></figure>
                        </div>
                        <div class="cndt-head-caption">
                            <div class="cndt-head-caption-top">
                                
                                <div class="cndt-yior-2"><h4 class="cndt-title text-light"><?= $data['prenom'].' '.$data['nom']?></h4></div>
                                <div class="cndt-yior-3 text-light opacity-75">
                                    <?php
                                        if(isset($data['emplois']) && ($data['emplois'] != ' ') ){
                                    ?>
                                    <span><i class="fa-solid fa-user-graduate me-1"></i><?= $data['emplois']?></span>
                                    <?php
                                        }
                                    ?>
                                    <span><i class="fa-solid fa-location-dot me-1"></i><?= $data['ville']?>, <?= $data['pays']?></span>
                                    <span><i class="fa-solid fa-sack-dollar me-1"></i>1000/hr</span>
                                    <?php
                                        if(isset($data['date_naissance'])  && ($data['date_naissance'] != ' ')){
                                    ?>
                                    <span><i class="fa-solid fa-cake-candles me-1"></i><?= $data['date_naissance']?></span>
                                    <?php
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="cndt-head-caption-bottom">
                                <div class="cndt-yior-skills dark">
                                    <?php $sql_service = "SELECT * FROM `services` WHERE `user_id` = ".$data['id']."";
                                        /* echo $sql;		
                                        exit; */
                                        $query_service = mysqli_query($link,$sql_service);	
                                        $nblignes_service =mysqli_num_rows($query_service);	
                                        if($nblignes_service>0){
                                            $j=1;
                                            while($data_service = mysqli_fetch_array($query_service)){
                                                $j++;
                                                echo' <a href="service.php?job='.$data_service['id'].'"><span> '.$data_service['title'].'</span></a>';
                                                
                                            }
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ============================ Header Information End ================================== -->



<!-- ============================ Full Candidate Details Start ================================== -->
<section>
    <div class="container">
        <!-- row Start -->
        <div class="row">

            <div class="col-xl-8 col-lg-8 col-md-12">
                <div class="cdtsr-groups-block">
                    <?php
                        if(isset($data['description'])  && ($data['description'] != ' ')){
                    ?>
                    <div class="single-cdtsr-block">
                        <div class="single-cdtsr-header"><h5>A propos de <?=$data['nom']?></h5></div>
                        <div class="single-cdtsr-body">
                            <p><?=$data['description']?></p>
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                    <div class="single-cdtsr-block">
                        <div class="single-cdtsr-header"><h5>Tout les Information</h5></div>
                        <div class="single-cdtsr-body">
                            <div class="row align-items-center justify-content-between gy-4">
                                <div class="col-xl-6 col-lg-6 col-md-6">
                                    <div class="cdtx-infr-box">
                                        <div class="cdtx-infr-icon"><i class="fa-solid fa-envelope-open-text"></i></div>
                                        <div class="cdtx-infr-captions">
                                            <h5><?=$data['email']?></h5>
                                            <p>Mail Address</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6">
                                    <div class="cdtx-infr-box">
                                        <div class="cdtx-infr-icon"><i class="fa-solid fa-phone-volume"></i></div>
                                        <div class="cdtx-infr-captions">
                                            <h5><?=$data['number']?></h5>
                                            <p>Phone No.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6">
                                    <div class="cdtx-infr-box">
                                        <div class="cdtx-infr-icon"><i class="fa-regular fa-user"></i></div>
                                        <div class="cdtx-infr-captions">
                                            <h5><?=$data['sexe']?></h5>
                                            <p>Sexe</p>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                    if(isset($data['date_naissance']) && ($data['date_naissance'] != ' ')){
                                ?>
                                        
                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                        <div class="cdtx-infr-box">
                                            <div class="cdtx-infr-icon"><i class="fa-solid fa-cake-candles"></i></div>
                                            <div class="cdtx-infr-captions">
                                                <h5><?=$data['date_naissance']?></h5>
                                                <p>Date De Naissance</p>
                                            </div>
                                        </div>
                                    </div>

                                <?php
                                    }
                                ?>


                                <?php
                                    if(isset($data['experience']) && ($data['experience'] != ' ')){
                                ?>
                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                        <div class="cdtx-infr-box">
                                            <div class="cdtx-infr-icon"><i class="fa-solid fa-briefcase"></i></div>
                                            <div class="cdtx-infr-captions">
                                                <h5><?=$data['experience']?></h5>
                                                <p>Experience</p>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="single-cdtsr-block">
                        <div class="single-cdtsr-header"><h5>Tout Les Services</h5></div>
                        <div class="single-cdtsr-body">
                            <div class="experinc-usr-groups">
                                <?php $sql_service = "SELECT * FROM `services` WHERE `user_id` = ".$data['id']."";
                                    /* echo $sql;		
                                    exit; */
                                    $query_service = mysqli_query($link,$sql_service);	
                                    $nblignes_service =mysqli_num_rows($query_service);	
                                    if($nblignes_service>0){
                                        $j=1;
                                        while($data_service = mysqli_fetch_array($query_service)){
                                            $j++;
                                            echo' 
                                                <div class="single-experinc-block">
                                                    <div class="single-experinc-rght">
                                                        <div class="experinc-emp-title"><h5> <a href="service.php?job='.$data_service['id'].'">'.$data_service['title'].'</a></h5></div>
                                                        <div class="experinc-post-title">
                                                            <h6>'.$data_service['salaire_service'].' XFA</h6>
                                                            <div class="experinc-infos-list"><span class="exp-start">'.$data_service['ville_service'].' ,'.$data_service['pays_service'].'</span><span class="work-exp-date">'.$data_service['created_at'].'</span></div>
                                                        </div>
                                                    </div>
                                                </div>';
                                            
                                        }
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                        

                    <?php
                        if(isset($data['skill'])  && ($data['skill'] != '')){
                            $skills = explode(",",$data['skill']);
                    ?>
                        <div class="single-cdtsr-block">
                            <div class="single-cdtsr-header"><h5>Les Skills</h5></div>
                            <div class="single-cdtsr-body">
                                <div class="cndts-all-skills-list">
                                    <?php
                                    foreach( $skills as $skill){
                                        echo'<span>'.$skill.'</span>';
                                    }
                                    
                                    ?>
                                </div>
                            </div>
                        </div>
                    <?php
                        }
                    ?>

                    <?php
                        if(isset($data['langue'])  && ($data['langue'] != '')){
                            $langues = explode(",",$data['langue']);
                    ?>
                        <div class="single-cdtsr-block">
                            <div class="single-cdtsr-header"><h5>Language</h5></div>
                            <div class="single-cdtsr-body">
                                <div class="row gy-4">
                                    <?php
                                        foreach($langues as $langue){
                                            echo'<div class="col-xl-4 col-lg-4 col-md-6 col-6">
                                                    <div class="cndts-lgs-blocks">
                                                        <div class="cndts-lgs-ico"><h6>'.strtoupper(substr($langue, 0, 1)).'</h6></div>
                                                        <div class="cndts-lgs-captions">
                                                            <h5>'.$langue.'</h5>
                                                        </div>
                                                    </div>
                                                </div>';
                                                }
                                    ?>
                                </div>
                            </div>
                        </div>
                    <?php
                        }
                    ?>
                </div>
            </div>

            <div class="col-xl-4 col-lg-4 col-md-12">
                <div class="sidefr-usr-block mb-4">
                    <div class="sidefr-usr-header">
                        <h4 class="sidefr-usr-title">Contact <?=$data['prenom']?></h4>
                    </div>
                    <div class="sidefr-usr-body">
                        <form>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Your Name">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Email Address">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Phone.">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Subject">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" placeholder="Your Message"></textarea>
                            </div>
                            <div class="form-group m-0">
                                <button type="button" class="btn btn-primary fw-medium full-width">Send Message</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="sidefr-usr-block">
                    <div class="cndts-share-block">
                        <div class="cndts-share-title">
                            <h5>Share Profile</h5>
                        </div>
                        <div class="cndts-share-list">
                            <ul>
                            <?php
                                $data_network = json_decode($data['social'], true);
                                $data = $data_network;
                                if($data['facebook'] == ' '){
                                    echo'<li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>';
                                }else{
                                    echo'<li><a href="'.$data['facebook'].'"><i class="fa-brands fa-facebook-f"></i></a></li>';
                                }
                                if($data['tweeter'] == ' '){
                                    echo'<li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>';
                                }else{
                                    echo'<li><a href="'.$data['tweeter'].'"><i class="fa-brands fa-twitter"></i></a></li>';
                                }
                                if($data['instagram'] == ' '){
                                    echo'<li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>';
                                }else{
                                    echo'<li><a href="'.$data['instagram'].'"><i class="fa-brands fa-instagram"></i></a></li>';
                                }
                                if($data['linkin'] == ' '){
                                    echo'<li><a href="#"><i class="fa-brands fa-google-plus-g"></i></a></li>';
                                }else{
                                    echo'<li><a href="'.$data['linkin'].'"><i class="fa-brands fa-google-plus-g"></i></a></li>';
                                }
                            ?>
                            </ul>
                        </div>
                    </div>
                </div>
                
            </div>
            
        </div>
        <!-- /row -->					
    </div>	
</section>
<!-- ============================ Full Candidate Details End ================================== -->						
<?php
}
}else{
	header("location:services.php");
}
}else{
	header("location:services.php");
}
?>