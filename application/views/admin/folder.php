
		<main class="content">
			<div class="container-fluid">
				<div class="content-header">
					<h1></h1>
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="dashboard-1.html">Dashboard</a></li>
							<li class="breadcrumb-item active">Create Folder</li>
						</ol>
					</nav>
				</div>

				<div class="row">
					<div class="col-lg-12">
						<form class="box needs-validation" novalidate method="post" action="<?php echo base_url('index.php/')?>admin/createfolder">
							
							<div class="box-body">
								<div class="row">
									<div class="col-sm-12 mb-3">
										<label for="jsValidationnominativo"><b>Enter the name of Folder</b></label>
										<input id="jsValidationnominativo" name="folder" type="text" class="form-control" required>
										
									</div>
									
								</div>
								
								
							</div>
							<div class="box-footer">
								<button class="btn btn-primary pull-right">Create</button>
							</div>
						</form>
					</div>
					
				</div>
				<?php if(count($files)>0) {?>
				<div class="row table-responsive">
				<table class="table">
									<tbody>
									<tr>	
										<?php
										$i = 1;
										foreach($files as $fol){?>

										     
											 <?php if($fol!='' &&  $fol!='..' && $fol!='.'){?>
																				
											<td>
											<div class="d-flex justify-content-between mb-5">
											<ul style="list-style:none">
											<li><a href="<?php //echo base_url('index.php/')?>#">
											<img src="<?php echo base_url()?>/images/normal_folder.png">
											 </a></li>
											<li><h3><span><?=$fol->cartella?></span></h3></li>
											 </ul>
											</div>
											</td>
										    <td>
												<div class="d-flex justify-content-between mb-5">
													
												   <a href="<?php echo base_url('index.php/')?>admin/deletefolder/<?=$fol->id?>" data-widget="dismiss" class="alert-close"><i class="fas fa-times"></i></a>
												</div>
												
											</td>
											 <?php }?>
										<?php $i++; }?>
										</tr>
									</tbody>
								</table>
				</div>
				<?php } ?>
			</div>
		</main>


