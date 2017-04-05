<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_auth extends CI_Model {

    function check_login($email, $password) {
        $this->load->library('bcrypt');
        $this->db->select('u.id, u.nama, u.password, ug.id_group')
        ->from('users u')
        ->join('users_groups ug', 'u.id=ug.id_user')
        ->where('u.email', $email);
        $query = $this->db->get();
        
        $result = $query->row();
        if ($result === NULL) {
            return FALSE;
        }
        var_dump($result);
        $id = $result->id;
        $nama = $result->nama;
        $id_group = $result->id_group;
        $stored_hash = $result->password;
        if ($this->bcrypt->check_password($password, $stored_hash)){
            $data = array(
                'id' => $id,
                'nama' => $nama,
                'logged_in' => TRUE,
                'role' => $id_group
                );
            $this->session->set_userdata($data);
            return TRUE;
            var_dump($data);
        }
        else {
            return FALSE;
        }
    }

}