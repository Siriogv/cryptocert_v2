
			<div class="row">
				<div class="col-md-6 offset-md-3 col-lg-4 offset-lg-4">
					<a href="dashboard-1.html" class="logo justify-content-center text-primary">
						<img src="images/logo-primary.png" alt="">
					</a>
					<form class="box needs-validation" novalidate>
						<div class="box-header justify-content-center">
							<h3>Password recovery</h3>
						</div>
						<?php $attributes = array("name" => "forgetpass","id"=> "forgetpass");
                                   echo form_open_multipart("signin/forgetpassword", $attributes);?>
						<div class="box-body">
							<p>Please, enter your account email address. After submit, you'll get a new message from us. Follow to link to recover your password.</p>
							<div class="form-group">
								<label for="loginEmail">Email</label>
								<input id="loginEmail" required type="email" class="form-control" placeholder="Enter your email">
								<span class="invalid-feedback">Enter valid email address.</span>
							</div>
							<div class="form-group">
								<button class="btn btn-block btn-primary">Send</button>
							</div>
							<a class="btn btn-link btn-block" href="<?php echo base_url()?>"><i class="fas fa-arrow-circle-left"></i> Go Back</a>
						</div>
					</form>	
				</div>
			</div>
		</main>
	</div>
	
	