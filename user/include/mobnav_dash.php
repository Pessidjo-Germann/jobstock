
<?php     
    if(trim($_SESSION['connect']['img']) > 0){
        $image = '../images_users/'.$_SESSION['connect']['img'];
    }else{
        $image = '../assets/img/user.png';
    }
?>


<div class="collapse" id="MobNav">
    <div class="dashboard-nav">
        <div class="dash-user-blocks pt-5">
            <div class="jbs-grid-usrs-thumb">
                <div class="jbs-grid-yuo">
                    <a href="candidate-detail.html"><figure><img src="<?=$image?>" class="img-fluid circle" alt=""></figure></a>
                </div>
            </div>
            <div class="jbs-grid-usrs-caption mb-3">
                
                <div class="jbs-tiosk">
                    <h4 class="jbs-tiosk-title"><a href="user.php"><?=$_SESSION['connect']['prenom']?> <?=$_SESSION['connect']['nom']?></a></h4>
                    <div class="jbs-tiosk-subtitle"><span><?=$_SESSION['connect']['emplois']?></span></div>
                </div>
            </div>
        </div>
        <div class="dashboard-inner">
            <ul data-submenu-title="Main Navigation">
                <li <?= basename($_SERVER['PHP_SELF']) == 'index.php'? "class='active'" : ""; ?>><a href="index.php"><i class="fa-solid fa-gauge-high me-2"></i>User Dashboard</a></li>
                <li <?= basename($_SERVER['PHP_SELF']) == 'profile.php'? "class='active'" : ""; ?>><a href="profile.php"><i class="fa-regular fa-user me-2"></i>My Profile </a></li>
                <li <?= basename($_SERVER['PHP_SELF']) == 'job.php'? "class='active'" : ""; ?>><a href="job.php"><i class="fa-solid fa-file-pdf me-2"></i>My services</a></li>
                <li <?= basename($_SERVER['PHP_SELF']) == 'create_job.php'? "class='active'" : ""; ?>><a href="create_job.php"><i class="fa-solid fa-pen-ruler me-2"></i>Add service</a></li>

                <li <?= basename($_SERVER['PHP_SELF']) == 'password.php'? "class='active'" : ""; ?>><a href="password.php"><i class="fa-solid fa-unlock-keyhole me-2"></i>Change Password</a></li>
                <li <?= basename($_SERVER['PHP_SELF']) == 'delete.php'? "class='active'" : ""; ?>><a href="delete.php"><i class="fa-solid fa-trash-can me-2"></i>Delete Account</a></li>
                <li><a href="../logout.php"><i class="fa-solid fa-power-off me-2"></i>Log Out</a></li>
            </ul>
        </div>						
    </div>
</div>