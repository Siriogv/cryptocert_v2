<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ERROR | E_WARNING | E_PARSE);

class Admin extends CI_Controller {
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
    {
         parent::__construct();
    	 $this->load->helper('url');
		 $this->load->library('session');
		 $this->load->library('form_validation');	
		 $this->load->model('model_user');
		 $this->load->model('model_object');
		 $time = $_SESSION['logged_incheck']['time'];
		 $time_check=$time-600;
		 $ins['login_time'] = $time_check;
		 $this->db->where('login_status',1);
		 $this->db->update("utenti",$ins);
		 if($time<$time_check) {
			
			 redirect('install/unlock/');
			 
		 }
		 
		
    }
    

	public function index()
	{       
		    $data['userinfo'] = $this->model_object->getElementById('utenti',$_SESSION['logged_incheck']['id']);
			$data['title'] = "Dashboard";
			if($_SESSION['logged_incheck']['tipologiaUtente']=='admin'){
				$data['certificat'] = $this->model_object->getAll('contenuto_certificato');	
			}else{
                $data['certificat'] = $this->model_object->getAllFromWhere('contenuto_certificato','operatore="'.$_SESSION['logged_incheck']['id'].'"');
			}
			$data['offcdata'] = $this->model_object->getElementById('dati_ufficio',1);
			$data['userdata'] = $this->model_object->getAllFromWhere('utenti','`id`<> 1');
			
			//echo "<pre>";print_r($_SESSION['logged_incheck']);echo $_SESSION['logged_incheck']['dipartimento '];die;
	   		$this->load->view('admin/adminheader',$data);
			$this->load->view('admin/dashboard',$data);
			$this->load->view('admin/adminfooter',$data);
		
		

		//$this->load->view('footer');
	}

	public function unlock(){
		$data['user'] = $_SESSION['logged_incheck']['email'];
			 $data['nickname'] = $_SESSION['logged_incheck']['nichname'];
			 $data['dipartimento']=$_SESSION['logged_incheck']['dipartimento'];
			$this->load->view('admin/page-lockscreen',$data);

	}
	
