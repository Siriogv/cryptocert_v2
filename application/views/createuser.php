	<?php error_reporting(0)?>
			<div class="row">
				<div class="col-md-6 offset-md-3 col-lg-4 offset-lg-4">
					<a href="dashboard-1.html" class="logo justify-content-center text-primary">
						<img src="<?=base_url()?>images/logo-primary.png" alt="">
					</a>
					<div class="box">
						<div class="box-header justify-content-center">
							<h3><?=$title?></h3>
						</div>
						<?php $attributes = array("name" => "usersignup","id"=> "usersignup","class"=>"box-body needs-validation");
						echo form_open_multipart("install/usercreate", $attributes);?>
							<div class="form-group">
								<label for="regFirstName">Admin User Name</label>
								<input id="regFirstName" type="text" required class="form-control" placeholder="User" name="username">
								<span class="invalid-feedback">Field is required.</span>
							</div>
							<div class="form-group">
								<label for="regLastName">Admin Email</label>
								<input id="regLastName" type="text" required class="form-control" placeholder="Email" name="email">
								<span class="invalid-feedback">Field is required.</span>
							</div>
							<div class="form-group">
								<label for="regEmail">Password</label>
								<input id="regEmail" type="password" required class="form-control" placeholder="Password" name="password">
								<span class="invalid-feedback">Field is required.</span>
							</div>
							<div class="form-group">
								<label for="signupPassword">Confirm Password</label>
								<input id="signupPassword" type="password" required class="form-control" placeholder="Confirm Password" name="confpassword">
								<span class="invalid-feedback">Min length is 6 symbols.</span>
							</div>

							<div class="form-group">
								<button class="btn btn-block btn-primary">Create User</button>
							</div>
							<a class="btn btn-link btn-block" href="page-signin.html"><i class="fas fa-arrow-circle-left"></i> Go Back</a>
						<?php form_close()?>
					</div>	
				</div>
			</div>
		</main>
	</div>
	
