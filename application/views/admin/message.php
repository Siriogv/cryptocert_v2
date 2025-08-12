
		<main class="content">
			<div class="container-fluid">
				<div class="content-header">
				   <h1><?=$title?></h1>		
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="dashboard-1.html">Dashboard</a></li>
							<li class="breadcrumb-item active">Message</li>
						</ol>
					</nav>
				</div>

				<div class="row">
					<div class="col-lg-6">
						
						
							<div class="box-body">
								<div class="row">
									<div class="col-sm-12 mb-3">
										<label for="jsValidationFirstName"><b>Original message </b></label>
										<textarea  name="messaggio_originale" id="messaggio_originale" class="form-control"  required></textarea>
										<span class="valid-feedback">Fine!</span>
										<span class="invalid-feedback">Field is required.</span>
									</div>
									</div>
								
								
							</div>
							<div class="box-footer">
								<button type="button" class="btn btn-primary pull-right" id="messageencode">Message encoding</button>
							</div>
							
								<div class="box-body">
								<div class="row">
									<div class="col-sm-12 mb-3">
										<label for="jsValidationFirstName"><b>Message Hash </b></label>
										<textarea  name="messaggio_originale" id="messaggio_originalehash" class="form-control"  required></textarea>
										<span class="valid-feedback">Fine!</span>
										<span class="invalid-feedback">Field is required.</span>
									</div>
									</div>
								
								
							</div>
							<div class="box-footer">
								<button type="button" class="btn btn-primary pull-right" id="messageencode">Message decoding</button>
							</div>
						
					</div>
					<div class="col-lg-6">
						<form class="box needs-validation" method="post" action="<?php echo base_url()?>index.php/admin/message">
							<div class="box-header">
								<h3><?=$title1?></h3>
							</div>
							<div class="box-body">
							<div class="row">
									<div class="col-sm-12 mb-3">
										<label for="jsValidationFirstName"><b>Message hash </b></label>
										<textarea  name="messaggio_cript" id="messaggio_cript" class="form-control"required></textarea>
										<span class="valid-feedback">Fine!</span>
										<span class="invalid-feedback">Field is required.</span>
									</div>
									</div>
									<div class="row">
									<div class="col-sm-12 mb-3">
										<label for="jsValidationLastName"><b>Original message</b></label>
										<textarea  name="messaggio_originale" id="messaggio_originaleval" class="form-control" placeholder="Last name" required></textarea>
										<span class="valid-feedback">Fine!</span>
										<span class="valid-feedback">Fine!</span>
										<span class="invalid-feedback">Field is required.</span>
									</div>
									</div>
								
							</div>
							<div class="box-footer">
								<button class="btn btn-primary pull-right">Save the hash code</button>
							</div>
						</form>
					</div>
				
				</div>
				<div class="row">
				<?php if(count($message)>0) {?>
				<div class="row table-responsive">
			   <div class="col-lg-10">
				<h3>Your Message</h3>
				<table class="table">
									<tbody>
										<tr>
											<th><b>ID</b></th>
											<th><b>Message</b></th>
											<th><b>Hash</b></th>
											<th><b>Action</b></th>
											
										</tr>
										<?php
										$i = 1;
										foreach($message as $mess){?>

										<tr>
											<td><?=$i?></td>
											<td><b><?=$mess->messaggio ?></b></td>
											<td><b><?=$mess->hash?></b></td>
											 <td>
												<div class="d-flex justify-content-between mb-5">
													
												   <a href="<?php echo base_url('index.php/')?>admin/deletemessage/<?=$mess->id?>" data-widget="dismiss" class="alert-close"><i class="fas fa-times"></i></a>
												</div>
												
											</td>
											
										</tr>
										<?php $i++; }?>
									</tbody>
								</table>
				</div>
				</div>
				<?php } ?>
				</div>
			</div>
		</main>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $("#messageencode").click(function(){
	 var messaggio_originale = $('#messaggio_originale').val();
	 $.post("<?php echo base_url()?>index.php/admin/messagehash",
		{
			messaggio_originale: messaggio_originale
		},
		function(data, status){
			$('#messaggio_cript').val(data);	 
            $("#messaggio_originaleval").val(messaggio_originale)
		});
   });
   
   $("#messagedecode").click(function(){
	 var messaggio_originale = $('#messaggio_originalehash').val();
	 $.post("<?php echo base_url()?>index.php/admin/messagedecode",
		{
			messaggio_originale: messaggio_originale
		},
		function(data, status){
			$('#messaggio_cript').val(messaggio_originale);	 
            $("#messaggio_originaleval").val(data)
		});
   });
 });

</script>	
