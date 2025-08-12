<div class="row">

				<div class="col-md-6 offset-md-3 col-lg-4 offset-lg-4">

					<a href="dashboard-1.html" class="logo justify-content-center text-primary">

<img src="<?php if(isset($offcdata->logo)){echo base_url().$offcdata->logo;}else{?><?=base_url()?>/images/logo-primary.png<?php }?>" alt="">

					</a>



					<div class="box">

						<div class="box-header justify-content-center">

							<h3>Signin</h3>

						</div>

						<?php $attributes = array("name" => "login","id"=> "login","class"=>"box-body needs-validation");

						echo form_open_multipart("signin/login", $attributes);?>

						<div class="box-body">

							<div class="mb-3">

								<label for="loginEmail">Email</label>

								<input id="loginEmail" required type="email" class="form-control" placeholder="Enter your email" name="email">

								<span class="invalid-feedback">Enter valid email address.</span>

							</div>

							<div class="mb-3">

								<label for="loginPassword">Password</label>

								<input id="loginPassword" required type="password" class="form-control" placeholder="Enter your password" name="password">

								<span class="invalid-feedback">Enter your password.</span>

							</div>
							<?php if($offcdata->enable_recapture==1){ ?>
                            <div class="mb-3">
                                     <div class="g-recaptcha" data-sitekey="<?php echo $offcdata->site_key?>"></div> 
                                     </div>
							<?php }?>		 
							<div class="mb-3">

								<label class="form-checkbox-custom">

									<input type="checkbox" value="remember-me" id="remember_me">

									<span class="form-label">Remember me</span>

								</label>

							</div>

							<div class="mb-3">

								<div class="btn-group btn-group-stretch">

									<button class="btn btn-primary">Signin</button>



								</div>

							</div>

    	<p class="text-center my-0"><a href="<?=base_url('index.php/');?>signin/forgetpassword">Forgot Password?</a></p>
		<?php if($offcdata->enable_recapture==1){ ?><p class="text-center my-0"><a href="<?=base_url('index.php/');?>signup">Signup</a></p><?php }?>

						</div>

					    </form>

				</div>

			</div>

		</main>

	</div>
	<script src="https://code.jquery.com/jquery-1.9.1.js"></script>
	<script>
            $(function() {
 
                if (localStorage.chkbx && localStorage.chkbx != '') {
                    $('#remember_me').attr('checked', 'checked');
                    $('#loginEmail').val(localStorage.usrname);
                    $('#loginPassword').val(localStorage.pass);
                } else {
                    $('#remember_me').removeAttr('checked');
                    $('#loginEmail').val('');
                    $('#loginPassword').val('');
                }
 
                $('#remember_me').click(function() {
 
                    if ($('#remember_me').is(':checked')) {
                        // save username and password
                        localStorage.usrname = $('#loginEmail').val();
                        localStorage.pass = $('#loginPassword').val();
                        localStorage.chkbx = $('#remember_me').val();
                    } else {
                        localStorage.usrname = '';
                        localStorage.pass = '';
                        localStorage.chkbx = '';
                    }
                });
            });
 
        </script>

