<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="registermodal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered login-pop-form" role="document">
        <div class="modal-content" id="registermodal">
            <span class="mod-close" data-bs-dismiss="modal" aria-hidden="true"><i class="fas fa-close"></i></span>
            <div class="modal-header">
                <div class="mdl-thumb"><img src="assets/img/ico.png" class="img-fluid" width="70" alt=""></div>
                <div class="mdl-title"><h4 class="modal-header-title">Hello, Again</h4></div>
            </div>
            <div class="modal-body">
                <div class="modal-login-form">
                    <form action="./actions/login.php" method="post">
                    
                        <div class="form-floating mb-4">
                            <input type="email" name="user_email" class="form-control" placeholder="name@example.com">
                            <label>User Name</label>
                        </div>
                        
                        <div class="form-floating mb-4">
                            <input type="password" class="form-control" name="password_email" placeholder="Password">
                            <label>Password</label>
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary full-width font--bold btn-lg">Log In</button>
                        </div>
                        
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <p>Vous n'avez pas encore un compte?<a href="signup.php" class="text-primary font--bold ms-1">Sign Up</a></p>
            </div>
        </div>
    </div>
</div>