<?php

class Pmj_model extends CI_Model{
	public function tampil_data()
	{
		return $this->db->get('pmj');
	}

	public function input_data($data)
	{
		$this->db->insert('pmj', $data);
	}

	public function hapus_data($data){
		$this->db->delete('pmj',$data);
	}

	public function get_keyword($keyword){
		$this->db->select('*');
		$this->db->from('pmj');
		$this->db->like('nama', $keyword);
		$this->db->or_like('bidang',$keyword);
		$this->db->or_like('kegiatan',$keyword);
		$this->db->or_like('dokumentasi',$keyword);
		return $this->db->get()->result();
	}

	public function edit_data($where,$table)
	{
		return $this->db->get_where($table,$where);
	}

	public function update_data($where,$data,$table)
	{
		$this->db->where($where);
		$this->db->update($table,$data);
	}
	
	public function getSpecificPmj($name,$startDate,$endDate){
        $this->db->select('tanggal,waktu,kegiatan,lokasi');
        $this->db->from('pmj');
        $this->db->where("tanggal between '".$startDate."' and '".$endDate."'");
        $this->db->like('nama',$name);
        $this->db->order_by('tanggal');
        return $this->db->get();
    }

    public function showSpecificPmj($name){
       $this->db->select('pmj.*');
       $this->db->from('pmj');
       $this->db->like('nama',$name);
       return $this->db->get();
    }
}
