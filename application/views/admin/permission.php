
		<main class="content">
			<div class="container-fluid">
				<div class="content-header">
					<h1>Permission</h1>
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="dashboard-1.html">Dashboard</a></li>
							<li class="breadcrumb-item active">Permission</li>
						</ol>
					</nav>
				</div>

				<div class="row">
					<div class="col-lg-12">
						<form class="box needs-validation" novalidate method="post" action="<?php echo base_url('index.php/')?>admin/permission">
							
							<div class="box-body">
								<div class="row">
									<div class="col-sm-12 form-group">
										<label for="jsValidationnominativo"><b>Enter permission</b></label>
										<input id="jsValidationnominativo" name="permission" type="text" class="form-control" placeholder="Permission" required>
										<span class="valid-feedback">Fine!</span>
										<span class="invalid-feedback">Field is required.</span>
									</div>
									
								</div>
								
								
							</div>
							<div class="box-footer">
								<button class="btn btn-primary pull-right">Create</button>
							</div>
						</form>
					</div>
					
				</div>
				<div class="row">
				<?php if(count($userpermission)>0) {?>
			<div class="container-fluid">
			   <div class="box">
			   <div class="box-header">
						<h3 >Permission</h3>
						
					</div>
				<div class="row table-responsive">
				<table class="table">
									<tbody>
										<tr>
										<th></th>
											<th><b>ID</b></th>
											<th><b>Permission</b></th>
											
											<th><b>Action</b></th>
											
										</tr>
										<?php
										$i = 1;
										foreach($userpermission as $usrper){?>

										<tr>
											<td></td>
											<td><?=$i?></td>
											<td><?=$usrper->permission?></td>
										    <td>
												<div class="d-flex justify-content-between mb-5">
													
												   <a href="<?php echo base_url('index.php/')?>admin/deletepermission/<?=$usrper->id?>" data-widget="dismiss" class="alert-close"><i class="fas fa-times"></i></a>
												</div>
												
											</td>
											
										</tr>
										<?php $i++; }?>
									</tbody>
								</table>
				</div>
				</div>
				</div>
				<?php } ?>
			</div>
			</div>
		</main>


