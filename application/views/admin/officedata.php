
		<main class="content">
			<div class="container-fluid">
			    <div class="content-header">
				   <h1><?=$title?></h1>		
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="dashboard-1.html">Dashboard</a></li>
							<li class="breadcrumb-item active"><?=$title?></li>
						</ol>
					</nav>
				</div>
				
				<div class="row">
					
					<div class="col-lg-12">
					<?php $attributes = array("name" => "officedata","id"=> "officedata");
                                   echo form_open_multipart("admin/officedata", $attributes);?>
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
							<div class="box-body">
								<div class="form-group row">
									<label for="jsValidationLengthMin" class="form-label col-3">Logo</label>
									<div class="col-9">
							<input id="jsValidationFirstName" type="file" class="form-control" placeholder="Logo" <?php if($offcdata->logo==''){?>required <?php }?> name="logo">
							<span>
							<?php if($offcdata->logo!=''){?>
							<img src="<?php echo base_url().'/'.$offcdata->logo?>">
							<?php }?></span>
										<span class="valid-feedback">Fine!</span>
										<span class="invalid-feedback">Field is required.</span>
									</div>
								</div>
								<?php if($offcdata->logo!=''){?>
								<div class="form-group">
									<div class="form-label">Change Logo</div>
									
									<label class="form-radio-custom">
										<input type="radio" name="logochang" value="1"  >
										<span class="form-label">No</span>
										
									</label>
									<label class="form-radio-custom">
										<input type="radio" name="logochang" value="0" checked >
										<span class="form-label">Yes</span>
									</label>
								</div>
								<?php }?></span>
								<div class="form-group row">
									<label for="jsValidationLengthMax" class="form-label col-3">Business name</label>
									<div class="col-9">
									    <input id="jsValidationLastName" type="text" class="form-control" name="intestazione" placeholder="Business name" required value="<?=$offcdata->intestazione?>">
										<span class="valid-feedback">Fine!</span>
										<span class="invalid-feedback">Field is required.</span>
									</div>
								</div>
								<div class="form-group row">
									<label for="jsValidationLengthRange" class="form-label col-3">Email office</label>
									<div class="col-9">
									    <input id="jsValidationEmail" type="email" class="form-control" placeholder="Email" name="email" required value="<?=$offcdata->email?>">
										<span class="valid-feedback">Fine!</span>
										<span class="invalid-feedback">Field is required and must be email.</span>
									</div>
								</div>
								<div class="form-group row">
									<label for="jsValidationMin" class="form-label col-3">Phone</label>
									<div class="col-9">
									    <input id="jsValidationAddress" type="text" class="form-control" placeholder="Phone" name="telefono" value="<?=$offcdata->telefono?>">
										<span class="valid-feedback">Fine!</span>
									</div>
								</div>
								<div class="form-group row">
									<label for="jsValidationMax" class="form-label col-3">wallet</label>
									<div class="col-9">
									<input id="jsValidationCity" type="text" class="form-control" placeholder="wallet" name="wallet" value="<?=$offcdata->wallet?>"> 
										<span class="invalid-feedback">This value should be lower than or equal to 10.</span>
									</div>
								</div>
								<?php  $n1=rand(1,9);
										$n2=rand(1,9);
										$n3=$n1+$n2;?>
								<div class="form-group">
									<div class="form-label">Enable Google reCAPTCHA</div>
									<label class="form-radio-custom">  
										<input type="radio" name="recapture" value="1" required <?php if($offcdata->enable_recapture){ echo "checked='checked'";}?>>
										<span class="form-label">Yes</span>
									</label>
									<label class="form-radio-custom">
										<input type="radio" name="recapture" value="0" required >
										<span class="form-label">No</span>
										
									</label>
								</div>
								<div class="form-group row google_capture">								
									<label for="jsValidationRange" class="form-label col-3">Google Site Key</label>
									<div class="col-3">
										<input id="jsValidationState" type="text" class="form-control" placeholder="Site Key" name="site"  value="<?=$offcdata->site_key?>">
									</div>
									<label for="jsValidationRange" class="form-label col-3">Google Secret Key</label>
									<div class="col-3">
										<input id="jsValidationState" type="text" class="form-control" placeholder="Secret Key" name="secret"  value="<?=$offcdata->secret_key?>">
									</div>									
								</div>
								<div class="form-group row">
									<label for="jsValidationRange" class="form-label col-3">Antispam question: What is <?=$n1?>+ <?=$n2?>?</label>
									<div class="col-9">
									 <input id="jsValidationState" type="text" class="form-control" placeholder="antispam" name="antispam">
									 <input  type="hidden" class="form-control" placeholder="antispam" name="antispamchk" value="<?=$n3?>">  
									</div>
								</div>
								
							</div>
							
							</div>
							<div class="box-footer">
								<button class="btn btn-primary pull-right">Submit</button>
							</div>
						</form>
					</div>
				
				</div>
			</div>
		</main>

	
	<script src="https://cdn.ckeditor.com/4.10.1/standard/ckeditor.js"></script>
	<script src="assets/js/app.js"></script>
