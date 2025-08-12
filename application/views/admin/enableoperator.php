
		<main class="content">
			<div class="container-fluid">
				<div class="content-header">
					<h1>Enter new user</h1>
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="dashboard-1.html">Dashboard</a></li>
							<li class="breadcrumb-item active"></li>
						</ol>
					</nav>
				</div>

				<div class="row">
					<div class="col-lg-12">
					<?php $attributes = array("name" => "createuser","id"=> "createuser");
                                   echo form_open_multipart("admin/enableoperator", $attributes);?>
							 
							<div class="box-body">
								<div class="form-group row">
									<label for="jsValidationLengthMin" class="form-label col-3">Logo</label>
									<div class="col-9">
									   <input id="jsValidationFirstName" type="file" class="form-control" placeholder="Logo"  name="avatar">
							
										<span class="valid-feedback">Fine!</span>
										<span class="invalid-feedback">Field is required.</span>
									</div>
								</div>
								</span>
								<div class="form-group row">
									<label for="jsValidationLengthMax" class="form-label col-3">Name</label>
									<div class="col-9">
									    <input id="jsValidationLastName" type="text" class="form-control" name="nominativo" placeholder="Name" required value="">
										<span class="valid-feedback">Fine!</span>
										<span class="invalid-feedback">Field is required.</span>
									</div>
								</div>
								<div class="form-group row">
									<label for="jsValidationLengthMax" class="form-label col-3">SurName</label>
									<div class="col-9">
									    <input  type="text" class="form-control" name="surname" placeholder="SurName" value="">
										<span class="valid-feedback">Fine!</span>
										<span class="invalid-feedback">Field is required.</span>
									</div>
								</div>
								<div class="form-group row">
									<label for="jsValidationLengthRange" class="form-label col-3">Email</label>
									<div class="col-9">
									    <input id="jsValidationEmail" type="email" class="form-control" placeholder="Email" name="email" required value="">
										<span class="valid-feedback">Fine!</span>
										<span class="invalid-feedback">Field is required and must be email.</span>
									</div>
								</div>
								<div class="form-group row">
									<label for="jsValidationLengthRange" class="form-label col-3">Password</label>
									<div class="col-9">
									    <input id="jsValidationEmail" type="password" class="form-control" placeholder="Email" name="password" required value="">
										<span class="valid-feedback">Fine!</span>
										<span class="invalid-feedback">Field is required and must be password.</span>
									</div>
								</div>
								<div class="form-group row">
									<label for="jsValidationLengthRange" class="form-label col-3">Type</label>
									<div class="col-9">
									<select class="form-control" name="tipologiaUtente">
									<option value="">Select</option>
									<?php foreach($usertype as $usrtype){?>
									<option value="<?=$usrtype->qualifica ?>"><?=$usrtype->qualifica?></option>
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
									<option value="<?=$perm->permission?>"><?=$perm->permission?></option>
									<?php }?>
									</select>
									   
										<span class="valid-feedback">Fine!</span>
									</div>
								</div>
								<div class="form-group row">
									<label for="jsValidationMin" class="form-label col-3">Contacts</label>
									<div class="col-9">
									    <input id="jsValidationAddress" type="text" class="form-control" placeholder="Phone" name="contatti" value="">
										<span class="valid-feedback">Fine!</span>
									</div>
								</div>
								<div class="form-group row">
									<label for="jsValidationMin" class="form-label col-3">Department</label>
									<div class="col-9">
									<select class="form-control" name="dipartimento">
									<option value="">Select Department</option>
									<?php foreach($department as $depart){?>
									<option value="<?=$depart->dipartimento ?>"><?=$depart->dipartimento ?></option>
									<?php }?>
									</select>
									   
										<span class="valid-feedback">Fine!</span>
									</div>
								</div>
								<div class="form-group row">
									<label for="jsValidationMax" class="form-label col-3">wallet</label>
									<div class="col-9">
									<input id="jsValidationCity" type="text" class="form-control" placeholder="wallet" name="wallet" value=""> 
										<span class="invalid-feedback">This value should be lower than or equal to 10.</span>
									</div>
								</div>
								<input id="jsValidationCity" type="hidden" class="form-control"  name="userid" value=""> 
								<div class="form-group row">
								<label for="jsValidationLengthMax" class="form-label col-3"> Status</label>
									
                                                                        <label class="form-radio-custom">
                                                                                <input type="radio" name="stato" value="0">
                                                                                <span class="form-label">Inactive</span>

                                                                        </label>
                                                                        <label class="form-radio-custom">
                                                                                <input type="radio" name="stato" value="1">
                                                                                <span class="form-label">Active</span>
                                                                        </label>
                                                                        <label class="form-radio-custom">
                                                                                <input type="radio" name="stato" value="2">
                                                                                <span class="form-label">Blocked</span>
                                                                        </label>
                                                               </div>
								
							</div>
							
							</div>
							<div class="box-footer">
								<button class="btn btn-primary pull-right">Create User</button>
							</div>
						</form>
					</div>
					
				</div>
			</div>
		</main>
