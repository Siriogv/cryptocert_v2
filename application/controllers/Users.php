<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {
    protected $user;
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library(['session','form_validation','upload']);
        $this->load->model('model_object');
        $this->user = $this->session->userdata('logged_incheck');
        if(!$this->user || $this->user['tipologiaUtente'] !== 'admin'){
            show_error('Permission denied',403);
        }
    }

    public function enableoperator(){
        if($this->input->method() === 'post'){
            $this->form_validation->set_rules('nominativo','Nome','required');
            $this->form_validation->set_rules('surname','Cognome','required');
            $this->form_validation->set_rules('email','Email','required|valid_email');
            $this->form_validation->set_rules('password','Password','required');
            $this->form_validation->set_rules('tipologiaUtente','Tipologia utente','required');
            $this->form_validation->set_rules('stato','Stato','required');
            if($this->form_validation->run()){
                $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
                $avatardefault = 'avatar/default.jpg';
                $ins['nominativo'] = $this->input->post('nominativo').' '.$this->input->post('surname');
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
                $this->db->insert('utenti',$ins);
                redirect('users/listoperator');
                return;
            }
        }
        $data['user'] = $this->model_object->getAllUnique('tipologia_utenti');
        $data['title'] = 'Dashboard';
        $data['department'] = $this->model_object->getAll('dipartimenti');
        $data['usertype'] = $this->model_object->getAll('tipologia_utenti');
        $data['permission'] = $this->model_object->getAll('userpermission');
        $data['userinfo'] = $this->model_object->getElementById('utenti',$this->user['id']);
        $data['offcdata'] = $this->model_object->getElementById('dati_ufficio',1);
        $this->load->view('admin/adminheader',$data);
        $this->load->view('admin/enableoperator',$data);
        $this->load->view('admin/adminfooter',$data);
    }

    public function listoperator(){
        $data['title'] = 'List Of Operator';
        $data['listoperators'] = $this->model_object->getAll('utenti');
        $data['userinfo'] = $this->model_object->getElementById('utenti',$this->user['id']);
        $data['offcdata'] = $this->model_object->getElementById('dati_ufficio',1);
        $this->load->view('admin/adminheader',$data);
        $this->load->view('admin/listoperat',$data);
        $this->load->view('admin/adminfooter',$data);
    }

    public function editoperator($id){
        if(!ctype_digit((string)$id)){ show_error('Invalid user id'); }
        $data['title'] = 'Edit Operator';
        $data['department'] = $this->model_object->getAll('dipartimenti');
        $data['usertype'] = $this->model_object->getAll('tipologia_utenti');
        $data['permission'] = $this->model_object->getAll('userpermission');
        $data['userinfo'] = $this->model_object->getElementById('utenti',$id);
        $data['offcdata'] = $this->model_object->getElementById('dati_ufficio',1);
        $this->load->view('admin/adminheader',$data);
        $this->load->view('admin/editoperator',$data);
        $this->load->view('admin/adminfooter',$data);
    }

    public function editoperatorval(){
        $this->form_validation->set_rules('userid','User','required|integer');
        if($this->form_validation->run()){
            $usrid = $this->input->post('userid');
            $config['upload_path']   = './avatar/';
            $config['allowed_types'] = 'gif|jpg|png';
            if($this->input->post('logochang')==1){
                $this->upload->initialize($config);
                $file_name = $_FILES['avatar']['name'];
                if($file_name!=''){
                    $this->upload->do_upload('avatar');
                    $data = array('upload_data' => $this->upload->data());
                    $ins['avatar'] ='avatar/'.$file_name;
                }
            }
            $ins['nominativo'] = $this->input->post('nominativo').' '.$this->input->post('surname');
            $ins['email'] = $this->input->post('email');
            $ins['tipologiaUtente'] = $this->input->post('tipologiaUtente');
            $ins['autorizzazioni'] = $this->input->post('autorizzazioni');
            $ins['contatti'] = $this->input->post('contatti');
            $ins['dipartimento'] = $this->input->post('dipartimento');
            $ins['stato'] = $this->input->post('stato');
            $ins['nickname'] = $this->input->post('nickname');
            $ins['userwallet'] = $this->input->post('wallet');
            $this->db->where('id',$usrid);
            $this->db->update('utenti',$ins);
            redirect('users/listoperator');
        } else {
            show_error('Invalid data',400);
        }
    }

    public function deleteoperater($id){
        if(!ctype_digit((string)$id)){ show_error('Invalid user id'); }
        $this->db->delete('utenti', array('id' => $id));
        redirect('/users/listoperator', 'refresh');
    }

    public function profile(){
        if($this->input->method() === 'post'){
            $this->form_validation->set_rules('nominativo','Nome','required');
            $this->form_validation->set_rules('email','Email','required|valid_email');
            if($this->form_validation->run()){
                $usrid = $this->user['id'];
                $config['upload_path']   = './avatar/';
                $config['allowed_types'] = 'gif|jpg|png';
                if($this->input->post('logochange')==1){
                    $this->upload->initialize($config);
                    $file_name = $_FILES['avatar']['name'];
                    if($file_name!=''){
                        move_uploaded_file($_FILES['avatar']['tmp_name'], 'avatar/'.$file_name);
                        $ins['avatar'] ='avatar/'.$file_name;
                    }
                }
                $ins['nominativo'] = $this->input->post('nominativo');
                $ins['email'] = $this->input->post('email');
                $ins['tipologiaUtente'] = $this->input->post('tipologiaUtente');
                $ins['autorizzazioni'] = $this->input->post('autorizzazioni');
                $ins['contatti'] = $this->input->post('contatti');
                $ins['dipartimento'] = $this->input->post('dipartimento');
                $ins['stato'] = 1;
                $ins['nickname'] = $this->input->post('nickname');
                $ins['userwallet'] = $this->input->post('wallet');
                if($this->input->post('changp')==1){
                    $ins['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
                }
                $this->db->where('id',$usrid);
                $this->db->update('utenti',$ins);
            }
        }
        $data['title'] = 'User Profile';
        $data['userinfo'] = $this->model_object->getElementById('utenti',$this->user['id']);
        $data['offcdata'] = $this->model_object->getElementById('dati_ufficio',1);
        $this->load->view('admin/adminheader',$data);
        $this->load->view('admin/profile',$data);
        $this->load->view('admin/adminfooter',$data);
    }

    public function changepassword(){
        $data['title'] = 'Change Password';
        if($this->input->method() === 'post'){
            $this->form_validation->set_rules('newpassword','New Password','required');
            $this->form_validation->set_rules('conpassword','Confirm Password','required|matches[newpassword]');
            if($this->form_validation->run()){
                $ins['password'] = password_hash($this->input->post('newpassword'), PASSWORD_DEFAULT);
                $this->db->where('id',$this->user['id']);
                $this->db->update('utenti',$ins);
                $data['messagesuccess'] ='Password is changed successfully';
            } else {
                $data['message'] ='Password and confirm password are not same';
            }
        }
        $data['userinfo'] = $this->model_object->getElementById('utenti',$this->user['id']);
        $data['offcdata'] = $this->model_object->getElementById('dati_ufficio',1);
        $this->load->view('admin/adminheader',$data);
        $this->load->view('admin/changepass',$data);
        $this->load->view('admin/adminfooter',$data);
    }
}