	public function archive()
	{       //&& $this->input->post('as2')==$this->input->post('as1')
		if($_POST ){ //print_r($_SESSION['logged_incheck']);die;
			$name = str_replace(" ","",$_SESSION['logged_incheck']['name']);
			if($this->input->post('folder')!=''){
				$origpath = "./cripted/archivio/".$name.'/'.$this->input->post('folder').'/';
			}else{
				$origpath = "./cripted/archivio/".$name.'/';
			}
		
			$usrid = $_SESSION['logged_incheck']['id'];
			//print_r($session->get('logged_incheck'));
			$config['upload_path']   = $origpath; 
			$config['allowed_types'] = 'gif|jpg|png|txt|doc|xls|pdf|odt|pps|mp3|avi|mp4|gif|zip|rar|htm|html'; 
			$this->load->library('upload', $config);
			//$upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
			if($this->input->post('newname')!=''){
                $file_name =$this->input->post('newname').".".pathinfo($_FILES['archive']['name'], PATHINFO_EXTENSION);
			}else{
				$file_name =str_replace(" ","_",$_FILES["archive"]["name"]);		
			}
			
			//$this->upload->do_upload('archive');
			//$data = array('upload_data' => $this->upload->data()); 
			$ins['path'] ='./cripted/archivio/'.$name.'/'.$file_name; 
            $extension = pathinfo($_FILES['archive']['name'], PATHINFO_EXTENSION);
			//echo "$origpath"."/".$file_name;
			move_uploaded_file($_FILES['archive']['tmp_name'], "$origpath"."/".$file_name);
			//	die('here');
			$data=date("d-m-Y H:m");
			$file="$origpath"."/".$file_name;
			$encrypted = md5($file_name);
			$fileb="$origpath"."/".$encrypted;
			$open=fopen($file, "r");					
			$contenuto_file=fread($open, filesize($file));
			$certificazione=hash("sha256", $contenuto_file);
			$codifica="sha256";
        	$hex = '';
			
			for ($i=0; $i< strlen($certificazione); $i++){
			$ord = ord($certificazione[$i]);
			$hexCode = dechex($ord);
			$n=strlen($ord);
			$hex .= substr($hexCode, -$n);
			}
			$hexx= strToUpper($hex);
			$ins['contenuto'] = $certificazione;
			$ins['data'] = $data;
			$ins['path'] = $file;
			$ins['codifica'] = $codifica;
			$ins['hex'] = $hex;
			$ins['operatore'] = $_SESSION['logged_incheck']['id'];
			$ins['scadenza'] = $this->input->post('scadenza');
			$ins['bc'] = '';
			$ins['bclink'] = '';
			$ins['alert'] = 0;
			$ins['adv'] = $encrypted.$extension;
            $ins['ext_addr'] = 0;
			$ins['estenzione'] = $extension;
			$ins['identificativo'] = $this->input->post('pubblic');
			//print_r($_SESSION);
			//print_r($ins);die;
			
			$this->db->insert('contenuto_certificato',$ins);
			
			//INSERT DATA IN ARCHIVO
			$inarch['crypted'] = $fileb;
			$inarch['original'] = $file;
			$inarch['user'] = $_SESSION['logged_incheck']['id'];
			$this->db->insert('archivio',$inarch);			
			
			//INSERT DATA IN registro

            $inreg['contenuto'] = $certificazione;
			$inreg['data'] = $data;
			$inreg['path'] = $file;
			$inreg['codifica'] = $fileb;
			$inreg['hex'] = $hexx;
			$inreg['operatore'] = $_SESSION['logged_incheck']['id'];
			$inreg['data_eliminazione'] = '';
			$inreg['esecutore'] = $encrypted;
			
			$this->db->insert('registro',$inreg);
			$open="log.html";
			$log=fopen($open, "a+");
		    fputs($log,"<h5>".$this->input->post('scadenza')." | ".$_SESSION['logged_incheck']['name']." | has uploaded the file: : $file <br>");
			fclose($log);	
			
			//log_message('info', "<h5>il $data $_SESSION[who_utente] ha inserito il file: $file <br>");
			redirect('admin/filesearch');
			
		}
			$L=array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
			$n1=rand(0,100);
			$n2=rand(0,1000);
			$n3=rand(0,10000);
			
			$selettore=count($L)-1;
			
			//$L1=explode(",", $L);
			
			$selettore2=rand(0,$selettore);
			$selettore3=rand(0,$selettore);
			$selettore4=rand(0,$selettore);
			
			$c1=$L[$selettore2];
			$c2="$n1-$n2";
			$c3=$L[$selettore3];
			$c4=$L[$selettore4];
			$c5=$n3;
			$unicode=$c1."-".$c2."-".$c3."-".$c4.$c5;
			$data['unicode']= $unicode;
			$data['title'] = "Archive";
			$data['userinfo'] = $this->model_object->getElementById('utenti',$_SESSION['logged_incheck']['id']);
			$data['files'] = $this->model_object->getAllFromWhere('cartelle_utenti','user="'.$_SESSION['logged_incheck']['id'].'"');
			//$data['userinfo'] = $this->model_object->getElementById('utenti',$_SESSION['logged_incheck']['id']);
			$data['offcdata'] = $this->model_object->getElementById('dati_ufficio',1);
	   		$this->load->view('admin/adminheader',$data);
			$this->load->view('admin/archive',$data);
			$this->load->view('admin/adminfooter',$data);
		

		//$this->load->view('footer');
	}
	 
	public function deletefile($id){
		$id = $id;
		$delfiles = $this->model_object->getAllFromWhere('contenuto_certificato','id="'.$id.'"');
		$this->db->delete('archivio', array('original' => $delfiles[0]->path));
		$this->db->delete('registro', array('path' => $delfiles[0]->path));
		$this->db->delete('contenuto_certificato', array('id' => $id));
                unlink(FCPATH . $delfiles[0]->path);
	    redirect('/admin/filesearch', 'refresh');

	}

