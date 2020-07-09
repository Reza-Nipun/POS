<?php

class Welcome_model extends CI_Model {
    //put your code here
    
    public function login_check($data)
    {
        $this->db->select('*');
        $this->db->from('tb_user');
        $this->db->where('user_name', $data['username']);
        $this->db->where('user_password', $data['password']);
        $this->db->where('status', 1);
        $query_result=$this->db->get();
        $result=$query_result->row();

        return $result;
		
    }

}

?>