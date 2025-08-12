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
         $this->load->model('model_admin');

    }

	public function index()
	{
	    $data['title']='home';	
		//$this->load->view('header',$data);
		$this->load->view('frontend/home',$data);
		//$this->load->view('footer');
	}
	
function logout()
        {
                 $this->session->unset_userdata('logged_incheck');
                 redirect('home');
        }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