	public function enableoperator()
	{       
		if($_POST){
			$password=md5($this->input->post('password'));
			//$stato=1;
			$avatardefault = "avatar/default.jpg";
			$ins['nominativo'] = $this->input->post('nominativo')." ".$this->input->post('surname');
			$ins['email'] = $this->input->post('email');
			$ins['password'] = $password;
            $ins['tipologiaUtente'] = $this->input->post('tipologiaUtente');
			$ins['stato'] = $this->input->post('stato');
			$ins['autorizzazioni'] = '';
			$ins['contatti'] = '';
			$ins['avatar'] = $avatardefault;
			$ins['nickname'] = '';
			$ins['dipartimento'] = '';
			$ins['userwallet'] = $this->input->post('wallet');
			$ins['stato'] = $this->input->post('status');
			$this->db->insert('utenti',$ins);
			redirect('admin/listoperator');exit;

		}
		    $data['user'] = $this->model_object->getAllUnique('tipologia_utenti');
			$data['title'] = "Dashboard";
			$data['department'] = $this->model_object->getAll('dipartimenti');
			$data['usertype'] = $this->model_object->getAll('tipologia_utenti');
			$data['permission'] = $this->model_object->getAll('userpermission');
			$data['userinfo'] = $this->model_object->getElementById('utenti',$_SESSION['logged_incheck']['id']);
			$data['offcdata'] = $this->model_object->getElementById('dati_ufficio',1);
	   		$this->load->view('admin/adminheader',$data);
			$this->load->view('admin/enableoperator',$data);
			$this->load->view('admin/adminfooter',$data);
		
		

		//$this->load->view('footer');
	}
    public  function listoperator()
	{       
			$data['title'] = "List Of Operator";
			$data['listoperators'] = $this->model_object->getAll('utenti');
			$data['userinfo'] = $this->model_object->getElementById('utenti',$_SESSION['logged_incheck']['id']);
			$data['offcdata'] = $this->model_object->getElementById('dati_ufficio',1);
	   		$this->load->view('admin/adminheader',$data);
			$this->load->view('admin/listoperat',$data);
			$this->load->view('admin/adminfooter',$data);
		
		

		//$this->load->view('footer');
	}

	public function editoperatorval(){

		   // echo "<pre>";print_r($_POST);print_r($_FILES);die;
			$usrid = $this->input->post('userid');
			 //print_r($session->get('logged_incheck'));
			 $config['upload_path']   = './avatar/'; 
			 $config['allowed_types'] = 'gif|jpg|png'; 
			 if($this->input->post('logochang')==1){
				 $this->load->library('upload', $config);
				echo $file_name = $_FILES["avatar"]["name"];
				 $this->upload->do_upload('logo');
				 $data = array('upload_data' => $this->upload->data()); 
				 if($file_name!=''){
					 $file_name = $_FILES["avatar"]["name"];
					 $this->upload->do_upload('avatar');
					 $data = array('upload_data' => $this->upload->data()); 
					 $ins['avatar'] ='avatar/'.$file_name; 
				 }
			 }
		 
			 $ins['nominativo'] = $this->input->post('nominativo')." ".$this->input->post('surname');
			 $ins['email'] = $this->input->post('email');
			 $ins['tipologiaUtente '] = $this->input->post('tipologiaUtente');
			 $ins['autorizzazioni '] = $this->input->post('autorizzazioni');
			 $ins['contatti'] = $this->input->post('contatti');
			 $ins['dipartimento'] = $this->input->post('dipartimento'); 
			 $ins['stato'] = $this->input->post('status'); 
			 $ins['nickname'] = $this->input->post('nickname'); 
			 $ins['userwallet '] = $this->input->post('wallet');
			 //echo "<pre>";print_r($ins);die;
			 $data['messagesuccess'] = "Profile edited successfully";
			 $this->db->where('id',$usrid);
			 $this->db->update('utenti',$ins); 	
			 redirect('admin/listoperator');
	  
	   
	}

