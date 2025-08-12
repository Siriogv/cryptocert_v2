<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logs extends CI_Controller {
    protected $user;
    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->library(['session','form_validation']);
        $this->load->model('model_object');
        $this->user = $this->session->userdata('logged_incheck');
        if(!$this->user || $this->user['tipologiaUtente'] !== 'admin'){
            show_error('Permission denied',403);
        }
    }

    public function index(){
        $log=fopen('log.html', 'a+');
        $json = file_get_contents('log.html');
        $data['content'] = $json;
        $data['offcdata'] = $this->model_object->getElementById('dati_ufficio',1);
        $this->load->view('admin/adminheader',$data);
        $this->load->view('admin/logcontent',$data);
        $this->load->view('admin/adminfooter',$data);
    }

    public function deleteLog(){
        $log_file_path = APPPATH . 'logs/logfile.log';
        if (file_exists($log_file_path)) {
            if (!unlink($log_file_path)) {
                $this->session->set_flashdata('error', 'Errore durante l\'eliminazione del log.');
            } else {
                $this->session->set_flashdata('success', 'Log eliminato con successo.');
            }
        } else {
            $this->session->set_flashdata('error', 'Il file di log non esiste.');
        }
        redirect('logs/index');
    }

    public function messagehash(){
        $message =  $this->input->post('messaggio_originale');
        $messaggio=htmlentities($message, ENT_QUOTES);
        $hash=hash('sha256', $messaggio);
        echo $hash;
    }

    public function deletemessage($id){
        if(!ctype_digit((string)$id)){ show_error('Invalid message id'); }
        $this->db->delete('messaggi', array('id' => $id));
        redirect('/logs/message', 'refresh');
    }

    public function message(){
        if($this->input->method() === 'post'){
            $this->form_validation->set_rules('messaggio_originale','Messaggio','required');
            $this->form_validation->set_rules('messaggio_cript','Hash','required');
            if($this->form_validation->run()){
                $ins['operatore'] = $this->user['id'];
                $ins['messaggio'] = $this->input->post('messaggio_originale');
                $ins['hash'] = $this->input->post('messaggio_cript');
                $this->db->insert('messaggi',$ins);
            }
        }
        $data['title'] = 'Message encryption';
        $data['title1'] = 'Retrieve sha256 code';
        $where = '`operatore`='.$this->db->escape($this->user['id']);
        $data['message'] = $this->model_object->getAllFromWhere('messaggi',$where);
        $data['userinfo'] = $this->model_object->getElementById('utenti',$this->user['id']);
        $data['offcdata'] = $this->model_object->getElementById('dati_ufficio',1);
        $this->load->view('admin/adminheader',$data);
        $this->load->view('admin/message',$data);
        $this->load->view('admin/adminfooter',$data);
    }
}

