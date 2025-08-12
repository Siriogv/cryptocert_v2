<div class="row">
				<div class="col-md-6 offset-md-3 col-lg-4 offset-lg-4">
					<a href="dashboard-1.html" class="logo justify-content-center text-primary">
						<img src="<?=base_url()?>/images/logo-primary.png" alt="">
					</a>
					<form class="box needs-validation" novalidate>
						<div class="box-header justify-content-center">
							<h3>Signin</h3>
						</div>
						<div class="box-body">
							<div class="mb-3">
								<label for="loginEmail">Email</label>
								<input id="loginEmail" required type="email" class="form-control" placeholder="Enter your email">
								<span class="invalid-feedback">Enter valid email address.</span>
							</div>
							<div class="mb-3">
								<label for="loginPassword">Password</label>
								<input id="loginPassword" required type="password" class="form-control" placeholder="Enter your password">
								<span class="invalid-feedback">Enter your password.</span>
							</div>
							<div class="mb-3">
								<label class="form-checkbox-custom">
									<input type="checkbox">
									<span class="form-label">Remember me</span>
								</label>
							</div>
							<div class="mb-3">
								<div class="btn-group btn-group-stretch">
									<button class="btn btn-primary">Signin</button>

								</div>
							</div>

							<p class="text-center my-0"><a href="page-forgot-password.html">Forgot Password?</a></p> <p class="text-center my-2">Non hai un account? <a href="<?=base_url('signin/signup')?>">Registrati ora</a></p>
 
						</div>
					</form>	
				</div>
			</div>
		</main>
	</div>