	public function editoperator($id)
	{     
		
		
			$data['title'] = "Edit Operator";
			$data['department'] = $this->model_object->getAll('dipartimenti');
			$data['usertype'] = $this->model_object->getAll('tipologia_utenti');
			$data['permission'] = $this->model_object->getAll('userpermission');
			$data['userinfo'] = $this->model_object->getElementById('utenti',$id);
			$data['offcdata'] = $this->model_object->getElementById('dati_ufficio',1);
			$this->load->view('admin/adminheader',$data);
			$this->load->view('admin/editoperator',$data);
			$this->load->view('admin/adminfooter',$data);
		
		

		//$this->load->view('footer');
	}

	public function deleteoperater($id){
		$debid = $id;
	    $this->db->delete('utenti', array('id' => $id));
	    redirect('/admin/listoperator', 'refresh');
	}

	public function officedata()
	{     
		
		if($_POST){ 
			if($this->input->post('antispam')==$this->input->post('antispamchk')){
				$usrid = $_SESSION['logged_incheck']['id'];
				//print_r($session->get('logged_incheck'));
				$config['upload_path']   = './logo/'; 
				$config['allowed_types'] = 'gif|jpg|png'; 
				$this->load->library('upload', $config);
				//$upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
				if($this->input->post('logochange')==1){
					$file_name = $_FILES["logo"]["name"];
					$this->upload->do_upload('logo');
					$data = array('upload_data' => $this->upload->data()); 
					$ins['logo'] ='./logo/'.$file_name; 
				}
				
			
				$ins['intestazione'] = $this->input->post('intestazione');
				$ins['email'] = $this->input->post('email');
				$ins['telefono'] = $this->input->post('telefono');
				$ins['wallet'] = $this->input->post('wallet');
				
				$ins['enable_recapture'] = $this->input->post('recapture');
				$ins['secret_key'] = $this->input->post('secret');
			    $ins['site_key'] = $this->input->post('site');//echo "<pre>";print_r($ins);die;
				$this->db->where('id',$usrid);
				$this->db->update('dati_ufficio',$ins); 
				$data['messagesuccess'] = "Office data updated";	
			}else{
				$data['message'] = "Please input correct antispam data";
			}
			
		 
	 }  
			$data['title'] = "Office Data";
			$data['userinfo'] = $this->model_object->getElementById('utenti',$_SESSION['logged_incheck']['id']);
			$data['offcdata'] = $this->model_object->getElementById('dati_ufficio',1);
			//echo "<pre>";print_r($data['offcdata']);die;
			$this->load->view('admin/adminheader',$data);
			$this->load->view('admin/officedata',$data);
			$this->load->view('admin/adminfooter',$data);
		
		

		//$this->load->view('footer');
	}
	
	public function profile()
	{     
		
		if($_POST){ 
			
				$usrid = $_SESSION['logged_incheck']['id'];
				//print_r($session->get('logged_incheck'));
				$config['upload_path']   = './avatar/'; 
				$config['allowed_types'] = 'gif|jpg|png'; 
				if($this->input->post('logochange')==1){
				    $this->load->library('upload', $config);
					$file_name = $_FILES["avatar"]["name"];
					//print_r($_FILES);die;
					if($file_name!=''){
						$file_name = $_FILES["avatar"]["name"];
						move_uploaded_file($_FILES['avatar']['tmp_name'], "avatar"."/".$file_name);
						$ins['avatar'] ='avatar/'.$file_name; 
					}
				}
			
				$ins['nominativo'] = $this->input->post('nominativo');
				$ins['email'] = $this->input->post('email');
				$ins['tipologiaUtente '] = $this->input->post('tipologiaUtente');
				$ins['autorizzazioni '] = $this->input->post('autorizzazioni');
				$ins['contatti'] = $this->input->post('contatti');
				$ins['dipartimento'] = $this->input->post('dipartimento'); 
				$ins['stato'] = 1; 
				$ins['nickname'] = $this->input->post('nickname'); 
				$ins['userwallet '] = $this->input->post('wallet');
				if($this->input->post('changp')==1){
					$ins['password'] = md5($this->input->post('password'));
				}
			    $data['messagesuccess'] = "Profile edited successfully";
				$this->db->where('id',$usrid);
				$this->db->update('utenti',$ins); 	
		 
	    }  
			$data['title'] = "User Profile";
			$data['userinfo'] = $this->model_object->getElementById('utenti',$_SESSION['logged_incheck']['id']);
			$data['offcdata'] = $this->model_object->getElementById('dati_ufficio',1);
			$this->load->view('admin/adminheader',$data);
			$this->load->view('admin/profile',$data);
			$this->load->view('admin/adminfooter',$data);
		
		

		//$this->load->view('footer');
	}

