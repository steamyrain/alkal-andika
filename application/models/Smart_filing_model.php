<?php

class Smart_filing_model extends CI_Model{

	public function input_data($data){

			return $this->db->insert('smart_filing_in', $data);

		}

	public function input_data_out($data){

			return $this->db->insert('smart_filing_out', $data);

		}

	public function get_data(){

		return $this->db->get('smart_filing_in');

	}

	public function get_data_out(){

		return $this->db->get('smart_filing_out');

	}


	// public function ambil_data($id)
	// {
	// 	$this->db->where('username', $id);
	// 	return $this->db->get('user')->row();
	// }

}


?>