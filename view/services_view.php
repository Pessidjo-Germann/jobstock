<!-- ============================ Page Title Start================================== -->
<div class="page-title primary-bg-dark" style="background:url(assets/img/bg2.png) no-repeat;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                
                <h2 class="ipt-title">Services</h2>
                <div class="breadcrumbs light">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Accueil &gt;</a></li> 
                            
                            <li class="breadcrumb-item active" aria-current="page">Services</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ============================ Page Title End ================================== -->

<?php 
// Affichage des messages d'erreur si présents
if(isset($_GET['error'])) {
    $error_message = '';
    switch($_GET['error']) {
        case 'service_not_found':
            $error_message = 'Service non trouvé.';
            break;
        case 'service_not_specified':
            $error_message = 'Aucun service spécifié.';
            break;
        case 'invalid_service_id':
            $error_message = 'ID de service invalide.';
            break;
        default:
            $error_message = 'Une erreur est survenue.';
    }
    
    if(!empty($error_message)) {
        echo '<div class="container mt-3">
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Attention!</strong> ' . htmlspecialchars($error_message) . '
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              </div>';
    }
}
?>

<!-- ============================ All List Wrap ================================== -->
<?php include('controller/services_controller.php')?>
<!-- ============================ All List Wrap ================================== -->
