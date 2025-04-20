
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
						echo form_open_multipart("install/dbhost", $attributes);?>
							<div class="form-group">
								<label for="regFirstName">Enter Host Name</label>
								<input id="regFirstName" type="text" required class="form-control" placeholder="Host" name="hostname">
								<span class="invalid-feedback">Field is required.</span>
							</div>
							<div class="form-group">
								<label for="regLastName">Enter User Name</label>
								<input id="regLastName" type="text" required class="form-control" placeholder="Enter Username" name="username">
								<span class="invalid-feedback">Field is required.</span>
							</div>
							<div class="form-group">
								<label for="regEmail">Enter Password</label>
								<input id="regEmail" type="password" class="form-control" placeholder="Enter your password" name="password">
								<span class="invalid-feedback">Field is required.</span>
							</div>
							<div class="form-group">
								<label for="signupPassword">Database Name</label>
								<input id="signupPassword" type="text" required class="form-control" placeholder="Enter Database Name" name="database">
								<span class="invalid-feedback">Min length is 6 symbols.</span>
							</div>

							<div class="form-group">
								<button class="btn btn-block btn-primary">Create Db</button>
							</div>
							<a class="btn btn-link btn-block" href="page-signin.html"><i class="fas fa-arrow-circle-left"></i> Go Back</a>
						</form>
					</div>	
				</div>
			</div>
		</main>
	</div>
	
	
