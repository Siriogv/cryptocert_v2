
		<main class="content">
			<div class="container-fluid">
				<div class="content-header">
					<h1><?=$title?></h1>
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="dashboard-1.html">Dashboard</a></li>
<li class="breadcrumb-item active"></li>
						</ol>
					</nav>
				</div>

				<div class="row">
					
					<div class="col-lg-12">
					<?php $attributes = array("name" => "profile","id"=> "profile");
								   echo form_open_multipart("admin/editoperatorval", $attributes);
								   $name = explode(" ",$userinfo->nominativo);  
								   ?>
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
								<?php if($userinfo->avatar!=''){?>
								<div class="form-group row">
								<label for="jsValidationLengthMax" class="form-label col-3"> Change Picture</label>
									
									<label class="form-radio-custom">
										<input type="radio" name="logochang" value="0" checked >
										<span class="form-label">No</span>
										
									</label>
									<label class="form-radio-custom">
										<input type="radio" name="logochang" value="1"  >
										<span class="form-label">Yes</span>
									</label>
								</div>
								<?php }?></span>
								<div class="form-group row">
									<label for="jsValidationLengthMax" class="form-label col-3">Name</label>
									<div class="col-9">
									    <input id="jsValidationLastName" type="text" class="form-control" name="nominativo" placeholder="Name" required value="<?=$name[0]?>">
										<span class="valid-feedback">Fine!</span>
										<span class="invalid-feedback">Field is required.</span>
									</div>
								</div>
								<div class="form-group row">
									<label for="jsValidationLengthMax" class="form-label col-3">SurName</label>
									<div class="col-9">
									    <input  type="text" class="form-control" name="surname" placeholder="SurName" value="<?=$name[1]?>">
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
									<select class="form-control" name="tipologiaUtente">
									<option value="">Select</option>
									<?php foreach($usertype as $usrtype){?>
									<option value="<?=$usrtype->qualifica ?>" <?php if($usrtype->qualifica==$userinfo->tipologiaUtente){?> selected <?php }?>><?=$usrtype->qualifica?></option>
									<?php }?>
									</select>
									    
										<span class="valid-feedback">Fine!</span>
										<span class="invalid-feedback">Field is required and must be email.</span>
									</div>
								</div>
								<div class="form-group row">
									<label for="jsValidationMin" class="form-label col-3">Permission</label>
									<div class="col-9">
									<select class="form-control" name="autorizzazioni">
									<option value="">Select Authorization</option>
									<?php foreach($permission as $perm){?>
									<option value="<?=$perm->permission?>" <?php if($perm->permission==$userinfo->autorizzazioni){?> selected <?php }?>><?=$perm->permission?></option>
									<?php }?>
									</select>
									   
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
									<select class="form-control" name="dipartimento">
									<option value="">Select Department</option>
									<?php foreach($department as $depart){?>
									<option value="<?=$depart->dipartimento ?>" <?php if($depart->dipartimento==$userinfo->dipartimento){?> selected <?php }?>><?=$depart->dipartimento ?></option>
									<?php }?>
									</select>
									   
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
								<input id="jsValidationCity" type="hidden" class="form-control"  name="userid" value="<?=$userinfo->id?>"> 
								<div class="form-group row">
								<label for="jsValidationLengthMax" class="form-label col-3"> Status</label>
									
									<label class="form-radio-custom">
										<input type="radio" name="status" value="0"  <?php if($userinfo->stato==0) echo "checked"; ?>>
										<span class="form-label">Inactive</span>
										
									</label>
									<label class="form-radio-custom">
										<input type="radio" name="status" value="1" <?php if($userinfo->stato==1) echo "checked"; ?>>
										<span class="form-label">Active</span>
									</label>
									<label class="form-radio-custom">
										<input type="radio" name="status" value="2" <?php if($userinfo->stato==2) echo "checked"; ?>>
										<span class="form-label">Blocked</span>
									</label>
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