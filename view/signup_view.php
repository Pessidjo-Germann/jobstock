<!-- ============================ Page Title Start================================== -->
<section class="bg-cover primary-bg-dark" style="background:url(assets/img/bg2.png)no-repeat;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                
                <h2 class="ipt-title text-light">Creer Un Compte</h2>
                <span class="text-light opacity-75">Creer Un Compte ou login</span>
                
            </div>
        </div>
    </div>
</section>
<!-- ============================ Page Title End ================================== -->

<!-- ============================ Login Form Start ================================== -->
<section class="gray-simple">
    <div class="container">
        <!-- row Start -->
        <div class="row justify-content-center">
        
            <!-- Single blog Grid -->
            <div class="col-xl-6 col-lg-8 col-md-12">
                <div class="vesh-detail-bloc">
                    <div class="vesh-detail-bloc-body pt-3">
                        <ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <button class="nav-link active" id="signin-tab" data-bs-toggle="pill" data-bs-target="#signin" type="button" role="tab" aria-controls="signin" aria-selected="true">Login Account</button>
                            </li>
                            <li class="nav-item">
                            <button class="nav-link" id="register-tab" data-bs-toggle="pill" data-bs-target="#register" type="button" role="tab" aria-controls="register" aria-selected="false" tabindex="-1">Create Account</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="signin" role="tabpanel" aria-labelledby="signin-tab" tabindex="0">
                                <div class="row gx-3 gy-4">
                                    <div class="modal-login-form">
                                        <form action="./actions/login.php" method="post">
                                            <div class="form-floating mb-4">
                                                <input type="email" name="user_email"  class="form-control" placeholder="name@example.com" required>
                                                <label>Email</label>
                                            </div>
                                            
                                            <div class="form-floating mb-4">
                                                <input type="password" class="form-control" name="password_email" placeholder="Password" required>
                                                <label>Password</label>
                                            </div>
                                            
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary full-width font--bold btn-lg">Log In</button>
                                            </div>
                                            
                                            
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab" tabindex="0">
                                <div class="row gx-3 gy-4">
                                    <div class="modal-login-form">
                                        <form action="./actions/inscription.php" method="post">
                                            <div class="form-floating mb-4">
                                                <input type="text" name="nom" id="nom" class="form-control" placeholder="Your Name" required>
                                                <label>Votre Nom</label>
                                            </div>
                                            <div class="form-floating mb-4">
                                                <input type="text" name="prenom" id="prenom" class="form-control" placeholder="Your Name" required>
                                                <label>Votre Prenom</label>
                                            </div>
                                            <div class="form-floating mb-4">
                                                <input type="email" name="email" class="form-control" placeholder="name@example.com" required>
                                                <label>Email</label>
                                            </div>
                                            <div class="form-floating mb-4">
                                                <input type="number" name="number" class="form-control" placeholder="name@example.com" required>
                                                <label>Votre Numero de telephone</label>
                                            </div>

                                            <div class="form-floating mb-4">
                                                <div><label>Votre sexe</label></div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="sexe" id="Male" value="Male">
                                                    <label class="form-check-label" for="Male">Male</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="sexe" id="Female" value="Female">
                                                    <label class="form-check-label" for="Female">Female</label>
                                                </div>
                                            </div>
                                            
                                            <div class="form-floating mb-4">
                                                <input type="text" name="pays" class="form-control" placeholder="name@example.com" required>
                                                <label>Pays</label>
                                            </div>
                                            <div class="form-floating mb-4">
                                                <input type="text" name="ville" class="form-control" placeholder="name@example.com" required>
                                                <label>Ville</label>
														</div>
														<div class="form-floating mb-4">
															<input type="password" class="form-control" id="password" name="password" onkeyup="confirmpassword()" placeholder="Password" required>
															<label>Password</label>
															<p id="errorPasssword" class="error"></p>
														</div>
														<div class="form-floating mb-4">
															<input type="password" class="form-control" id="confirmPassword" name="confirmPassword" onkeyup="confirmpassword()" placeholder="Password" required>
															<label>Confirm Password</label>
															<p id="errorMessage" class="error"></p>
														</div>
														<div class="form-group">
															<button type="submit" id="btn_inscription" class="btn btn-primary full-width font--bold btn-lg">Create An Account</button>
														</div>
													</form>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
					</div>
					<!-- /row -->					
				</div>	
			</section>
			<!-- ============================ Login Form End ================================== -->
			