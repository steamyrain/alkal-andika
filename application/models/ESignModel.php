<?php

class ESignModel extends CI_Model{

    private $table = 'alkal_user_verificator';
    private $tableUser= 'user';
    private $tableSTReq = 'alkal_st_esign_req';
    private $tableEKReq = 'alkal_ekindr_esign_req';
    private $tableST= 'alkal_surat_tugas';

    public function getVerificator(){
        $this->db->select("nip,uId,legalName,jobTitle");
        $this->db->from($this->table);
        $this->db->order_by("legalName");
        return $this->db->get();
    }

    public function getSpecificVerificator($nip){
        $this->db->select("jobTitle,legalName");
        $this->db->from($this->table);
        $this->db->where('nip = '.$nip);
        return $this->db->get();
    }

    public function getSTReq(){
        $this->db->select($this->tableSTReq.'.*,'
                            .$this->tableUser.'.username as reqByName,'
                            .$this->tableST.'.date,'
                            .$this->tableST.'.location,'
                            .$this->tableST.'.job_desc'
                        );
        $this->db->from($this->tableSTReq);
        $this->db->join($this->tableUser,$this->tableSTReq.'.reqBy = '.$this->tableUser.'.id');
        $this->db->join($this->tableST,$this->tableST.'.id = '.$this->tableSTReq.'.stId');
        return $this->db->get();
    }

    public function setSTReq($data){
        $this->db->insert($this->tableSTReq,$data);
    }

    public function setEKReq($data){
        $this->db->insert($this->tableEKReq,$data);
    }

    public function getSTReqSpecific($nip){
        $this->db->select($this->tableSTReq.'.*,'
                            .$this->tableUser.'.username as reqByName,'
                            .$this->tableST.'.date,'
                            .$this->tableST.'.location,'
                            .$this->tableST.'.job_desc'
                        );
        $this->db->from($this->tableSTReq);
        $this->db->join($this->tableUser,$this->tableSTReq.'.reqBy = '.$this->tableUser.'.id');
        $this->db->join($this->tableST,$this->tableST.'.id = '.$this->tableSTReq.'.stId');
        $this->db->where($this->tableSTReq.'.reqTo = '.$nip);
        $this->db->where($this->tableSTReq.".status = 'pending'");
        return $this->db->get();
    }

    public function getSTReqReqBy($uId) {
        $this->db->select($this->tableSTReq.'.*,'
                            .$this->tableUser.'.username as reqByName,'
                            .$this->tableST.'.date,'
                            .$this->tableST.'.location,'
                            .$this->tableST.'.job_desc'
                        );
        $this->db->from($this->tableSTReq);
        $this->db->join($this->tableUser,$this->tableUser.'.id = '.$this->tableSTReq.'.reqBy');
        $this->db->join($this->tableST,$this->tableST.'.id = '.$this->tableSTReq.'.stId');
        $this->db->where($this->tableSTReq.'.reqBy = '.$uId);
        return $this->db->get();
    }

    public function updateSTReq($stId,$reqTo,$data){
        $this->db->set($data);
        $this->db->where('stId',$stId);
        $this->db->where('reqTo',$reqTo);
        $this->db->update($this->tableSTReq);
    }

    public function updateEKReq($uId,$start,$end,$data){
        $this->db->set($data);
        $this->db->where('uId',$uId);
        $this->db->where('ekin_start',$start);
        $this->db->where('ekin_end',$end);
        $this->db->update($this->tableEKReq);
    }

    public function getEKReqReqBy($uId) {
        $this->db->select($this->tableEKReq.'.*,'
                            .$this->tableUser.'.username as reqByName'
                        );
        $this->db->from($this->tableEKReq);
        $this->db->join($this->tableUser,$this->tableUser.'.id = '.$this->tableEKReq.'.reqBy');
        $this->db->where($this->tableEKReq.'.reqBy = '.$uId);
        return $this->db->get();
    }

    public function getEKReqToOp($uId) {
        $this->db->select($this->tableEKReq.'.*,'
                            .$this->tableUser.'.username as reqByName,'
                            .$this->tableUser.'.job_id'
                        );
        $this->db->from($this->tableEKReq);
        $this->db->join($this->tableUser,$this->tableUser.'.id = '.$this->tableEKReq.'.reqBy');
        $this->db->where($this->tableEKReq.'.uId = '.$uId);
        return $this->db->get();
    }

}
