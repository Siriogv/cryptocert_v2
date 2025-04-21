<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  </script>
		<main class="content">
			<div class="container-fluid">
				<div class="content-header">
					<h1>Tampered certified archiving of digital files</h1>
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="dashboard-1.html">Dashboard</a></li>
							<li class="breadcrumb-item active">File Upload</li>
						</ol>
					</nav>
				</div>

				<div class="row">
					
					<div class="col-lg-12">
					<?php $attributes = array("name" => "archive","id"=> "archive");
                                   echo form_open_multipart("admin/archive", $attributes);?>
							<div class="box-header">
								<h3></h3>
							</div>
							<div class="box-body">
								<div class="row">
									<div class="col-sm-12 form-group">
										<label for="jsValidationFirstName">

										<b>SELECT A FILE OR A COMPRESSED FOLDER </b><sup class="text-danger">*</sup></label>
										<input id="jsValidationFile" type="file" name="archive" class="form-control"  required >
										<p>(.zip o .rar) Currently Encrypter supports the following formats: 'txt', 'doc', 'xls', 'pdf', 'odt', 'jpg', 'pps', 'mp3', 'avi', 'mp4', 'gif', 'zip', 'rar', 'htm', 'html' </p>
										<span class="invalid-feedback">Field is required.</span>
									</div>
									
								</div>
								<div class="row">
									<div class="col-sm-12 form-group">
										<label for="jsValidationFirstName">

										<b>SELECT FOLDER WHERE YOU WANT TO KEPT FILE </b><sup class="text-danger">*</sup></label>
										<select name="folder" class="form-control">
										  <option value="">Select</option>
										  <?php foreach($files as $fol){echo "<pre>";print_r($fol)?>
											<option value="<?php echo $fol->cartella;?>"><?php echo $fol->cartella;?></option>
										  <?php }?>
										</select>
										
										<span class="invalid-feedback">Field is required.</span>
									</div>
									
								</div>
								<div class="row">
								    <div class="col-12 form-group">
										<label for="jsValidationAddress"><b>Rename File</b></label>
										<input name="newname" id="jsValidationapubblic" type="text" class="form-control" placeholder="Rename File">
									 	<span class="valid-feedback">Fine!</span>
									</div>
								    
								</div>
								<div class="row">
									<div class="col-12 form-group">
										<label for="jsValidationAddress"><b>Operator verification code: <?=$unicode?> </b></label>
										<input name="as2"</div>
 id="jsValidationas2" type="text" class="form-control" placeholder="Enter the verification code">
										<input type="hidden" name="as1" value="<?=$unicode?>">
										<p>This code ensures that the file has been uploaded by a human and is not spam</p>
										<span class="valid-feedback">Fine!</span>
									</div>
								</div>
								<div class="row">
									<div class="col-12 form-group">
										<p>
										<input name="scadenza" id="datepicker" type="text" class="form-control" autocomplete="off" placeholder="click in the field to enter the date">
										<p>Indicate the Notarizing Date of the file</p>
										<span class="valid-feedback">Fine!</span>
										</p>
									</div>
								</div>
								<div class="row">
									<div class="col-12 form-group">
										<label for="jsValidationAddress"><b>The file was also uploaded to an external web space</b></label>
										<input name="pubblic" id="jsValidationapubblic" type="text" class="form-control" placeholder="Enter the external address">
										<p>Indicates in the field the complete address of the web space where the file is already published, for example: http://www.miosito.it/miofile.ext COMPLETE WITH http: // Or https: //</p>
										<span class="valid-feedback">Fine!</span>
									</div>
								</div>
								<div class="row">
									<div class="col-12 form-group">
										
									</div>
								</div>
								<div class="row">
									<div class="col-12 form-group">
										
									</div>
								</div>
								<div class="row">
									<div class="col-12 form-group">
										<p<b>By archiving, you declare that you understand that Encrypter does not provide for the security of the file itself but for checking its unaltered status. This means that we cannot guarantee that the file will not be counterfeited by third parties, but we can guarantee constant control so that you can be promptly notified of a possible violation. This is true even if the file you want to monitor is also published on another web space.</b></p>
									</div>
								</div>
								
							</div>
							<div class="box-footer">
								<button type="submit" class="btn btn-primary pull-right">Invia</button>
							</div>
						</form>
					</div>
					
				</div>
			</div>
		</main>

	