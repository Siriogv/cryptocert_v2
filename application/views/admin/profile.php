
		<main class="content">
			<div class="container-fluid">
				<div class="content-header">
					<h1><?=$title?></h1>
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="dashboard-1.html">Dashboard</a></li>
<li class="breadcrumb-item active">Profile</li>
						</ol>
					</nav>
				</div>

				<div class="row">
					
					<div class="col-lg-12">
					<?php $attributes = array("name" => "profile","id"=> "profile");
                                   echo form_open_multipart("admin/profile", $attributes);?>
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
									   <input id="jsValidationFirstName" type="file" class="form-control" placeholder="Logo" <?php if($userinfo->avatar==''){?>required <?php }?>  name="avatar">
							<span><?php if($userinfo->avatar!=''){?><img src="<?php echo base_url().'/'.$userinfo->avatar?>" width="150" height="150"><?php }?></span>
										<span class="valid-feedback">Fine!</span>
										<span class="invalid-feedback">Field is required.</span>
									</div>
								</div>
								<?php // if($userinfo->avatar!=''){?>
								<div class="form-group row">
								<label for="jsValidationLengthMax" class="form-label col-3"> Change Picture</label>
									
									<label class="form-radio-custom">
										<input type="radio" name="logochange" value="0" checked >
										<span class="form-label">No</span>
										
									</label>
									<label class="form-radio-custom">
										<input type="radio" name="logochange" value="1"  >
										<span class="form-label">Yes</span>
									</label>
								</div>
								<?php //}?></span>
								<div class="form-group row">
									<label for="jsValidationLengthMax" class="form-label col-3">Name</label>
									<div class="col-9">
									    <input id="jsValidationLastName" type="text" class="form-control" name="nominativo" placeholder="Name" required value="<?=$userinfo->nominativo?>">
										<span class="valid-feedback">Fine!</span>
										<span class="invalid-feedback">Field is required.</span>
									</div>
								</div>
								<div class="form-group row">
									<label for="jsValidationLengthRange" class="form-label col-3">Email</label>
									<div class="col-9">
									    <input id="jsValidationEmail" type="email" class="form-control" placeholder="Email" name="email" required value="<?=$userinfo->email?>">
										<span class="valid-feedback">Fine!</span>
										<span class="invalid-feedback">Field is required and must be email.</span>
									</div>
								</div>
								<div class="form-group row">
									<label for="jsValidationLengthRange" class="form-label col-3">Type</label>
									<div class="col-9">
									    <input id="jsValidationEmail" type="text" class="form-control" placeholder="Email" name="tipologiaUtente" required value="<?=$userinfo->tipologiaUtente?>">
										<span class="valid-feedback">Fine!</span>
										<span class="invalid-feedback">Field is required and must be email.</span>
									</div>
								</div>
								<div class="form-group row">
									<label for="jsValidationMin" class="form-label col-3">Permission</label>
									<div class="col-9">
									    <input id="jsValidationAddress" type="text" class="form-control" placeholder="Phone" name="autorizzazioni" value="<?=$userinfo->autorizzazioni?>">
										<span class="valid-feedback">Fine!</span>
									</div>
								</div>
								<div class="form-group row">
									<label for="jsValidationMin" class="form-label col-3">Contacts</label>
									<div class="col-9">
									    <input id="jsValidationAddress" type="text" class="form-control" placeholder="Phone" name="contatti" value="<?=$userinfo->contatti ?>">
										<span class="valid-feedback">Fine!</span>
									</div>
								</div>
								<div class="form-group row">
									<label for="jsValidationMin" class="form-label col-3">Department</label>
									<div class="col-9">
									    <input id="jsValidationAddress" type="text" class="form-control" placeholder="Phone" name="dipartimento" value="<?=$userinfo->dipartimento?>">
										<span class="valid-feedback">Fine!</span>
									</div>
								</div>
								<div class="form-group row">
									<label for="jsValidationMax" class="form-label col-3">wallet</label>
									<div class="col-9">
									<input id="jsValidationCity" type="text" class="form-control" placeholder="wallet" name="wallet" value="<?=$userinfo->userwallet ?>"> 
										<span class="invalid-feedback">This value should be lower than or equal to 10.</span>
									</div>
								</div>
								<div class="form-group row">
								<label for="jsValidationLengthMax" class="form-label col-3"> Change Password</label>
									
									<label class="form-radio-custom">
										<input type="radio" name="changp" value="0" checked onclick="document.getElementById('changpassword').style.display='none'">
										<span class="form-label">No</span>
										
									</label>
									<label class="form-radio-custom">
										<input type="radio" name="changp" value="1"  onclick="document.getElementById('changpassword').style.display='block'" >
										<span class="form-label">Yes</span>
									</label>
								</div>
								<div class="form-group row" id="changpassword" style="display:none">
									<label for="jsValidationMax" class="form-label col-3" style="float:left">New Password</label>
									<div class="col-9" style="float:right"> 
									<input id="jsValidationCity" type="password" class="form-control" placeholder="Password" name="password" value="" style="float:right"> 
										<span class="invalid-feedback">This value should be lower than or equal to 10.</span>
									</div>
								</div>
								
							</div>
							
							</div>
							<div class="box-footer">
								<button class="btn btn-primary pull-right">Edit</button>
							</div>
						</form>
					</div>
				
				</div>
			</div>
		</main>

	<script src="https://cdn.ckeditor.com/4.10.1/standard/ckeditor.js"></script>
	<script src="assets/js/app.js"></script>
</body>

</html>