	public function changepassword(){
		$data['title'] = "Change Password";
		if($_POST){
			if($this->input->post('newpassword')!=$this->input->post('conpassword')){
                $data['message']	="Password and confirm password are not same";
			}else{
                $ins['password'] = md5($this->input->post('newpassword'));//echo "<pre>";print_r($ins);die;
				$this->db->where('id',$_SESSION['logged_incheck']['id']);
				$this->db->update('utenti',$ins); 
				//$department = $this->input->post('dipartimento');
				$data['messagesuccess']	="Password is changed successfully";
			}

		}
		$data['userinfo'] = $this->model_object->getElementById('utenti',$_SESSION['logged_incheck']['id']);
		$data['offcdata'] = $this->model_object->getElementById('dati_ufficio',1);
		$this->load->view('admin/adminheader',$data);
		$this->load->view('admin/changepass',$data);
		$this->load->view('admin/adminfooter',$data);
		
	}

	public function department()
	{       
			$data['title'] = "New Department";
			if($_POST){
				//$department = $this->input->post('dipartimento');
				$ins['dipartimento'] = $this->input->post('dipartimento');
                $this->db->insert('dipartimenti',$ins);

			}
			$data['department'] = $this->model_object->getAll('dipartimenti');
			$data['userinfo'] = $this->model_object->getElementById('utenti',$_SESSION['logged_incheck']['id']);
			$data['offcdata'] = $this->model_object->getElementById('dati_ufficio',1);
			$this->load->view('admin/adminheader',$data);
			$this->load->view('admin/department',$data);
			$this->load->view('admin/adminfooter',$data);
		
		

		//$this->load->view('footer');
	}

	public function usertype()
	{       
			$data['title'] = "User Type";
			if($_POST){
				//$department = $this->input->post('dipartimento');
				$ins['qualifica'] = $this->input->post('usertype');
                $this->db->insert('tipologia_utenti',$ins);

			}
			$data['usertype'] = $this->model_object->getAll('tipologia_utenti');
			$data['userinfo'] = $this->model_object->getElementById('utenti',$_SESSION['logged_incheck']['id']);
			$data['offcdata'] = $this->model_object->getElementById('dati_ufficio',1);
			$this->load->view('admin/adminheader',$data);
			$this->load->view('admin/usertype',$data);
			$this->load->view('admin/adminfooter',$data);
		
		

		//$this->load->view('footer');
	}
	
	public function permission()
	{       
			$data['title'] = "User Permission";
			if($_POST){
				//$department = $this->input->post('dipartimento');
				$ins['permission'] = $this->input->post('permission');
                $this->db->insert('userpermission',$ins);

			}
			$data['userpermission'] = $this->model_object->getAll('userpermission');
			$data['userinfo'] = $this->model_object->getElementById('utenti',$_SESSION['logged_incheck']['id']);
			$data['offcdata'] = $this->model_object->getElementById('dati_ufficio',1);
			$this->load->view('admin/adminheader',$data);
			$this->load->view('admin/permission',$data);
			$this->load->view('admin/adminfooter',$data);
		
		

		//$this->load->view('footer');
	}

