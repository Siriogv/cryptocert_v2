<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upload extends CI_Controller {
    protected $user;
    public function __construct(){
        parent::__construct();
        $this->load->helper(['url','security']);
        $this->load->library(['session','form_validation','upload']);
        $this->load->model('model_object');
        $this->user = $this->session->userdata('logged_incheck');
        if(!$this->user || $this->user['tipologiaUtente'] !== 'admin'){
            show_error('Permission denied',403);
        }
    }

    public function archive(){
        if($this->input->method() === 'post'){
            $this->form_validation->set_rules('scadenza','Scadenza','required');
            $this->form_validation->set_rules('pubblic','Identificativo','required');
            if($this->form_validation->run()){
                $name = str_replace(' ','',$this->user['name']);
                $folder = basename($this->input->post('folder'));
                $folder = sanitize_filename($folder);
                $relative_dir = 'cripted/archivio/'.$name.'/';
                if($folder != ''){ $relative_dir .= $folder.'/'; }
                $upload_dir = FCPATH.$relative_dir;
                if(!is_dir($upload_dir) && !mkdir($upload_dir,0755,TRUE)){
                    show_error('Unable to create upload directory.');
                }
                $origName = isset($_FILES['archive']['name']) ? basename($_FILES['archive']['name']) : '';
                $origName = sanitize_filename($origName);
                $newname = sanitize_filename($this->input->post('newname'));
                $extension = pathinfo($origName, PATHINFO_EXTENSION);
                $file_name = ($newname != '' ? $newname.($extension ? '.'.$extension : '') : str_replace(' ','_',$origName));
                if($file_name === '' || $file_name === '.' || $file_name === '..'){
                    show_error('Invalid file name.');
                }
                $config = array(
                    'upload_path'   => $upload_dir,
                    'allowed_types' => 'gif|jpg|png|txt|doc|xls|pdf|odt|pps|mp3|avi|mp4|zip|rar|htm|html',
                    'max_size'      => 4096,
                    'file_name'     => $file_name
                );
                $this->upload->initialize($config);
                if(!$this->upload->do_upload('archive')){
                    show_error($this->upload->display_errors());
                }
                $upload_data = $this->upload->data();
                $file_name = $upload_data['file_name'];
                $extension = ltrim($upload_data['file_ext'], '.');
                $file_full = $upload_data['full_path'];
                $file = './'.$relative_dir.$file_name;
                $ins['path'] = $file;
                $encrypted = md5($file_name);
                $fileb = './'.$relative_dir.$encrypted;
                $data_file=date('d-m-Y H:m');
                $open=fopen($file_full, 'r');
                $contenuto_file=fread($open, filesize($file_full));
                $certificazione=hash('sha256', $contenuto_file);
                $codifica='sha256';
                $hex = '';
                for ($i=0; $i< strlen($certificazione); $i++){
                    $ord = ord($certificazione[$i]);
                    $hexCode = dechex($ord);
                    $n=strlen($ord);
                    $hex .= substr($hexCode, -$n);
                }
                $hexx= strtoupper($hex);
                $ins['contenuto'] = $certificazione;
                $ins['data'] = $data_file;
                $ins['codifica'] = $codifica;
                $ins['hex'] = $hex;
                $ins['operatore'] = $this->user['id'];
                $ins['scadenza'] = $this->input->post('scadenza');
                $ins['bc'] = '';
                $ins['bclink'] = '';
                $ins['alert'] = 0;
                $ins['adv'] = $encrypted.$extension;
                $ins['ext_addr'] = 0;
                $ins['estenzione'] = $extension;
                $ins['identificativo'] = $this->input->post('pubblic');
                $this->db->insert('contenuto_certificato',$ins);
                $inarch['crypted'] = $fileb;
                $inarch['original'] = $file;
                $inarch['user'] = $this->user['id'];
                $this->db->insert('archivio',$inarch);
                $inreg['contenuto'] = $certificazione;
                $inreg['data'] = $data_file;
                $inreg['path'] = $file;
                $inreg['codifica'] = $fileb;
                $inreg['hex'] = $hexx;
                $inreg['operatore'] = $this->user['id'];
                $inreg['data_eliminazione'] = '';
                $inreg['esecutore'] = $encrypted;
                $this->db->insert('registro',$inreg);
                $log=fopen('log.html', 'a+');
                fputs($log,'<h5>'.$this->input->post('scadenza').' | '.$this->user['name'].' | has uploaded the file: : '.$file.' <br>');
                fclose($log);
                redirect('upload/filesearch');
            }
        }
        $letters = range('A','Z');
        $n1 = rand(0,100);
        $n2 = rand(0,1000);
        $n3 = rand(0,10000);
        $unicode = $letters[array_rand($letters)].'-'.$n1.'-'.$n2.'-'.$letters[array_rand($letters)].'-'.$letters[array_rand($letters)].$n3;
        $data['unicode'] = $unicode;
        $data['folders'] = $this->model_object->getAllFromWhere('cartelle_utenti','user='.$this->db->escape($this->user['id']));
        $data['title'] = 'Archive';
        $data['userinfo'] = $this->model_object->getElementById('utenti',$this->user['id']);
        $data['offcdata'] = $this->model_object->getElementById('dati_ufficio',1);
        $this->load->view('admin/adminheader',$data);
        $this->load->view('admin/archive',$data);
        $this->load->view('admin/adminfooter',$data);
    }

    public function deletefile($id){
        if(!ctype_digit((string)$id)){
            show_error('Invalid file id');
        }
        $delfiles = $this->model_object->getAllFromWhere('contenuto_certificato','id='.$this->db->escape($id));
        if(!$delfiles){ show_error('File not found'); }
        $this->db->delete('archivio', array('original' => $delfiles[0]->path));
        $this->db->delete('registro', array('path' => $delfiles[0]->path));
        $this->db->delete('contenuto_certificato', array('id' => $id));
        @unlink(FCPATH . $delfiles[0]->path);
        redirect('/upload/filesearch', 'refresh');
    }

    public function filesearch(){
        $dir ='cripted/archivio';
        $b = scandir($dir,1);
        $data['files'] = $b;
        $data['title'] = 'Search File';
        $data['department'] = $this->model_object->getAll('dipartimenti');
        $data['userinfo'] = $this->model_object->getElementById('utenti',$this->user['id']);
        if($this->user['tipologiaUtente']=='admin'){
            $data['certificat'] = $this->model_object->getAll('contenuto_certificato');
        }else{
            $where = 'operatore='.$this->db->escape($this->user['id']);
            $data['certificat'] = $this->model_object->getAllFromWhere('contenuto_certificato',$where);
        }
        $data['offcdata'] = $this->model_object->getElementById('dati_ufficio',1);
        $this->load->view('admin/adminheader',$data);
        $this->load->view('admin/filesearch',$data);
        $this->load->view('admin/adminfooter',$data);
    }

    public function certifyfile(){
        $docid = $this->input->get('docid');
        if(!ctype_digit((string)$docid)){
            show_error('Invalid document id');
        }
        $data['userinfo'] = $this->model_object->getElementById('utenti',$this->user['id']);
        $where = 'id='.$this->db->escape($docid);
        $data['certificat'] = $this->model_object->getAllFromWhere('contenuto_certificato',$where);
        $data['docid'] = $docid;
        $data['offcdata'] = $this->model_object->getElementById('dati_ufficio',1);
        $this->load->view('admin/adminheader',$data);
        $this->load->view('admin/certify',$data);
        $this->load->view('admin/adminfooter',$data);
    }
}

