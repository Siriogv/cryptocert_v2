<!DOCTYPE html>
<html lang="en">
<head>



	<meta charset="UTF-8">



	<title><?php if(isset($offcdata->intestazione) && $offcdata->intestazione!=''){ echo $offcdata->intestazione;}else{ echo $title;}?></title>



	<meta name="description" content="">



	<meta name="keywords" content="">



	<meta http-equiv="X-UA-Compatible" content="IE=edge">



	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">



	<meta name="format-detection" content="telephone=no">







	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?=base_url()?>/images/favicon/apple-touch-icon-144x144.png" />



	<link rel="icon" type="image/png" href="<?=base_url()?>/images/favicon/favicon-16x16.png" sizes="16x16" />



	<link rel="icon" type="image/png" href="<?=base_url()?>/images/favicon/favicon-32x32.png" sizes="32x32" />



	<link rel="icon" type="image/png" href="<?=base_url()?>/images/favicon/favicon-128x128.png" sizes="128x128" />



	



	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet">



	<link href="https://fonts.googleapis.com/css?family=Montserrat:700" rel="stylesheet">



	<link rel="stylesheet" href="<?=base_url()?>/assets/css/main.css">



</head>



<body>



	<div class="wrapper">



		<div class="loader text-primary">



			<i class="i-spinner loading"></i>



		</div>



                <aside id="sidebar" class="sidebar">



			<a href="dashboard-1.html" class="logo">



				 <b>Cryotocert V2.0</b>



			</a>



			<nav>



				<ul class="sidebar-list">



					<!--<li>



						<form class="input-group">



							<div class="input-group-icon"><i class="fas fa-search"></i></div>



							<input type="text" class="form-control" placeholder="Search...">



						</form>



					</li>-->



					<li><a class="sidebar-list-item" href="<?php echo base_url('index.php/')?>admin"><i class="fe fe-sliders"></i> <span>Dashboards</span></a></li>

                    <li><a class="sidebar-list-item" href="<?php echo base_url('index.php/')?>admin/archive"><i class="fe fe-layout"></i> <span>File Upload</span></a></li>

                    <li><a class="sidebar-list-item" href="<?php echo base_url('index.php/')?>admin/createfolder"><i class="fe fe-layout"></i> <span>New Folder</span></a></li>

                    <li><a class="sidebar-list-item" href="<?php echo base_url('index.php/')?>admin/filesearch"><i class="fe fe-layers"></i> <span>Archive</span></a></li>
					<li><a class="sidebar-list-item" href="<?php echo base_url('index.php/')?>admin/message"><i class="fe fe-message-square"></i> <span>Message</span></a></li>
					<li><a class="sidebar-list-item" href="<?php echo base_url('index.php/')?>admin/profile"><i class="fe fe-user"></i> <span>Profile</span></a></li>

					<?php //echo $_SESSION['logged_incheck']['dipartimento '];?>

					 <?php if(($_SESSION['logged_incheck']['tipologiaUtente'])=="admin" || $_SESSION['logged_incheck']['permission']=="god" || $_SESSION['logged_incheck']['id']==1){?> 
						<li class="sidebar-list-item"><i class="fe fe-settings"></i> <span>App Setting</span> <i class="fas fa-chevron-down pull-right"></i></li>
					<li>
						<ul>
						<li><a class="sidebar-list-item" href="<?php echo base_url('index.php/')?>admin/officedata"><i class="fe fe-layers"></i> <span>Office data</span></a></li>
						<li> <a class="sidebar-list-item" href="<?php echo base_url('index.php/')?>admin/listoperator"><i class="fe fe-user"></i> <span>Operators</span> </a></li>

						<li><a class="sidebar-list-item" href="<?php echo base_url('index.php/')?>admin/department"><i class="fe fe-layers"></i> <span>Departments</span></a></li>
						<li><a class="sidebar-list-item" href="<?php echo base_url('index.php/')?>admin/usertype"><i class="fe fe-user"></i> <span>User Type</span></a></li>
						<li><a class="sidebar-list-item" href="<?php echo base_url('index.php/')?>admin/permission"><i class="fe fe-edit"></i> <span>Permission</span></a></li>
                	</ul>
					</li>
					 
					 <li><a class="sidebar-list-item" href="<?php echo base_url('index.php/')?>admin/log"><i class="fe fe-message-square"></i> <span>Log</span></a></li>

					<?php }?>
                </ul>



			</nav>



		</aside>



		<header class="header">



			<ul class="header-nav">



				<li>



                                        <button id="sidebar-toggle" class="header-nav-item">



						<i class="fas fa-bars"></i>



					</button>



				</li>



			</ul>



		
			<ul class="header-nav pull-right">



				<li>



					<a href="#" data-dropdown class="header-nav-item">



						<i class="far fa-envelope"></i>



						<span class="badge badge-pill badge-success">2</span>



					</a>



					<ul class="dropdown-menu px-20 py-10">



						<li class="message">



							<div class="avatar avatar-sm">



								<img src="images/avatar-3.jpg" alt="">



							</div>



							<div class="message-content">



								<div class="message-bubble">



									<p>Hello, John!</p>



								</div>



								<small class="text-secondary text-sm">Today, 10:31</small>



							</div>



							<div class="message-actions">



								<button><i class="far fa-trash-alt"></i></button>



								<button><i class="far fa-flag"></i></button>



							</div>



						</li>



						<li class="message">



							<div class="avatar avatar-sm">



								<img src="images/avatar-3.jpg" alt="">



							</div>



							<div class="message-content">



								<div class="message-bubble">



									<p>What about our project?</p>



								</div>



								<small class="text-secondary text-sm">Today, 10:32</small>



							</div>



							<div class="message-actions">



								<button><i class="far fa-trash-alt"></i></button>



								<button><i class="far fa-flag"></i></button>



							</div>



						</li>



					</ul>



				</li>



				<li>



					<a href="#" data-dropdown class="header-nav-item">



						<i class="far fa-bell"></i>



						<span class="badge badge-pill badge-primary">3</span>



					</a>



					<ul class="dropdown-menu px-20 py-10">



						<li class="event-column event-column-success">



							<div class="event-content">



								<small class="text-secondary"><i class="far fa-envelope"></i> From example@gmail.com</small>



								<p><a href="#">Alex White</a> sent you an email.</p>



							</div>



							<small class="text-secondary pull-right">1 hr.</small>



						</li>



						<li class="event-column event-column-primary">



							<div class="event-content">



								<small class="text-secondary"><i class="fas fa-thumbtack"></i> New task</small>



								<p><b>To <a href="#">John Doe</a>: new API methods.</b></p>



								<p class="text-secondary text-sm">Implement new API methods for mobile app.</p>



							</div>



							<small class="text-secondary pull-right">7 min.</small>



						</li>



						<li class="event-column event-column-secondary">



							<div class="event-content">



								<small class="text-secondary"><i class="far fa-bell"></i> Notification</small>



								<p><a href="#">Alex White</a> joined to project</p>



							</div>



							<small class="text-secondary pull-right">now</small>



						</li>



					</ul>



				</li>



				<li>



					<a href="#" data-dropdown class="user-panel">



						<div class="user-panel-image">



							<div class="avatar avatar-sm">



							<?php if($userinfo->avatar==""){?>



								<img src="<?php echo base_url()?>/avatar/images.jpg" alt="">



							<?php }else{?>



							    <img src="<?php echo base_url()?>/<?=$userinfo->avatar?>" alt="">	



							<?php }?>



							</div>



						</div>



						<div class="user-panel-info">



							<p><?=$userinfo->nominativo?></p>



							<small class="text-black-50"><?=$userinfo->dipartimento?></small>



						</div>



					</a>



					<ul class="dropdown-menu">



						<li><a class="dropdown-item" href="page-profile.html"><i class="far fa-user"></i> Profile</a></li>



						<li class="dropdown-divider"></li>



						<li><a class="dropdown-item" href="<?php echo base_url('index.php/')?>admin/logout"><i class="fas fa-power-off"></i> Logout</a></li>



					</ul>



				</li>



			</ul>



                </header>
