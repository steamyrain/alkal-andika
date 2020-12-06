<?php

class user_model extends CI_Model{

	public function ambil_data($id)
	{
		$this->db->where('username', $id);
		return $this->db->get('user')->row();
	}

    public function getUserOperator(){
        $this->db->select("id,username");
        $this->db->from("user");
        $this->db->where("job_id = 1 or job_id = 2");
        $this->db->order_by("username");
        return $this->db->get();
    }

	public function getId($username)
	{
        $this->db->select("id");
		$this->db->where('username', $username);
        $this->db->from('user');
        $this->db->limit(1);
		return $this->db->get();
	}
}
