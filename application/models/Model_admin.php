<?php
class model_admin extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function check_login($username, $password)
    {
        $this->db->select('*');
        $this->db->from('admin');
        $this->db->where('email', $username);
        $this->db->where('password', md5($password));
        $query = $this->db->get();
        return $query->result();
    }
}
?>
