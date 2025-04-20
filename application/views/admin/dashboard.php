
		<main class="content">
			<div class="container-fluid">
				<div class="content-header">
					<h1>Encrypter Dashboard <small></small></h1>
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item">Dashboard</li>
						</ol>
					</nav>
				</div>

				<!--<div class="row">
					<div class="col-md-6 col-lg-3">
						<div class="info-box">
							<div class="info-box-content">
								<div class="info-box-text">
									<span class="info-box-number">
										<?=count($userdata)?> <small class="text-sm text-success"><i class="fas fa-chevron-up"></i>+12</small>
									</span>
									New users
								</div>
								<div class="info-box-icon bg-primary">
									<i class="i-user"></i>
								</div>
							</div>
							<canvas class="info-box-chart" height="70" id="chartJs1"></canvas>
						</div>
					</div>
					<div class="col-md-6 col-lg-3">
						<div class="info-box">
							<div class="info-box-content">
								<div class="info-box-text">
									<span class="info-box-number">
										3510 <small class="text-sm text-danger"><i class="fas fa-chevron-down"></i>-3</small>
									</span>
									Sales
								</div>
								<div class="info-box-icon bg-success">
									<i class="i-shopping-cart"></i>
								</div>
							</div>
							<canvas class="info-box-chart" height="70" id="chartJs2"></canvas>
						</div>
					</div>
					<div class="col-md-6 col-lg-3">
						<div class="info-box">
							<div class="info-box-content">
								<div class="info-box-text">
									<span class="info-box-number">
										19 <small class="text-sm text-secondary"><i class="fas fa-minus"></i></small>
									</span>
									New comments
								</div>
								<div class="info-box-icon bg-warning">
									<i class="i-chat-bubble"></i>
								</div>
							</div>
							<canvas class="info-box-chart" height="70" id="chartJs3"></canvas>
						</div>
					</div>
					<div class="col-md-6 col-lg-3">
						<div class="info-box">
							<div class="info-box-content">
								<div class="info-box-text">
									<span class="info-box-number">
										19 <small class="text-sm text-success"><i class="fas fa-chevron-up"></i>+17%</small>
									</span>
									Bounce rate
								</div>
								<div class="info-box-icon bg-danger">
									<i class="i-circle-chart"></i>
								</div>
							</div>
							<canvas class="info-box-chart" height="70" id="chartJs4"></canvas>
						</div>
					</div>
				</div>-->
				<div class="box">
                <?php if(($_SESSION['logged_incheck']['dipartimento '])=="Amministrazione"){?>
				
					<div class="box-header">
						<h3 >Users</h3>
						<div class="box-actions">
							<a href="#" class="box-actions-item">Link</a>
							<button class="box-actions-item"><i class="fas fa-minus"></i></button>
							<button class="box-actions-item"><i class="fas fa-times"></i></button>
						</div>
					</div>
					<div class="table-responsive">
						<table class="table">
							<tbody>
								<tr>
									<th>ID</th>
									<th>Avatar</th>
									<th>Full name</th>
									<th>NickName</th>
									<th>Email</th>
									<th>Contact</th>
									<th>Department</th>
									<th>Wallet</th>
									<th>Status</th>
									
								</tr>
								<?php foreach($userdata as $user){?>
								<tr>
									<td><?=$user->id?></td>
									<td>
										<div class="avatar avatar-xs">
											<img src="<?=base_url().$user->avatar?>" alt="">
										</div>
									</td>
									<td><?=$user->nominativo?></td>
									<td><?=$user->nickname?></td>
									<td><?=$user->email?></td>
									<td><?=$user->contatti?></td>
									<td><?=$user->dipartimento?></td>
									<td><?=$user->wallet?></td>
									
									<?php if($user->stato==0){?>
										<td><span class="status-icon bg-warning"></span> Waiting</td>
									<?php }else{?>
										<td><span class="status-icon bg-success"></span> Approved</td>
									<?php }?>
									
									
								</tr>
									<?php }?>
							</tbody>
						</table>
					</div>
					
				</div>
					<?php }?>
				
					
					
					</div>
					<div class="box-body">
					

				<h2 class="content-title">Recently Uploaded File</h2>
	
			<!--	<div class="row">
					<div class="col-lg-6">
						<div class="card card-reverse">
							<div class="card-image transition-left">
								<img src="images/stock-2.jpg" alt="">
							</div>
							<div class="card-body">
								<h3>Lorem ipsum dolor.</h3>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi possimus vel magni.</p>
								<div class="user-panel">
									<div class="user-panel-image">
										<div class="avatar avatar-sm">
											<img src="images/avatar-1.jpg" alt="">
										</div>
									</div>
									<div class="user-panel-info">
										<p>John Doe</p>
										<small class="text-black-50">Two days ago</small>
									</div>
									<div class="user-panel-actions">
										<a href="#"><i class="fas fa-pencil-alt"></i></a>
										<a href="#"><i class="fas fa-share-alt"></i></a>
										<a href="#"><i class="fas fa-ellipsis-v"></i></a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="card">
							<div class="card-image transition-right">
								<img src="images/stock-4.jpg" alt="">
							</div>
							<div class="card-body">
								<h3>Lorem ipsum dolor.</h3>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi possimus vel magni.</p>
								<div class="user-panel">
									<div class="user-panel-image">
										<div class="avatar avatar-sm">
											<img src="images/avatar-1.jpg" alt="">
										</div>
									</div>
									<div class="user-panel-info">
										<p>John Doe</p>
										<small class="text-black-50">Two days ago</small>
									</div>
									<div class="user-panel-actions">
										<a href="#"><i class="fas fa-pencil-alt"></i></a>
										<a href="#"><i class="fas fa-share-alt"></i></a>
										<a href="#"><i class="fas fa-ellipsis-v"></i></a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>-->

				<div class="row">
				<?php
										$this->load->helper('qrcode');$this->load->model('model_object');
										$i = 0;
										foreach($certificat as $r){ //print_r($r);die;
											$qrcode = new QRCode();
							                $qrcode->setData(base_url()."/index.php/admin/file?h=$r->hex
								");
								$qrcode->setOutputEncoding(QRCode::$_ENCODING_UTF8);
								$qrcode->setOutPutFormat(QRCode::$_OUTPUT_FORMAT_PNG);
								$content = $qrcode->getContentsForPost();
								$QRCODE='<img src="'.$qrcode->getUrlQuery().'" width="100" height="100">';
								//echo FCPATH.str_replace('./','',$r->path);die;
								//echo base_url().str_replace('./','',$r->crypted);
							/*	$check1=fopen(base_url().str_replace('./','',$r->crypted), "r");
								$check2=fread($check1, filesize(FCPATH.str_replace('./','',$r->crypted)));
								$check3=hash($r->codifica, $check2);
								$data=date("d-m-Y H:m");
								
								if($r->contenuto != $check3){
									$ins['alert'] = 1;
			                        $this->db->where('id',$r->id);
									$ALERT=$this->db->update("contenuto_certificato",$ins);
									$cert="<div id='certno'><h3> Not Certified <span class='status-icon bg-warning'></span></h3></div>";
									$doc_v=base_url("images/file_broken.png");
									}else{	
									$cert="<div id='certok'><h3> Certified <span class='status-icon bg-success'></span></h3></div>";
									$doc_v= base_url("images/file.png");
									}


								$GLOBALS['hex'] = $r->hex;
								$GLOBALS['hash'] = $r->contenuto;
								$pathb=str_replace(base_url()."cripted/", "", $r->path);

								if($r->bclink != ""){
									$valore=file_get_contents($r->bclink);
									if(!strpos($valore, $r->hex)){
									$doc_v=base_url("images/file_broken.png");
									$cert="<div id='certno' class='col-lg-6'><h3> ARCHIVO</h3></div>";
									$ins['alert'] = 1;
			                        $this->db->where('id',$r->id);
									$ALERT=$this->db->update("contenuto_certificato",$ins);
									}			
										$trans="LINK BLOCKCHAIN: <a href='$r->bclink' title='$r->bclink'>$r->bclink</a>";
								}	
								if($r->ext_addr != "" && $r->ext_addr != 0){
									$cert="<div id='certbs' class='col-lg-6'><h3> BLOCKCHAIN <span class='status-icon bg-warning'></span></h3></div>";
									$extval=file_get_contents($r->ext_addr);
									$intval=file_get_contents($r->path);
									//echo "INT: $intval" . "EXT: $extval" 
									
										if(!$extval == $intval){ 
										$doc_v=base_url("images/file_broken.png");;
										$cert="<div id='certno' class='col-lg-6'><h3>NO BLOCKCHAIN MATCH<span class='status-icon bg-warning'></span></h3></div>";	
										$ins['alert'] = 1;
			                            $this->db->where('id',$r->id);
									    $ALERT=$this->db->update("contenuto_certificato",$ins);
										
										}else{
											$ins['alert'] = 0;
			                                $this->db->where('id',$r->id);
									        $ALERT=$this->db->update("contenuto_certificato",$ins);
										}
										}
							
										if($r->bclink != ""){
											if(!strpos($valore, $r->hex)){		
											$cert="<div id='certno' class='col-lg-6'><h3>NO BLOCKCHAIN MATCH<span class='status-icon bg-warning'></span></h3></div>";
											$trans="Accesso alla pagina <a href='$r->bclink' title='$r->bclink'>blockchain</a>";
											$doc_v=base_url("images/file_broken.png");				
										}
										   
										}*/	
										$query=$this->db->query("SELECT * FROM `utenti` where `id`='".$r->operatore."'");
										   $rowoperator = $query->result(); 
											?>

					<div class="col-md-4">
						<div class="card card-column">
							<div class="card-image">
							  <?=$QRCODE?>
							</div>
							<div class="card-body">
							<?php if($r->bclink != "" && $r->bc!=''){?>
							<div id='certok'><h3> Certified <span class='status-icon bg-success'></span></h3></div>
						<?php }else{?>
							<div id='certno'><h3> Not Certified <span class='status-icon bg-warning'></span></h3></div>
						<?php } ?>
								<p>Path: <?=$r->path?></p>				 
								<p>Block Chain Path: <?=$r->bclink?></p>
								<p>Hash:<?=$r->bc?></p>
								<div class="user-panel">
									<div class="user-panel-image">
										<div class="avatar avatar-sm">
											<img src="<?=base_url()?>/<?=$rowoperator[0]->avatar?>" alt="">
										</div>
									</div>
									<div class="user-panel-info">
										<p><?=$rowoperator[0]->nominativo?></p>
										<small class="text-black-50">Notarizing:<?=$r->data?></small>
									</div>
									<div class="user-panel-actions">
									     View File
										<a href="<?=base_url()?><?=$r->path?>"><i class="fas fa-pencil-alt"></i></a>
										
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php 
					
					$i++;
					if($i%3==0){
						echo '</div><div class="row">';
				 	   }
					}?>
				
				</div>

			<!--	<h2 class="content-title">Work</h2>

				<div class="row">
					<div class="col-lg-4">
						<div class="box">
							<div class="box-header">
								<h3>Chat</h3>
							</div>
							<div class="chat-content">
								<div class="chat-messages">

									<div class="message message-self">
										<div class="message-content">
											<div class="message-bubble">
												<p>Hello, Alex!</p>
											</div>
											<small class="text-secondary text-sm">Today, 10:35</small>
										</div>
										<div class="message-actions">
											<button><i class="far fa-trash-alt"></i></button>
										</div>
									</div>
									<div class="message message-self">
										<div class="message-content">
											<div class="message-bubble">
												<p>The project finally complete! Do you go to our team meeting? We have great news!</p>
											</div>
											<small class="text-secondary text-sm">Today, 10:35</small>
										</div>
										<div class="message-actions">
											<button><i class="far fa-trash-alt"></i></button>
										</div>
									</div>
									<div class="message">
										<div class="avatar avatar-sm">
											<img src="images/avatar-3.jpg" alt="">
										</div>
										<div class="message-content">
											<div class="message-bubble">
												<p>Yes, I'll come!</p>
											</div>
											<small class="text-secondary text-sm">Today, 10:36</small>
										</div>
										<div class="message-actions">
											<button><i class="far fa-trash-alt"></i></button>
											<button><i class="far fa-flag"></i></button>
										</div>
									</div>
								</div>
								<div class="chat-footer">
									<div class="input-group">
										<input id="inputGroupEmailButton2" type="text" class="form-control" placeholder="This is input with button">
										<button class="btn btn-primary">Send</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="box">
							<div class="box-header">
								<h3>Browser Usage</h3>
							</div>
							<div class="box-body">
								<canvas id="pieChartJs" class="chart" height="200"></canvas>
								<ul class="list-bordered unstyled">
									<li class="d-flex justify-content-between">Germany <span class="badge badge-primary badge-pill pull-right">+1236</span></li>
									<li class="d-flex justify-content-between">USA <span class="badge badge-primary badge-pill pull-right">+1031</span></li>
									<li class="d-flex justify-content-between">Australia <span class="badge badge-primary badge-pill pull-right">+833</span></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="box">
							<div class="box-header">
								<h3>Event columns</h3>
								<div class="box-actions">
									<a href="#" class="box-actions-item">Link</a>
									<button class="box-actions-item"><i class="fas fa-minus"></i></button>
									<button class="box-actions-item"><i class="fas fa-times"></i></button>
								</div>
							</div>
							<div class="box-body">
								<div class="event-column event-column-success">
									<div class="event-content">
										<small class="text-secondary"><i class="far fa-envelope"></i> From example@gmail.com</small>
										<p><a href="#">Alex White</a> sent you an email.</p>
									</div>
									<small class="text-secondary pull-right">1 hr.</small>
								</div>
								<div class="event-column event-column-success">
									<div class="avatar avatar-xs">
										<img src="images/avatar-2.jpg" alt="">
									</div>
									<div class="event-content">
										<small class="text-secondary"><i class="fas fa-code-branch"></i> awesome-branch</small>
										<p><a href="#">Sam Lee</a> new pull request.</p>
									</div>
									<small class="text-secondary pull-right">43 min.</small>
								</div>
								<div class="event-column event-column-primary">
									<div class="event-content">
										<small class="text-secondary"><i class="fas fa-thumbtack"></i> New task</small>
										<p><b>To <a href="#">John Doe</a>: new API methods.</b></p>
										<p class="text-secondary text-sm">Implement new API methods for mobile app.</p>
									</div>
									<small class="text-secondary pull-right">7 min.</small>
								</div>
								<div class="event-column event-column-secondary">
									<div class="event-content">
										<small class="text-secondary"><i class="far fa-bell"></i> Notification</small>
										<p><a href="#">Alex White</a> joined to project</p>
									</div>
									<small class="text-secondary pull-right">now</small>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<h2 class="content-title">Communication</h2>

				<div class="row">
					<div class="col-lg-8">
						<form action="/" class="box needs-validation" novalidate>
							<div class="box-header">
								<h3>Quick email</h3>
							</div>
							<div class="box-body">
								<div class="form-group">
									<label for="email">Email to:</label>
									<input type="email" class="form-control" id="email" required placeholder="Enter email">
									<span class="valid-feedback">Fine!</span>
									<span class="invalid-feedback">Email field is required.</span>
								</div>
																
								<div class="form-group">
									<label for="subject">Subject</label>
									<input type="text" class="form-control" id="subject" maxlength="100" required placeholder="Enter subject">
									<span class="valid-feedback">Fine!</span>
									<span class="invalid-feedback">Email field is required.</span>
								</div>

								<textarea id="ckeditor4"></textarea>
							</div>
							<div class="box-footer">
								<button type="submit" class="btn btn-primary pull-right">Send</button>
							</div>
						</form>
					</div>
					<div class="col-lg-4">
						<div class="box">
							<div class="box-header">
								<h3>Contacts</h3>
							</div>
							<div class="box-body">
								<div class="user-panel">
									<div class="user-panel-image">
										<div class="avatar avatar-sm">
											<img src="images/avatar-2.jpg" alt="">
											<i class="fas fa-circle text-success"></i>
										</div>
									</div>
									<div class="user-panel-info">
										<p>Sam Lee</p>
										<small class="text-black-50">iOS Developer</small>
									</div>
									<div class="user-panel-actions">
										<a href="#"><i class="fas fa-ellipsis-v"></i></a>
									</div>
								</div>
								<div class="user-panel">
									<div class="user-panel-image">
										<div class="avatar avatar-sm">
											<img src="images/avatar-3.jpg" alt="">
										</div>
									</div>
									<div class="user-panel-info">
										<p>Alex White</p>
										<small class="text-black-50">Frontend Developer</small>
									</div>
									<div class="user-panel-actions">
										<a href="#"><i class="fas fa-ellipsis-v"></i></a>
									</div>
								</div>
								<div class="user-panel">
									<div class="user-panel-image">
										<div class="avatar avatar-sm">
											<img src="images/avatar-4.jpg" alt="">
											<i class="fas fa-circle text-success"></i>
										</div>
									</div>
									<div class="user-panel-info">
										<p>Jessica Evans</p>
										<small class="text-black-50">iOS Developer</small>
									</div>
									<div class="user-panel-actions">
										<a href="#"><i class="fas fa-ellipsis-v"></i></a>
									</div>
								</div>
								<div class="user-panel">
									<div class="user-panel-image">
										<div class="avatar avatar-sm">
											<img src="images/avatar-6.jpg" alt="">
										</div>
									</div>
									<div class="user-panel-info">
										<p>Jacob Brown</p>
										<small class="text-black-50">Backend Developer</small>
									</div>
									<div class="user-panel-actions">
										<a href="#"><i class="fas fa-ellipsis-v"></i></a>
									</div>
								</div>
								<div class="user-panel">
									<div class="user-panel-image">
										<div class="avatar avatar-sm">
											<img src="images/avatar-7.jpg" alt="">
										</div>
									</div>
									<div class="user-panel-info">
										<p>Harry Taylor</p>
										<small class="text-black-50">Frontend Developer</small>
									</div>
									<div class="user-panel-actions">
										<a href="#"><i class="fas fa-ellipsis-v"></i></a>
									</div>
								</div>
								<div class="user-panel">
									<div class="user-panel-image">
										<div class="avatar avatar-sm">
											<img src="images/avatar-8.jpg" alt="">
										</div>
									</div>
									<div class="user-panel-info">
										<p>Sarah Miller</p>
										<small class="text-black-50">Frontend Developer</small>
									</div>
									<div class="user-panel-actions">
										<a href="#"><i class="fas fa-ellipsis-v"></i></a>
									</div>
								</div>
								<div class="user-panel">
									<div class="user-panel-image">
										<div class="avatar avatar-sm">
											<img src="images/avatar-9.jpg" alt="">
										</div>
									</div>
									<div class="user-panel-info">
										<p>Joanne Davies</p>
										<small class="text-black-50">Frontend Developer</small>
									</div>
									<div class="user-panel-actions">
										<a href="#"><i class="fas fa-ellipsis-v"></i></a>
									</div>
								</div>
							</div>
							<div class="box-footer">
								<a href="#" class="text-secondary text-sm d-block">Show more contacts <i class="fas fa-chevron-right"></i></a>
							</div>
						</div>
					</div>
				</div>-->
				
			</div>
		</main>
		