<?php
class model_user extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    //insert into user table
    function insertUser($data)
    {
        return $this->db->insert('user', $data);
    }
    
    //send verification email to user's email id
    function sendEmail($to_email)
    {
        $from_email = 'team@mydomain.com'; //change this to yours
        $subject = 'Verify Your Email Address';
        $message = 'Dear User,<br /><br />Please click on the below activation link to verify your email address.<br /><br /> http://www.mydomain.com/user/verify/' . md5($to_email) . '<br /><br /><br />Thanks<br />Mydomain Team';
        
        //configure email settings
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.mydomain.com'; //smtp host name
        $config['smtp_port'] = '465'; //smtp port number
        $config['smtp_user'] = $from_email;
        $config['smtp_pass'] = '********'; //$from_email password
        $config['mailtype'] = 'html';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $config['newline'] = "\r\n"; //use double quotes
        $this->email->initialize($config);
        
        //send mail
        $this->email->from($from_email, 'Mydomain');
        $this->email->to($to_email);
        $this->email->subject($subject);
        $this->email->message($message);
        return $this->email->send();
    }
    
    //activate user account
    function verifyEmailID($key)
    {
        $data = array('status' => 1);
        $this->db->where('md5(email)', $key);
        return $this->db->update('user', $data);
    }

    //activate user account
    function checkuser($table,$user,$pass)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where('email', $user);
        $this->db->where('stato', 1);

        $query = $this->db->get();
        $row   = $query->row();

        if (!$row) {
            return false;
        }

        // Verify password using password_hash/password_verify.
        if (password_verify($pass, $row->password) || $row->password === md5($pass)) {
            // Rehash the password if it was stored using md5 or an outdated hash.
            if ($row->password === md5($pass) || password_needs_rehash($row->password, PASSWORD_DEFAULT)) {
                $newHash = password_hash($pass, PASSWORD_DEFAULT);
                $this->db->where('id', $row->id);
                $this->db->update($table, ['password' => $newHash]);
            }

            return [$row];
        }

        return false;
    }

    function getsum($table,$sum,$userid,$mode){
        $this->db->select_sum($sum);
        $this->db->from($table);
        $this->db->where('user_id',$userid);
        $this->db->where('mode_transaction',$mode);
        $query = $this->db->get();
        return  $query->row()->$sum;

    }
}
?>
