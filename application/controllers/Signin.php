<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Signin extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(['url', 'cookie']);
        $this->load->library(['session', 'form_validation']);
    }

    public function index()
    {
        $data['title'] = 'Sign in';
        $path = "./application/config/database.php";

        if (!file_exists($path)) {
            redirect('/install/index', 'refresh');
        } else {
            $this->load->model('model_object');
            $data['offcdata'] = $this->model_object->getElementById('dati_ufficio', 1);
            $this->load->view('header');
            $this->load->view('signin', $data);
            $this->load->view('footer');
        }
    }

    public function forgetpassword()
    {
        $this->load->model('model_object');
        $data['offcdata'] = $this->model_object->getElementById('dati_ufficio', 1);

        if ($_POST) {
            $alphabet = range('A', 'Z');
            $unicode = $alphabet[random_int(0, count($alphabet) - 1)] . "-" .
                       random_int(0, 100) . "-" .
                       $alphabet[random_int(0, count($alphabet) - 1)] . "-" .
                       random_int(0, 10000);

            $to = $this->input->post('email');
            $subject = 'New Password';
            $headers = 'From: ' . $data['offcdata']->email . "\r\n" .
                       "Reply-To: noreply@oonthe.link\r\n" .
                       "MIME-Version: 1.0\r\n" .
                       "Content-Type: text/html; charset=ISO-8859-1\r\n";

            $message = "<html><body><p><strong>Login with this password: </strong> {$unicode}</p></body></html>";

            if (mail($to, $subject, $message, $headers)) {
                $this->db->where('email', $this->input->post('email'));
                $this->db->update('utenti', ['password' => md5($unicode)]);
                $data['messagesuccess'] = "Password sent to email, please check.";
            }
        }

        $data['title'] = "Recover Password";
        $this->load->view('header');
        $this->load->view('forgotpassword', $data);
        $this->load->view('footer');
    }

    public function login()
    {
        $this->load->model(['model_object', 'model_user']);

        if ($this->input->post('rememberme') === 'remember') {
            set_cookie([
                'name'   => 'remember_me_token',
                'value'  => 'Random string',
                'expire' => '1209600', // Two weeks
                'domain' => 'cryptocert.oonthe.link/',
                'path'   => '/'
            ]);
        }

        if ($_POST) {
            $offdata = $this->model_object->getElementById('dati_ufficio', 1);

            if ($offdata->enable_recapture) {
                $recaptchaResponse = trim($this->input->post('g-recaptcha-response'));
                $url = "https://www.google.com/recaptcha/api/siteverify?secret={$offdata->secret_key}&response={$recaptchaResponse}&remoteip=" . $this->input->ip_address();

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                $status = json_decode(curl_exec($ch), true);
                curl_close($ch);

                if (!$status['success']) {
                    redirect('signin');
                }
            }

            $username = $this->input->post('email');
            $password = $this->input->post('password');
            $result = $this->model_user->checkuser('utenti', $username, $password);

            if ($result) {
                $getUser = $this->model_object->getElementById('utenti', $result[0]->id);
                $this->session->set_userdata('logged_incheck', [
                    'id' => $getUser->id,
                    'email' => $getUser->email,
                    'nickname' => $getUser->nickname,
                    'dipartimento' => $getUser->dipartimento,
                    'permission' => $getUser->autorizzazioni,
                    'tipologiaUtente' => $getUser->tipologiaUtente,
                    'name' => $getUser->nominativo,
                    'time' => time()
                ]);

                $this->db->where('id', $getUser->id);
                $this->db->update("utenti", [
                    'login_time' => time(),
                    'login_status' => 1
                ]);

               $getexpiry = $this->model_object->getAllFromWhere('contenuto_certificato', ['scadenza <=' => date('d/m/Y')]);
                foreach ($getexpiry as $filedel) {
                    $this->db->delete('contenuto_certificato', ['id' => $filedel->id]);
                    $this->db->delete('archivio', ['original' => $filedel->path]);
                    unlink(base_url() . $filedel->path);
                }

                redirect('admin');
            } else {
                $data['offcdata'] = $this->model_object->getElementById('dati_ufficio', 1);
                $data['error'] = "Ooops! Login Failed";
                $this->load->view('header');
                $this->load->view('signin', $data);
                $this->load->view('footer');
            }
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('logged_incheck');
        redirect('home');
    }
}

