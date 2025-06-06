
<!-- Start Navigation -->
<div class="header header-light head-fixed">
    <div class="container">
        <nav id="navigation" class="navigation navigation-landscape">
            <div class="nav-header">
                <a class="nav-brand" href="index.php"><img src="../assets/img/logo_DIGEX.png" class="logo" alt=""></a>
                <div class="nav-toggle"></div>
                <div class="mobile_nav">
                    <ul>
                        <li class="list-buttons">
                            <a href="JavaScript:Void(0);" data-bs-toggle="modal" data-bs-target="#login"><i class="fas fa-sign-in-alt me-2"></i>Log In</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="nav-menus-wrapper">
                <ul class="nav-menu">
                    <li><a href="../index.php">accueil</a></li>
                    <li><a href="../services.php">Service</a></li>
                    <li><a href="../about.php">A propos de nous</a></li>
                    <li><a href="../contact.php">Contact</a></li>
                </ul>
                <?php     
                    if(trim($_SESSION['connect']['img']) > 0){
                        $image = '../images_users/'.$_SESSION['connect']['img'];
                    }else{
                        $image = '../assets/img/user.png';
                    }
                ?>
                <ul class="nav-menu nav-menu-social align-to-right dhsbrd">
                    <li>
                        <div class="btn-group account-drop">
                            <button type="button" class="btn btn-order-by-filt" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="<?=$image?>" class="img-fluid circle" alt="">
                            </button>
                            <div class="dropdown-menu pull-right animated flipInX">
                                <div class="drp_menu_headr bg-primary">
                                    <h4>Hi, <?=$_SESSION['connect']['prenom']?></h4>
                                    <div class="drp_menu_headr-right"><button type="button" class="btn btn-whites"><a href="../logout.php"> Logout</a></button></div>
                                </div>
                                <ul>
                                    <li><a href="index.php"><i class="fa fa-tachometer-alt"></i>Dashboard</a></li>                                  
                                    <li><a href="profile.php"><i class="fa fa-user-tie"></i>My Profile</a></li>  
                                    <li><a href="password.php"><i class="fa fa-unlock-alt"></i>Change Password</a></li>
                                    <li><a href="delete.php"><i class="fa-solid fa-trash-can"></i>Delete Account</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>

                   
                
                </ul>
            </div>
        </nav>
    </div>
</div>
<!-- End Navigation -->