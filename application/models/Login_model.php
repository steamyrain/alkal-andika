<?php

class Login_model extends CI_Model{

    private $table = 'user';
    private $tableV = 'alkal_user_verificator';

	public function cek_login($username, $password)
	{
        $this->db->select(
            $this->table.'.id,'.
            $this->table.'.username,'.
            $this->table.'.email,'.
            $this->table.'.password,'.
            $this->table.'.level,'.
            $this->tableV.'.nip'
        );
        $this->db->join($this->tableV,$this->tableV.'.uId = '.$this->table.'.id','left');
		$this->db->where("username", $username);
		$this->db->where("password", $password);
        $this->db->from($this->table);
		return $this->db->get();
	}

	public function getLoginData($user, $pass)
	{
		$u = $user;
		$p = $pass;

		$query_cekLogin = $this->db->get_where('user', array('username' => $u, 'password' => $p));

		if (count($query_cekLogin->result()) > 0){
			foreach ($query_cekLogin->result() as $qck){
				foreach ($query_cekLogin->result() as $ck){
					$sess_data ['logged_in']	= TRUE;
					$sess_data ['username']		= $ck->username;
					$sess_data ['password']		= $ck->password;
					$sess_data ['level']		= $ck->level;
					$this->session->set_userdata($sess_data);
				}
				redirect('administrator/dashboard');
			}
}else{
	$this->session->set_flashdata('pesan','<div class="alert alert-warning alert-danger dismissible fade show" role="alert">
  				Username atau Password Anda Salah!
 				 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
   				 <span aria-hidden="true">&times;</span>
 				 </button>
				</div>');
	redirect('administrator/auth');
	}
}
}
