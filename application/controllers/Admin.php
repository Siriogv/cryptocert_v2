<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ERROR | E_WARNING | E_PARSE);

class Admin extends CI_Controller {
    protected $user;

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library(['session','form_validation']);
        $this->load->model('model_user');
        $this->load->model('model_object');

        $this->user = $this->session->userdata('logged_incheck');
        if (!$this->user) {
            redirect('signin');
        }

        $currentTime = time();
        $time_check = $currentTime - 600;
        $login_time = $this->user['time'];

        if ($login_time < $time_check) {
            redirect('install/unlock/');
        }

        $ins['login_time'] = $currentTime;
        $this->db->where('id', $this->user['id']);
        $this->db->update('utenti', $ins);

        $this->user['time'] = $currentTime;
        $this->session->set_userdata('logged_incheck', $this->user);
    }

    public function index()
    {
        $data['userinfo'] = $this->model_object->getElementById('utenti',$this->user['id']);
        $data['title'] = 'Dashboard';
        if($this->user['tipologiaUtente']=='admin'){
            $data['certificat'] = $this->model_object->getAll('contenuto_certificato');
        }else{
            $where = 'operatore='.$this->db->escape($this->user['id']);
            $data['certificat'] = $this->model_object->getAllFromWhere('contenuto_certificato',$where);
        }
        $data['offcdata'] = $this->model_object->getElementById('dati_ufficio',1);
        $data['userdata'] = $this->model_object->getAllFromWhere('utenti','`id`<> 1');

        $this->load->view('admin/adminheader',$data);
        $this->load->view('admin/dashboard',$data);
        $this->load->view('admin/adminfooter',$data);
    }

    public function unlock()
    {
        $data['user'] = $this->user['email'];
        $data['nickname'] = $this->user['nichname'];
        $data['dipartimento']=$this->user['dipartimento'];
        $this->load->view('admin/page-lockscreen',$data);
    }

    public function officedata()
    {
        if($this->user['tipologiaUtente'] !== 'admin'){
            show_error('Permission denied',403);
        }

        if($this->input->method() === 'post'){
            $this->form_validation->set_rules('intestazione','Intestazione','required');
            $this->form_validation->set_rules('email','Email','required|valid_email');
            $this->form_validation->set_rules('telefono','Telefono','required');
            $this->form_validation->set_rules('wallet','Wallet','required');

            if($this->form_validation->run()){
                if($this->input->post('antispam')==$this->input->post('antispamchk')){
                    $usrid = $this->user['id'];
                    $config['upload_path']   = './logo/';
                    $config['allowed_types'] = 'gif|jpg|png';
                    $this->load->library('upload', $config);
                    if($this->input->post('logochange')==1){
                        $file_name = $_FILES['logo']['name'];
                        if($file_name!=''){
                            $this->upload->do_upload('logo');
                            $data = array('upload_data' => $this->upload->data());
                            $ins['logo'] ='./logo/'.$file_name;
                        }
                    }

                    $ins['intestazione'] = $this->input->post('intestazione');
                    $ins['email'] = $this->input->post('email');
                    $ins['telefono'] = $this->input->post('telefono');
                    $ins['wallet'] = $this->input->post('wallet');
                    $ins['enable_recapture'] = $this->input->post('recapture');
                    $ins['secret_key'] = $this->input->post('secret');
                    $ins['site_key'] = $this->input->post('site');
                    $this->db->where('id',$usrid);
                    $this->db->update('dati_ufficio',$ins);
                    $data['messagesuccess'] = 'Office data updated';
                }else{
                    $data['message'] = 'Please input correct antispam data';
                }
            }
        }

        $data['title'] = 'Office Data';
        $data['userinfo'] = $this->model_object->getElementById('utenti',$this->user['id']);
        $data['offcdata'] = $this->model_object->getElementById('dati_ufficio',1);
        $this->load->view('admin/adminheader',$data);
        $this->load->view('admin/officedata',$data);
        $this->load->view('admin/adminfooter',$data);
    }

    public function logout()
    {
        $ins['login_time'] = 0;
        $ins['login_status'] = 0;
        $this->db->where('id', $this->user['id']);
        $this->db->update('utenti', $ins);
        $this->session->unset_userdata('logged_incheck');
        redirect('signin');
    }
}

