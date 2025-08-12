<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

error_reporting(E_ERROR | E_WARNING | E_PARSE);

class Install extends CI_Controller {

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

		 $this->load->helper(array('form', 'url'));

		 $this->load->helper('file');

		// $this->load->model('model_object');

		// $this->load->model('model_user');

		 $this->load->library('email');

    }



	public function index()

	{

		$path = "./application/config/database.php";

		if(!file_exists ($path)) {

			$data['title'] = 'Create Host';

			$this->load->view('header');

			$this->load->view('createdb', $data);

			$this->load->view('footer');

		}else{

			redirect('install/createdatabase');

		}



	}

		public function unlock(){ //print_r($_SESSION);die;

         	$this->load->model('model_object');
           $data['user'] = $this->model_object->getAllFromWhere('utenti', ['login_status' => 1, 'login_time <=' => 0]);
           
		    $data['user'] = $data['user'][0]->email;

			 $data['nickname'] = $data['user'][0]->nichname;

			 $data['dipartimento']=$data['user'][0]->dipartimento;

			$this->load->view('admin/page-lockscreen',$data);



	}

	public function dbhost(){

	    $localhost=$this->input->post('hostname');

		$user=$this->input->post('username');

		$pass=$this->input->post('password');

		echo $db=$this->input->post('database');

		rename("./application/config/database1.php","./application/config/database.php");

		$data_db = file_get_contents('./application/config/database.php');

		// session_start();

		$temporary = str_replace("DATABASE", $db,$data_db);

		$temporary = str_replace("USERNAME", $user, $temporary);

		$temporary = str_replace("PASSWORD", $pass, $temporary);

		$temporary = str_replace("HOSTNAME", $localhost, $temporary);

		// Write the new database.php file

		$output_path = './application/config/database.php';

		$handle = fopen($output_path,'w+');

		// Chmod the file, in case the user forgot

		@chmod($output_path,0777);

		// Verify file permissions

		if(is_writable($output_path)) {

			// Write the file

			if(fwrite($handle,$temporary)) {

				redirect('install/createdatabase');

			} else {

				$data['message'] = "Error in creating database";

				$this->load->view('createdb',$data);

			}

		} else {

			$data['message'] = "Error in creating database";

			$this->load->view('header');

			$this->load->view('createhost',$data);

			$this->load->view('footer');

		}



	

	}

	

	public function createdatabase(){

		$this->load->model('model_object');

		$tables=$this->db->query("SHOW TABLES FROM `".$this->db->database."`")->result_array();

		if(count($tables)==0) {

			$sql = $this->db->query("CREATE TABLE tipologia_utenti

								   ( id INT ( 5 ) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 

									 qualifica varchar(200) NOT NULL,

									 stato INT ( 2 ) NOT NULL,

									 en_id INT(5) UNSIGNED,

									 it_id INT(5) UNSIGNED 

									 )");

			$sql = $this->db->query("CREATE TABLE dipartimenti

								   ( id INT ( 5 ) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 

									 dipartimento varchar(200) NOT NULL,

									 en_id INT(5) UNSIGNED,

									 it_id INT(5) UNSIGNED

									 )");

			$sql = $this->db->query("CREATE TABLE utenti

								   ( id INT ( 5 ) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 

									 nominativo varchar(200) NOT NULL,

									 email varchar(200) NOT NULL, 

									 password varchar(200) NOT NULL,

									 tipologiaUtente varchar(200) NOT NULL,

									 stato INT ( 11 ) NOT NULL,

									 autorizzazioni varchar(200) NOT NULL,

									 contatti varchar(200) NOT NULL,

									 avatar varchar(200) NOT NULL,

									 nickname varchar(200) NOT NULL,

									 dipartimento  varchar(200) NOT NULL,

									 userwallet   varchar(200) NOT NULL,
									 login_time varchar(200) NOT NULL,
                                     login_status INT(5) UNSIGNED,
									 en_id INT(5) UNSIGNED,

									 it_id INT(5) UNSIGNED

									 

									 )");

			$sql = $this->db->query("CREATE TABLE contenuto_certificato

								   ( id INT ( 5 ) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 

									 contenuto LONGTEXT NOT NULL,

									 data varchar(200) NOT NULL,

									 path varchar(200) NOT NULL,

									 codifica varchar(200) NOT NULL,

									 hex varchar(200) NOT NULL, 

									 operatore varchar(200) NOT NULL,

									 scadenza varchar(200) NOT NULL,

									 bc varchar(200) NOT NULL,

									 bclink varchar(200) NOT NULL,

									 alert INT(5) UNSIGNED,

									 adv INT(5) UNSIGNED,

									 ext_addr varchar(200) NOT NULL,

									 estenzione varchar(200) NOT NULL,

									 identificativo varchar(200) NOT NULL,

									 en_id INT(5) UNSIGNED,

									 it_id INT(5) UNSIGNED

									 )");

			$sql = $this->db->query("CREATE TABLE dati_ufficio

								   ( id INT ( 5 ) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 

									 logo varchar(200) NOT NULL,

									 intestazione varchar(200) NOT NULL,

									 email varchar(200) NOT NULL,

									 telefono varchar(200) NOT NULL,

									 wallet varchar(200) NOT NULL,

									 enable_recapture int(5) UNSIGNED,

									 secret_key varchar(200) NOT NULL,

									 site_key varchar(200) NOT NULL,

									 en_id INT(5) UNSIGNED,

									 it_id INT(5) UNSIGNED

									                             

									 )");

			$sql = $this->db->query("CREATE TABLE sicurezza

								   ( id INT (5 ) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 

									 licenza varchar(200) NOT NULL,

									 data_out varchar(200) NOT NULL,

									 en_id INT(5) UNSIGNED,

									 it_id INT(5) UNSIGNED

									 )");

			$sql = $this->db->query("CREATE TABLE archivio

								   ( id INT ( 10 ) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 

									 crypted  varchar(200) NOT NULL,

									 original 	 varchar(200) NOT NULL,

									 user  varchar(200) NOT NULL,

									 en_id INT(5) UNSIGNED,

									 it_id INT(5) UNSIGNED

									 )");



			$sql = $this->db->query("CREATE TABLE cartelle_utenti

								   ( id INT ( 10 ) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 

									 cartella  varchar(200) NOT NULL,

									 user  varchar(200) NOT NULL,

									 en_id INT(5) UNSIGNED,

									 it_id INT(5) UNSIGNED

									 )");

			$sql = $this->db->query("CREATE TABLE comunicazioni_visure

								   (id INT ( 10 ) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 

									 numero varchar(200) NOT NULL,

									 operatore  INT ( 10 ) UNSIGNED,

									 en_id INT(5) UNSIGNED,

									 it_id INT(5) UNSIGNED

									 )");



			$sql = $this->db->query("CREATE TABLE messaggi

								   ( id INT ( 10 ) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 

									 messaggio varchar(200) NOT NULL,

									 hash varchar(200) NOT NULL,

									 operatore varchar(200) NOT NULL,

									 en_id INT(5) UNSIGNED,

									 it_id INT(5) UNSIGNED

									 )");



			$sql = $this->db->query("CREATE TABLE registro

								   ( id INT ( 10 ) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 

									 contenuto varchar(200) NOT NULL,

									 data  varchar(200) NOT NULL,

									 path  varchar(200) NOT NULL,

									 codifica  varchar(200) NOT NULL,

									 hex  varchar(200) NOT NULL,

									 operatore  varchar(200) NOT NULL,

									 data_eliminazione  varchar(200) NOT NULL,

									 esecutore  varchar(200) NOT NULL,

									 en_id INT(5) UNSIGNED,

									 it_id INT(5) UNSIGNED

									 )");



			$sql = $this->db->query("CREATE TABLE visure

								   ( id INT ( 10 ) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 

									 data  varchar(200) NOT NULL,

									 hex  varchar(200) NOT NULL,

									 en_id INT(5) UNSIGNED,

									 it_id INT(5) UNSIGNED

									 )");


            $sql = $this->db->query("CREATE TABLE userpermission 
                                  
                                     (id INT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                      permission varchar(200) NOT NULL,
                                      en_id int(8) NOT NULL,
                                      it_id int(8) NOT NULL
                                    )");
                                    
			$add = "sitoabassocosto@gmail.com";

			$ogg = "Attivazione Encrypter";

			$mex = "$_SERVER[PHP_SELF] ha attivato l'Encrypter";

			$from = "From: advice@encrypter.com";

			//mail($add, $ogg, $mex, $from);

		}

		$query = $this->db->query('SELECT * FROM utenti');

		if($query->num_rows()>0){

			redirect('signin');

		}else{

			$data['title'] = "Create User";

			$this->load->view('header');

			$this->load->view('createuser',$data);

			$this->load->view('footer');

		}



	}

    public function usercreate(){

		$this->load->model('model_object');

		$admin="admin";

		$utente="utente";

		$stato=1;

		$autorizzazioni="god";

		$avatardefault='';



		$ins['qualifica'] = $admin;

		$ins['stato'] = $stato;

		$this->db->insert('tipologia_utenti',$ins);

      $insp['id'] = 2;

		$insp['permission'] = 'god';

		$this->db->insert('userpermission',$insp);

		$ins1['qualifica'] = $utente;

		$ins1['stato'] = $stato;

		$this->db->insert('tipologia_utenti',$ins1);;

//----------------------------------------------------------

		$L1=array("A,B,C,D,E,F,G,H,I,L,M,N,O,P,Q,R,S,T,U,V,Z");

		$n1=rand(0,100);

		$n2=rand(0,1000);

		$n3=rand(0,10000);

		$selettore=count($L1)-1;

		//$L1=explode(",", $L);

		$selettore2=rand(0,$selettore);

		$selettore3=rand(0,$selettore);

		$selettore4=rand(0,$selettore);

		$c1=$L1[$selettore2];

		$c2="$n1-$n2";

		$c3=$L1[$selettore3];

		$c4=$L1[$selettore4];

		$c5=$n3;

		$unicode=$c1."-".$c2."-".$c3."-".$c4."-".$c5;

		$client_unicode=md5($unicode);

		$exp_date=strtotime("+12 months");

//----------------------------------------------------------

		$pagina = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

		$scadenza=date("d/m/Y", $exp_date);

		$to="sitoabassocosto@gmail.com";

		$ogg="nuova installazione encrypter";

		$mex="Il sito $pagina ha attivato una licenza encrypter: $unicode con scadenza: $scadenza";

		$from="From: attivazioni_noreply@sitobassocosto.it";

		//mail($to, $ogg, $mex, $from);

		$ins3['licenza'] = $client_unicode;

		$ins3['data_out'] = $exp_date;

		$this->db->insert('sicurezza',$ins3);

		//$q.=$this->db->query("INSERT INTO sicurezza (licenza, data_out) VALUES ('$client_unicode', '$exp_date')");

		$logodefault = base_url()."images/logo.png";

		$password=md5($this->input->post('password'));

		$fresh="Amministrazione";

		$ins2['logo'] = $logodefault;

		$ins2['intestazione'] = '';

		$ins2['email'] = '';

		$ins2['enable_recapture'] = 0;
		$ins2['telefono'] = '';

		$this->db->insert('dati_ufficio',$ins2);

		//$q.=$this->db->query("INSERT INTO dati_ufficio (logo, intestazione, email, telefono) VALUES ('$logodefault', '', '', '')");

		$insur['nominativo'] = $this->input->post('username');

		$insur['email'] = $this->input->post('email');

		$insur['password'] = $password;

		$insur['tipologiaUtente'] = $admin;

		$insur['stato'] = $stato;

		$insur['autorizzazioni'] = $autorizzazioni;

		$insur['contatti'] = '';

		$insur['avatar'] = $avatardefault;

		$insur['nickname'] = $fresh;

		$insur['dipartimento'] = 'Amministrazione';

		$insur['userwallet'] = '';



		$this->db->insert('utenti',$insur);

		$data['title'] = "User Created";

	    redirect('install/thankyou');

	}





	public function thankyou(){

	//print_r($_POST);	

		$data['title'] = "User Created";

		$this->load->view('header');

		$this->load->view('thankyou');

		$this->load->view('footer');

	

	}

	

}



/* End of file welcome.php */

/* Location: ./application/controllers/welcome.php */