/* VECCHIO CODICE */
/*
?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ERROR | E_WARNING | E_PARSE);
class Signin extends CI_Controller {
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
/*	 
	public function __construct()
    {
         parent::__construct();
    	 $this->load->helper('url');
		 $this->load->library('session');
		 $this->load->library('form_validation');	
		 $this->load->helper('cookie');
		// $this->load->model('model_object');
		
    }

	public function index()
	{
	    $data['title']='Sign in';	
		//$this->load->view('header',$data);
		$path = "./application/config/database.php";
		if(!file_exists ($path)){
		redirect('/install/index', 'refresh');
	     }else{
			$this->load->model('model_object');
			$data['offcdata'] = $this->model_object->getElementById('dati_ufficio',1);
			$this->load->view('header');
			$this->load->view('signin',$data);
			$this->load->view('footer');
		}

		//$this->load->view('footer');
	}

	public function signup(){
		$this->load->view('header');
		$this->load->view('signup');
		$this->load->view('footer');
	}

	public function forgetpassword(){ //die('sssss');
		$this->load->model('model_object');
		$data['offcdata'] = $this->model_object->getElementById('dati_ufficio',1);
		if($_POST){
		
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
			$to = $this->input->post('email');;
			$subject = 'New Password';
			
			
		      $data['offcdata'] = $this->model_object->getElementById('dati_ufficio',1);//print_r($data['offcdata']);
			$headers = 'From: '.$data['offcdata']->email.'' . "\r\n" ."Reply-To: ". 'noreply@oonthe.link' . "\r\n";
			
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			$message = '<html><body>';
			$message .= '<p rules="all" style="border-color: #666;" cellpadding="10">';
			$message .= "<strong>Login with this password </strong>" .$unicode. "</p>";
			$message .= "</body></html>";
			
			if(mail($to, $subject, $message, $headers)){
				
				$upd['password'] = md5($unicode);
				$this->db->where('email',$this->input->post('email'));
				 $this->db->update('utenti',$upd); 
				 $data['messagesuccess'] = "Password send to email please check";
			}

		}
		
		$data['title'] = "Recover Password";
		$this->load->view('header');
		$this->load->view('forgotpassword',$data);
		$this->load->view('footer');
	}

	public function login()
 	{
	 //echo md5("12345");
		$this->load->model('model_object');
		$this->load->model('model_user');
		if($this->input->post('rememberme')=='remember')
		{
			$data['title']='Encrypt';//die('dddd');
			$cookie = array(
				'name'   => 'remember_me_token',
				'value'  => 'Random string',
				'expire' => '1209600',  // Two weeks
				'domain' => 'cryptocert.oonthe.link/',
				'path'   => '/'
			);
		
			set_cookie($cookie);
		}
		

	  if($_POST)
	   {
		$offdata = $this->model_object->getElementById('dati_ufficio',1); //echo "<pre>";print_r($offdata);
		if($offdata->enable_recapture) {
			$recaptchaResponse = trim($this->input->post('g-recaptcha-response'));
			$userIp=$this->input->ip_address();
			
			$secret = $offdata->secret_key;
			
			$url="https://www.google.com/recaptcha/api/siteverify?secret=".$secret."&response=".$recaptchaResponse."&remoteip=".$userIp;
			
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$output = curl_exec($ch);
			curl_close($ch);
			
			$status= json_decode($output, true); 
			if(!$status['success']){
				redirect('signin');
			}  

		} 
		
		 $username = $this->input->post('email');
		 $password = $this->input->post('password');
		   $result = $this->model_user->checkuser('utenti',$username,$password);
		   if($result)
		   {
			
			 $sess_array = array();
			
			   $getUser=$this->model_object->getElementById('utenti',$result[0]->id);
			   $sess_array = array(
				 'id' => $getUser->id,
				 'email' => $getUser->email,
				 'nickname '=>$getUser->nickname ,
				 'dipartimento ' => $getUser->dipartimento,
				 'permission'=>$getUser->autorizzazioni,
				 'tipologiaUtente'=>$getUser->tipologiaUtente,
				 'name'=>$getUser->nominativo,
				 'time' => time()
			   );
			 $this->session->set_userdata('logged_incheck', $sess_array);
			 $this->db->where('id',$getUser->id);
			 $ins['login_time'] = time();
			 $ins['login_status'] = 1;
			 $this->db->update("utenti",$ins);
                        $getexpiry = $this->model_object->getAllFromWhere('contenuto_certificato', ['scadenza <=' => date('d/m/Y')]);
			 foreach($getexpiry as $filedel){//print_r($filedel);
				$this->db->delete('contenuto_certificato', array('id' => $filedel->id));
				$this->db->delete('archivio', array('original' => $filedel->path));
				unlink(base_url().$filedel->path);
				//$sql ="delete from contenuto_certificato where id='".$filedel[id]."'";
			 }
			 redirect('admin');
		   }
		   else
		   {
			$data['offcdata'] = $this->model_object->getElementById('dati_ufficio',1);
			   $data['error'] = "Ooops! Login Failed";
			   $this->load->view('header');
			   $this->load->view('signin',$data);
			   $this->load->view('footer');
		   }
	   }
	   

	 
	}
	 
function logout()
  	{
		 $this->session->unset_userdata('logged_incheck');
		 redirect('home');
  	}	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */


