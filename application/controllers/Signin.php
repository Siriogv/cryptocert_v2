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
                $this->db->update('utenti', ['password' => password_hash($unicode, PASSWORD_DEFAULT)]);
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

        if ($this->input->post('rememberme')) {
            set_cookie([
                'name'   => 'remember_me_token',
                'value'  => 'Random string',
                'expire' => '1209600', // Two weeks
                'domain' => 'cryptocert.oonthe.link',
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

                $getexpiry = $this->model_object->getAllFromWhere('contenuto_certificato', 'scadenza <= ' . date('d/m/Y'));
                foreach ($getexpiry as $filedel) {
                    $this->db->delete('contenuto_certificato', ['id' => $filedel->id]);
                    $this->db->delete('archivio', ['original' => $filedel->path]);
                    unlink(FCPATH . $filedel->path);
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
