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
						<div class="box">
							<div class="box-header">
								<h3 ><?=$title?></h3>
								<div class="box-header">
									<a href="<?php echo base_url('index.php/')?>admin/enableoperator" class="btn btn-primary"><h3>Add New User</h3></a>

								</div>
							</div>
							<div class="table-responsive">
								<table class="table">
									<tbody>
										<tr>
											<th>ID</th>
											<th>User</th>
											<th>Department</th>
											<th>Email</th>
											<th>User Type</th>
											<th>State</th>
											<th>Wallet</th>
											<th>Status</th>
											
										</tr>
										<?php 
										$i=1;
										foreach($listoperators as $list){?>

										<tr id="<?=$list->id?>">
										<?php $attributes = array("name" => "edituser","id"=> "edituser".$list->id);
                                           echo form_open_multipart("admin/editoperator", $attributes);?>
											<td><?=$i?></td>
											
											<td><?=$list->nominativo?></td>
											<td><?=$list->dipartimento?></td>
											<td><?=$list->email?></td>
											<td><?=$list->tipologiaUtente?></td>
											<?php if($list->stato==0){?>
												<td><span class="status-icon bg-warning"></span> Inactive</td>
											<?php }elseif($list->stato==2){?>
												<td><span class="status-icon bg-danger"></span> Blocked</td>
											<?php }else{?>
												<td><span class="status-icon bg-success"></span> Active</td>
											<?php }?>	
											<td><?=$list->userwallet?></td>
											<td> <input type="hidden" name="userid" id="userid" value="<?=$list->id?>">
												<div class="d-flex justify-content-between mb-5">
													<a href="<?=base_url()?>index.php/admin/editoperator/<?=$list->id?>"><i class="fas fa-pencil-alt"></i></a>
												    <a href="<?=base_url('index.php/')?>admin/deleteoperater/<?=$list->id?>" class="alert-close"> <i class="fas fa-times"></i></a>
												</div>
												
											</td>
											</form>
										</tr>
										<?php $i=$i+1;}?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				
			</div>
		</main>
		
