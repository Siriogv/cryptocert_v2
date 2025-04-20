
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
					<?php $attributes = array("name" => "changepassword","id"=> "changepassword");
                                   echo form_open_multipart("admin/changepassword", $attributes);?>
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
									
									<div class="col-9">
							
							<span>
							
								<div class="form-group row">
									<label for="jsValidationLengthMax" class="form-label col-3">New Password</label>
									<div class="col-9">
									    <input id="jsValidationLastName" type="password" class="form-control" name="newpassword" id="password" placeholder="New Password" required>
										<span class="valid-feedback">Fine!</span>
										<span class="invalid-feedback">Field is required.</span>
									</div>
								</div>
								<div class="form-group row">
									<label for="jsValidationLengthRange" class="form-label col-3">Confirm Password</label>
									<div class="col-9">
									    <input id="jsValidationEmail" type="password" class="form-control" placeholder="Confirm Password" name="conpassword" id="confirm_password" required onchange="validatePassword()" >
										<span class="valid-feedback">Fine!</span>
										<span class="invalid-feedback">Field is required and must be email.</span>
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
	</div>
	
	<script src="https://cdn.ckeditor.com/4.10.1/standard/ckeditor.js"></script>
	<script src="assets/js/app.js"></script>
	
</body>

</html>