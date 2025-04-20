<style><style>
* {
  box-sizing: border-box;
}

#myInput {
  background-image: url('/css/searchicon.png');
  background-position: 10px 10px;
  background-repeat: no-repeat;
  width: 100%;
  font-size: 16px;
  padding: 12px 20px 12px 40px;
  border: 1px solid #ddd;
  margin-bottom: 12px;
}

#myTable {
  border-collapse: collapse;
  width: 100%;
  border: 1px solid #ddd;
  font-size: 18px;
}

#myTable th, #myTable td {
  text-align: left;
  padding: 12px;
}

#myTable tr {
  border-bottom: 1px solid #ddd;
}

#myTable tr.header, #myTable tr:hover {
  background-color: #f1f1f1;
}
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fff;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
  margin-left:350px
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<?php $this->load->helper('qrcode');$this->load->model('model_object');?>
		<main class="content">
			<div class="container-fluid">
			<div class="content-header">
				  <h1><?=$title?></h1>	
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="dashboard-1.html">Dashboard</a></li>
							<li class="breadcrumb-item active">Search File</li>
						</ol>
					</nav>
				</div>


			
				<?php if(count($files)>0) {?>
				<div class="row table-responsive">
				<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">
				<table  id="myTable" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
								
									
										<?php
										$i = 1;
										foreach($certificat as $r){ //echo "<pre>";print_r($r);die;
											$qrcode = new QRCode();
							$qrcode->setData(base_url()."/index.php/admin/file?h=$r->hex
								");
								$qrcode->setOutputEncoding(QRCode::$_ENCODING_UTF8);
								$qrcode->setOutPutFormat(QRCode::$_OUTPUT_FORMAT_PNG);
								$content = $qrcode->getContentsForPost();
								$QRCODE='<img src="'.$qrcode->getUrlQuery().'">';
								$path = str_replace('./','',$r->path);
								//$path1 = FCPATH.str_replace("/","'\'",$path);
							    //$pathfin = str_replace("'","",$path1);
								//echo base_url().str_replace("/","\",$r->path);
								$check1=fopen(base_url().str_replace('./','',$r->path), "r");
								$check2=fread($check1, filesize($path));
								$check3=hash($r->codifica, $check2);
								$data=date("d-m-Y H:m");
								$doc_v= base_url("images/file.png");
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
							
										}	
										$name=explode("/",$r->path);
										//$rowoperator = $query->result(); //print_r($rowoperator);	
											?>
                                        <?php if($r->bclink==''){
										   	$doc_v=base_url("images/file_broken.png");			
										 }else{
										    $doc_v=base_url("images/file.png");	
										  }?>
										<tr>
											
											
											<td>
		<div class='col-md-12'><?php //echo "<pre>";print_r($r);//die;?>
<a data-toggle='modal' data-target='#documento<?=$r->id?>'><img src='<?=$doc_v?>' width='30'><?=$name[count($name)-1]?></a>
				</div>

<div id='documento<?=$r->id?>' class='modal'>
<div class="modal-content col-lg-6">
    <span class="close" id="cloase">&times;</span>
    
	<div class="col-lg-6">
	<?php if($r->bclink != "" && $r->bc!=''){?>
		<div id='certok'><h3> Certified <span class='status-icon bg-success'></span></h3></div>
	<?php }else{?>
		<div id='certno'><h3> Not Certified <span class='status-icon bg-warning'></span></h3></div>
	<?php } ?>
	<div><?=$QRCODE?></div>
	<form action='<?=$_SERVER['PHP_SELF']?>' method='POST'>
	<?php if($r->bclink==''){?>	
		
		<input type='hidden' name='id' value='<?=$r->id?>'><br>
		<span><a href='<?php echo base_url()?>index.php/admin/certifyfile?docid=<?=$r->id?>'>Certifify in metamask</a> </span>
	<?php }else{?>
		<span><h5><b>Block chain link:</b><br><?=$r->bclink?></h5></span>
		<span><h5><b>Transaction Id:</b><br><?=$r->bc?></h5></span>
		<span><h5><b>Notarizing Date:</b><br><?=$r->data?></h5></span>
	<?php }?>	
</form>
	</div>
	
  </div>




		<a href="<?php echo base_url()?>/cripted/archivio/<?=$file?>" target="blank"><?=$file?></a></td>
		                        <td>
									<div class="d-flex justify-content-between mb-5">
										 <?php if($r->bclink==''){?>
										    <div style="color:red">
								               Not Certified
                                            </div>			
											
										 <?php }else{?>
											<div style="color:green">
								      Certified
                                            </div>
										 <?php }?>
								    </div>
												
								</td>
								<td>
												<div class="user-panel-actions">
													View
												   <a href="<?php echo base_url('')?><?=$r->path?>"  class="alert-close"><i class="fas fa-pencil-alt"></i></a>
												</div>
												
											</td>
										    <td>
												<div class="d-flex justify-content-between mb-5">
													
												   <a href="<?php echo base_url('index.php/')?>admin/deletefile/<?=$r->id?>" data-widget="dismiss" class="alert-close"><i class="fas fa-times"></i></a>
												</div>
												
											</td>
											
										</tr>
										<?php $i++; }?>
									
								</table>
				</div>
				<?php } ?>
			</div>
		</main>
	

<script>

function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}

$(".close").click(function() {
	$('.modal').modal('hide');
});
</script>

