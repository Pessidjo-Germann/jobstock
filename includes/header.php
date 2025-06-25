<!-- Start Navigation -->
<div class="header header-light">
    <div class="container">
        <nav id="navigation" class="navigation navigation-landscape">
            <div class="nav-header">
                <a class="nav-brand" href="index.php"><img src="assets/img/logo_DIGEX.png" class="logo" alt=""></a>
                <div class="nav-toggle"></div>
                <div class="mobile_nav">
                    <ul>
                        <li class="list-buttons">
                        <?php
                            if(isset($_SESSION['connect'])){
                                if(trim($_SESSION['connect']['img']) > 0){
                                    $image_header = 'images_users/'.$_SESSION['connect']['img'];
                                }else{
                                    $image_header = 'assets/img/user.png';
                                }
                                echo'<a href="user/index.php"><img src="'.$image_header.'" class="img-fluid circle" alt="" style="max-width:30px;"></a>';
                            }else{
                                echo'<a href="JavaScript:Void(0);" data-bs-toggle="modal" data-bs-target="#login"><i class="fas fa-sign-in-alt me-2"></i>Log In</a>';
                            }
                        ?>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="nav-menus-wrapper">
                <ul class="nav-menu"> 
                    <li <?= basename($_SERVER['PHP_SELF']) == 'index.php'? "class='active'" : ""; ?> ><a href="index.php">accueil </a></li>
                    <li <?= basename($_SERVER['PHP_SELF']) == 'services.php'? "class='active'" : ""; ?>><a href="services.php">Services</a></li>
                    <li <?= basename($_SERVER['PHP_SELF']) == 'ai_assistant.php'? "class='active'" : ""; ?>><a href="ai_assistant.php"><i class="fas fa-robot me-1"></i>Assistant IA</a></li>
                    <li <?= basename($_SERVER['PHP_SELF']) == 'about.php'? "class='active'" : ""; ?>><a href="about.php">A propos de nous</a></li>
                    <li <?= basename($_SERVER['PHP_SELF']) == 'contact.php'? "class='active'" : ""; ?>><a href="contact.php">Contact</a></li>

                </ul>
                <ul class="nav-menu nav-menu-social align-to-right">
                    
                    
                        <?php
                            if(isset($_SESSION['connect'])){
                                if(trim($_SESSION['connect']['img']) > 0){
                                    $image_header = 'images_users/'.$_SESSION['connect']['img'];
                                }else{
                                    $image_header = 'assets/img/user.png';
                                }
                        ?>
                                <li>
                                    <div class="btn-group account-drop">
                                        <button type="button" class="btn btn-order-by-filt" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <img src="<?=$image_header?>" class="img-fluid circle" alt="">
                                        </button>
                                        <div class="dropdown-menu pull-right animated flipInX">
                                            <div class="drp_menu_headr bg-primary">
                                                <h4>Hi, <?=$_SESSION['connect']['prenom']?></h4>
                                                <div class="drp_menu_headr-right"><button type="button" class="btn btn-whites"><a href="logout.php"> Logout</a></button></div>
                                            </div>
                                            <ul>
                                                <li><a href="user/index.php"><i class="fa fa-tachometer-alt"></i>Dashboard</a></li>                                  
                                                <li><a href="user/profile.php"><i class="fa fa-user-tie"></i>My Profile</a></li>  
                                                <li><a href="user/password.php"><i class="fa fa-unlock-alt"></i>Change Password</a></li>
                                                <li><a href="user/delete.php"><i class="fa-solid fa-trash-can"></i>Delete Account</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                        <?php
                            }else{                
                        ?>
                                <li>
                                    <a href="JavaScript:Void(0);" data-bs-toggle="modal" data-bs-target="#login"><i class="fas fa-sign-in-alt me-2"></i>Sign In</a>
                                </li>
                        <?php
                            }
                        
                        ?>
                </ul>
            </div>
        </nav>
    </div>
</div>
<!-- End Navigation -->