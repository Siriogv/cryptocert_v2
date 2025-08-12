
			<div class="row">
				<div class="col-md-6 offset-md-3 col-lg-4 offset-lg-4">
					<a href="dashboard-1.html" class="logo justify-content-center text-primary">
					<img src="<?php if(isset($offcdata->logo)){echo base_url().$offcdata->logo;}else{?><?=base_url()?>/images/logo-primary.png<?php }?>" alt="">
					</a>
					<div class="box">
						<div class="box-header justify-content-center">
							<h3>Signup</h3>
						</div>
						<?php if(isset($message)){ ?>
							<div class="alert alert-warning">
								<?php echo $message;?>
							</div>
							<?php  }?>
							<?php if(isset($messagesuccess)){ ?>
							<div class="alert alert-success">
								<?php echo $messagesuccess;?>
							</div>
							<?php  }?>
						<?php $attributes = array("name" => "signup","id"=> "signup","class"=>"box-body needs-validation");

						echo form_open_multipart("signup/signup", $attributes);?>
							<div class="mb-3">
								<label for="regFirstName">Name</label>
								<input id="regFirstName" type="text" required class="form-control" name="name" placeholder="Enter your first name">
								<span class="invalid-feedback">Field is required.</span>
							</div>
							<div class="mb-3">
								<label for="regLastName">Nick Name</label>
								<input id="regLastName" type="text" required class="form-control" name="nickname" placeholder="Enter your last name">
								<span class="invalid-feedback">Field is required.</span>
							</div>
							<div class="mb-3">
								<label for="regEmail">Email</label>
								<input id="regEmail" type="email" required class="form-control" name="email" placeholder="Enter your email">
								<span class="invalid-feedback">Field is required.</span>
							</div>
							<div class="mb-3">
								<label for="regEmail">Contact</label>
								<input id="regEmail" type="text" required class="form-control" name="contact" placeholder="Contact">
								<span class="invalid-feedback">Field is required.</span>
							</div>
							<div class="mb-3">
								<label for="signupPassword">Password</label>
								<input id="signupPassword" type="password" minlength="6" required class="form-control" name="password"  placeholder="Enter your password">
								<span class="invalid-feedback">Min length is 6 symbols.</span>
							</div>
							<div class="mb-3">
								<label for="signupPasswordConfirm">Confirm password</label>
								<input id="signupPasswordConfirm" type="password" data-equalto="#signupPassword" required class="form-control" name="conpassword" placeholder="Enter your password again">
								<span class="invalid-feedback">Passwords do not match.</span>
							</div>
							
							<div class="mb-3">
								<button class="btn btn-block btn-primary">Signup</button>
							</div>
							<a class="btn btn-link btn-block" href="<?=base_url('index.php/');?>signin""><i class="fas fa-arrow-circle-left"></i> Go Back</a>
						</form>
					</div>	
				</div>
			</div>
		</main>
	</div>
	