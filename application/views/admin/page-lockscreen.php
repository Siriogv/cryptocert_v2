<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Encrypter Lockscreen</title>
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="format-detection" content="telephone=no">

	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/favicon/apple-touch-icon-144x144.png" />
	<link rel="icon" type="image/png" href="<?=base_url()?>images/favicon/favicon-16x16.png" sizes="16x16" />
	<link rel="icon" type="image/png" href="<?=base_url()?>images/favicon/favicon-32x32.png" sizes="32x32" />
	<link rel="icon" type="image/png" href="<?=base_url()?>images/favicon/favicon-128x128.png" sizes="128x128" />
	
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:700" rel="stylesheet">
	<link rel="stylesheet" href="<?=base_url()?>/assets/css/main.css">
</head>
<body>
	<div class="wrapper">
		<main class="content px-10">
			<div class="row">
				<div class="col-md-6 offset-md-3 col-lg-4 offset-lg-4">
					<div class="profile mt-50">
						<div class="profile-bg profile-bg-blur">
							<img src="images/avatar-1.jpg" alt="">
						</div>
						<div class="user-panel user-panel-column mb-10">
							<div class="user-panel-image">
								<div class="avatar avatar-lg avatar-bordered">
									<img src="<?=base_url()?>images/avatar-1.jpg" alt="">
								</div>
							</div>
							<div class="user-panel-info mb-10">
								<p class="text-black"><?=$nickname?></p>
								<small class="text-secondary"><?=$dipartimento?></small>
							</div>
						</div>
						<?php $attributes = array("name" => "unlock","id"=> "unlock");
                                   echo form_open_multipart("signin/login", $attributes);?>
						<div class="form-group">
						    <input type="hidden" class="form-control" placeholder="Enter your password" value="<?=$user?>" name="email">
							<input type="password" class="form-control" placeholder="Enter your password" name="password">
						</div>
						<button class="btn btn-primary btn-block">Unlock</button>
						</form>
					</div>	
				</div>
			</div>
		</main>
	
	
	<script src="https://cdn.ckeditor.com/4.10.1/standard/ckeditor.js"></script>
	<script src="assets/js/app.js"></script>
</body>

</html>