	public function createfolder()
	{       
			$data['title'] = "New Folder";
			$data['userinfo'] = $this->model_object->getElementById('utenti',$_SESSION['logged_incheck']['id']);
			$data['offcdata'] = $this->model_object->getElementById('dati_ufficio',1);
			if($_POST){
				$dir = "cripted/archivio/".$data['userinfo']->nominativo;
				if(!file_exists($dir)){
					mkdir($dir)or die('unable to create');
				}
				if ( !file_exists($dir) ) {
					mkdir ($dir, 0744);
				}
				$dir = "cripted/archivio/".$data['userinfo']->nominativo.'/'.$this->input->post('folder');
				if(!file_exists($dir)){
					mkdir($dir)or die('unable to create');
				}
				$folder = $this->input->post('folder');
				$ins['user'] = $_SESSION['logged_incheck']['id'];
				$ins['cartella'] = $this->input->post('folder');
                $this->db->insert('cartelle_utenti',$ins);

			}
			$dir ="cripted/archivio/".$data['userinfo']->nominativo;
			//$a = scandir($dir);
		// Sort in descending order
		    if(file_exists($dir)){
				$b = scandir($dir,1);//print_r($b);die;
			}
			$data['files'] = $this->model_object->getAllFromWhere('cartelle_utenti','user="'.$_SESSION['logged_incheck']['id'].'"');
		    //$data['files'] = $b;
			$data['department'] = $this->model_object->getAll('dipartimenti');
			$data['userinfo'] = $this->model_object->getElementById('utenti',$_SESSION['logged_incheck']['id']);
			$data['offcdata'] = $this->model_object->getElementById('dati_ufficio',1);
			$this->load->view('admin/adminheader',$data);
			$this->load->view('admin/folder',$data);
			$this->load->view('admin/adminfooter',$data);
		
		

		//$this->load->view('footer');
	}
	

	public function updatefile(){
		
		$ins['bclink '] = $this->input->post('blockchain');	
		$ins['bc'] = $this->input->post('tranhash');	
		$this->db->where('id',$this->input->post('docid'));
		$this->db->update('contenuto_certificato',$ins); 
		redirect('/admin/filesearch', 'refresh');
	}
	public function deletefolder($id){
		$debid = $id;
	    $this->db->delete('cartelle_utenti', array('id' => $id));
	    redirect('/admin/createfolder', 'refresh');
	}

	public function deletedepartment($id){
		$debid = $id;
	    $this->db->delete('dipartimenti', array('id' => $id));
	    redirect('/admin/department', 'refresh');
	}

	public function deleteusertype($id){
		$debid = $id;
	    $this->db->delete('tipologia_utenti', array('id' => $id));
	    redirect('/admin/usertype', 'refresh');
	}

	public function deletepermission($id){
		$debid = $id;
	    $this->db->delete('dipartimenti', array('id' => $id));
	    redirect('/admin/userpermission', 'refresh');
	}
	
	public function file(){

		$ip=$_SERVER['REMOTE_ADDR'];
		$date=date("d/m/Y H:i");
		$q=$this->model_object->getAllFromWhere('contenuto_certificato','hex="'.$_GET[h].'"');
		//$q=mysql_query("SELECT * FROM contenuto_certificato WHERE hex='$_GET[h]'");
		//$r=mysql_fetch_array($q);
		$u=mysql_query("SELECT * FROM comunicazioni_visure");
		$ru=mysql_fetch_array($u);
		
		if($q[0]->alert == 0){
			$message="<font color='#008000'>Status OK</font>";
		}else{
			$message="<font color='#FF0000'>Status Broken</font>";
		}
		if(!$q=mysql_query("INSERT INTO visure (data, ip, hex) VALUES ('$date', '$ip', '$_GET[h]')")) 
		die ("Errore critico, notifica non registrata");
		
		echo"
		<div id='headerimg' class='container limited'>
		<div class='row'>
		<div class='col-md-12'>
		<h5>Richiesta pervenuta da: $ip</h5>
		<h5>Il $date </h5>
		<h5>Check: $message</h5>
		<h5><a href='' javascript: 'window.close();'></h5>		
		";
	   }
	


	public function filesearch(){
		$dir ="cripted/archivio";
		$a = scandir($dir);
       // Sort in descending order
		$b = scandir($dir,1);//print_r($b);die;
		$data['files'] = $b;
		$data['title'] = "Search File";
		$data['department'] = $this->model_object->getAll('dipartimenti');
		$data['userinfo'] = $this->model_object->getElementById('utenti',$_SESSION['logged_incheck']['id']);
		
		if($_SESSION['logged_incheck']['tipologiaUtente']=='admin'){
			$data['certificat'] = $this->model_object->getAll('contenuto_certificato');	
		}else{
			$data['certificat'] = $this->model_object->getAllFromWhere('contenuto_certificato','operatore="'.$_SESSION['logged_incheck']['id'].'"');
		}
		//echo "<pre>";print_r($data['certificat']);die;
		$data['offcdata'] = $this->model_object->getElementById('dati_ufficio',1);
		
		$this->load->view('admin/adminheader',$data);
		$this->load->view('admin/filesearch',$data);
		$this->load->view('admin/adminfooter',$data);
		
	}

