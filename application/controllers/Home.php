<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
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
		
		 $this->load->model('model_object'); 
		
    }

	public function index()
	{
	    $data['title']='home';	
		//$this->load->view('header',$data);
		$this->load->view('frontend/home',$data);
		//$this->load->view('footer');
	}
	
	public function login()
 	{
 	//echo md5("12345");
		$this->form_validation->set_rules('email', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');
		$data['title']='MedicalCms/Login';
		$data['attributes'] = array('class' => 'form col', 'id' => 'myform');
		
	  if($_POST)
	   {
		   $username = $this->input->post('email');
		   $password = $this->input->post('password');
		   $result = $this->model_admin->check_login($username, $password);
		   if($result)
		   {
			
			 $sess_array = array();
			
			   $getUser=$this->model_object->getElementById('admin',$result[0]->id);
			   $sess_array = array(
				 'id' => $getUser->id,
				 'email' => $getUser->email,
				 'name'=>$getUser->fname.' '.$getUser->lname,
				 'role_id' => $getUser->role_id
			   );
			 $this->session->set_userdata('logged_incheck', $sess_array);
			 redirect('');
		   }
		   else
		   {
			 $this->session->set_userdata('error',"Ooops! Login Failed");			 
		   }
	   }
	   
	   $this->load->view('login',$data);
	 
	}
	 
function logout()
  	{
		 $this->session->unset_userdata('logged_incheck');
		 redirect('home');
  	}	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
