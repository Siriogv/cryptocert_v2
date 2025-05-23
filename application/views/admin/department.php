
		<main class="content">
			<div class="container-fluid">
				<div class="content-header">
					<h1>Department</h1>
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="dashboard-1.html">Dashboard</a></li>
							<li class="breadcrumb-item active">Department</li>
						</ol>
					</nav>
				</div>

				<div class="row">
					<div class="col-lg-12">
						<form class="box needs-validation" novalidate method="post" action="<?php echo base_url('index.php/')?>admin/department">
							
							<div class="box-body">
								<div class="row">
									<div class="col-sm-12 form-group">
										<label for="jsValidationnominativo"><b>Enter the name of the new department above</b></label>
										<input id="jsValidationnominativo" name="dipartimento" type="text" class="form-control" placeholder="ES: Nome Cognome" required>
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
				<?php if(count($department)>0) {?>
			<div class="container-fluid">
			   <div class="box">
			   <div class="box-header">
						<h3 >Department</h3>
						
					</div>
				<div class="row table-responsive">
				<table class="table">
									<tbody>
										<tr>
										<th></th>
											<th><b>ID</b></th>
											<th><b>Department</b></th>
											
											<th><b>Action</b></th>
											
										</tr>
										<?php
										$i = 1;
										foreach($department as $depart){?>

										<tr>
											<td></td>
											<td><?=$i?></td>
											<td><?=$depart->dipartimento ?></td>
										    <td>
												<div class="d-flex justify-content-between mb-5">
													
												   <a href="<?php echo base_url('index.php/')?>admin/deletedepartment/<?=$depart->id?>" data-widget="dismiss" class="alert-close"><i class="fas fa-times"></i></a>
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

