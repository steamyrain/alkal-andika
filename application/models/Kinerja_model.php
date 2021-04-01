<?php

class Kinerja_model extends CI_Model{

    private $newKinerjaTable = 'alkal_user_kinerja';

	public function tampil_data()
	{
		return $this->db->get('kinerja');
	}

	public function input_data($data)
	{
		$this->db->insert('kinerja', $data);
	}

	public function hapus_data($data){
		$this->db->delete('kinerja',$data);
	}

	public function get_keyword($keyword){
		$this->db->select('*');
		$this->db->from('kinerja');
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

    public function getSpecificKinerja($name,$startDate,$endDate){
        $this->db->select('tanggal,waktu,kegiatan,lokasi');
        $this->db->from('kinerja');
        $this->db->where("tanggal between '".$startDate."' and '".$endDate."'");
        $this->db->like('nama',$name);
        $this->db->order_by('tanggal');
        return $this->db->get();
    }

    public function getAllNewKinerja(){
        $this->db->select($this->newKinerjaTable.'.*');
        $this->db->from($this->newKinerjaTable);
        $this->db->order_by('emp_name');
        $this->db->order_by('job_date');
        $this->db->order_by('job_start');
        return $this->db->get();
    }

    public function getNewKinerjaToday($uid) {
        $this->db->select('job_rolename,job,job_start,job_end,job_date,valid_status,job_desc');
        $this->db->from($this->newKinerjaTable);
        $this->db->where('job_date = CURDATE() and uid = '.$uid);
        return $this->db->get();
    }

    public function getNewKinerjaForVerificator(string $nip){
        $this->db->select($this->newKinerjaTable.'.*');
        $this->db->from($this->newKinerjaTable);
        $this->db->join('alkal_user_pjlp_verificator_lookup','alkal_user_pjlp_verificator_lookup.uid = '.$this->newKinerjaTable.'.uid');
        $this->db->join('alkal_user_verificator','alkal_user_pjlp_verificator_lookup.nip = alkal_user_verificator.nip');
        $this->db->where('alkal_user_verificator.nip = '.$nip);
        $this->db->order_by('emp_name');
        $this->db->order_by('job_date');
        $this->db->order_by('job_start');
        return $this->db->get();
    }

    public function getPJLPForVerificator(string $nip){
        $this->db->select('a.username as pjlpName, c.role_name as pjlpRole, a.id as pjlpUID');
        $this->db->from('user a');
        $this->db->join('alkal_user_job_role_lookup b','b.uid = a.id');
        $this->db->join('alkal_user_job_role c','c.id = b.job_roleid');
        $this->db->join('alkal_user_pjlp_verificator_lookup d','d.uid = a.id');
        $this->db->where('d.nip = '.$nip);
        $this->db->order_by('a.username');
        $this->db->order_by('b.job_roleid');
        return $this->db->get();
    }

    public function getNewKinerjaForPrint($uid,$job_date_start,$job_date_end){
        $this->db->select('a.job_date as job_date ,a.job_start as job_start, a.job_end as job_end ,a.job as job,a.job_desc as job_desc,b.username as username,a.job_rolename as job_rolename'); 
        $this->db->from($this->newKinerjaTable.' a');
        $this->db->join('user b ','b.id = a.uid','inner');
        $this->db->where('a.uid = '.$uid);
        $this->db->where("a.job_date between '".$job_date_start."' and '".$job_date_end."'");
        $this->db->where("a.valid_status = 'valid'");
        $this->db->order_by('a.job_date');
        return $this->db->get();
    }

    public function postNewKinerja($data) {
        return $this->db->insert($this->newKinerjaTable,$data);
    }

    public function updateNewKinerja($data,$id) {
        return $this->db->update($this->newKinerjaTable,$data,$id);
    }

    public function getPJLPVerificatorsForPrint($uid){
        $this->db->select('b.nip as vfcNIP, b.jobTitle as vfcJobTitle, b.legalName as vfcName');
        $this->db->from('alkal_user_pjlp_verificator_lookup a');
        $this->db->join('alkal_user_verificator b','b.nip = a.nip','inner');
        $this->db->where('a.uid = '.$uid);
        $this->db->order_by('b.nip');
        return $this->db->get();
    }
}