	public function certifyfile(){ //die();
		$data['userinfo'] = $this->model_object->getElementById('utenti',$_SESSION['logged_incheck']['id']);
		
	    $data['certificat'] = $this->model_object->getAllFromWhere('contenuto_certificato','id="'.$this->input->get('docid').'"');
	    $data['docid'] = $this->input->get('docid');
		$data['offcdata'] = $this->model_object->getElementById('dati_ufficio',1);
		//print_r($data['certificat']);die;
		$this->load->view('admin/adminheader',$data);
		$this->load->view('admin/certify',$data);
		$this->load->view('admin/adminfooter',$data);
		
	}

	public function log(){
		$open="log.html";
		$log=fopen($open, "a+");
		$json = file_get_contents('log.html');
	  // $obj = json_decode($json);
	  $data['content'] = $json;
	   //print '<pre>' . print_r($json) . '</pre>';die;
	   $data['offcdata'] = $this->model_object->getElementById('dati_ufficio',1);
	   $this->load->view('admin/adminheader',$data);
	   $this->load->view('admin/logcontent',$data);
	   $this->load->view('admin/adminfooter',$data);
		

	}

	public function messagehash(){
	   $message =  $this->input->post('messaggio_originale');
	   $messaggio=htmlentities($message, ENT_QUOTES);
	   $hash=hash("sha256", $messaggio);
       echo $hash;
	}

	public function deletemessage($id){
		$debid = $id;
	    $this->db->delete('messaggi', array('id' => $id));
	    redirect('/admin/message', 'refresh');
	 }

	public function message()
	{       
		if($_POST){
			
			$ins['operatore'] = $_SESSION['logged_incheck']['id'];
			$ins['messaggio'] = $this->input->post('messaggio_originale');
			$ins['hash'] = $this->input->post('messaggio_cript');
			$this->db->insert('messaggi',$ins);

		}
			$data['title'] = "Message encryption";
			$data['title1'] = "Retrieve sha256 code";
			$data['message'] = $this->model_object->getAllFromWhere('messaggi',"`operatore`='".$_SESSION['logged_incheck']['id']."'");
			$data['userinfo'] = $this->model_object->getElementById('utenti',$_SESSION['logged_incheck']['id']);
			$data['offcdata'] = $this->model_object->getElementById('dati_ufficio',1);
			$this->load->view('admin/adminheader',$data);
			$this->load->view('admin/message',$data);
			$this->load->view('admin/adminfooter',$data);
		
		

		//$this->load->view('footer');
	}

function logout()
{
    $ins['login_time'] = 0;
    $ins['login_status'] = 0;
    $this->db->where('id', $_SESSION['logged_incheck']['id']);
    $this->db->update("utenti", $ins); 
    $this->session->unset_userdata('logged_incheck');
    redirect('signin');
}

public function deleteLog() {
    // Controlla i permessi dell'utente se necessario
    if (!$this->session->userdata('is_logged_in')) {
        redirect('login'); // Reindirizza al login se l'utente non è autenticato
    }

    // Percorso del file di log
    $log_file_path = APPPATH . 'logs/logfile.log'; // Modifica il percorso se necessario

    // Verifica se il file esiste
    if (file_exists($log_file_path)) {
        // Elimina il file di log
        if (unlink($log_file_path)) {
            $this->session->set_flashdata('success', 'Log eliminato con successo.');
        } else {
            $this->session->set_flashdata('error', 'Errore durante l\'eliminazione del log.');
        }
    } else {
        $this->session->set_flashdata('error', 'Il file di log non esiste.');
    }

    // Reindirizza alla pagina precedente o a un'altra pagina
    redirect('admin/log');
    }
 } // Ensure this is the closing brace of the Admin cla
	/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
