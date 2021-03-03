<?php

class ESignModel extends CI_Model{

    private $table = 'alkal_user_verificator';
    private $tableUser= 'user';
    private $tableSTReq = 'alkal_st_esign_req';
    private $tableEKReq = 'alkal_ekin_esign_req';
    private $tableST= 'alkal_surat_tugas';
    private $tableEKVfcLookup = 'alkal_ek_vfc_lookup';

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
                            .$this->tableUser.'.username as reqByName,'
                            .$this->tableEKVfcLookup.'.reqToName as vfcName,'
                            .$this->tableEKVfcLookup.'.signedDate as vfcSignedDate,'
                            .$this->tableEKVfcLookup.'.status as vfcStatus'
                        );
        $this->db->from($this->tableEKReq);
        $this->db->join($this->tableEKVfcLookup,
            $this->tableEKVfcLookup.'.uId = '.$this->tableEKReq.'.uId and '.
            $this->tableEKVfcLookup.'.ekin_start = '.$this->tableEKReq.'.ekin_start and '.
            $this->tableEKVfcLookup.'.ekin_end = '.$this->tableEKReq.'.ekin_end',
            'left'
        );
        $this->db->join($this->tableUser,$this->tableUser.'.id = '.$this->tableEKReq.'.reqBy');
        $this->db->where($this->tableEKReq.'.reqBy = '.$uId);
        $this->db->order_by($this->tableEKReq.'.uId');
        $this->db->order_by($this->tableEKReq.'.ekin_start');
        $this->db->order_by($this->tableEKReq.'.ekin_end');
        return $this->db->get();
    }

    public function getEKReqToOp($uId) {
        $this->db->select($this->tableEKReq.'.*,'
                            .$this->tableUser.'.username as reqByName,'
                            .$this->tableUser.'.job_id'
                        );
        $this->db->from($this->tableEKReq);
        $this->db->join($this->tableUser,$this->tableUser.'.id = '.$this->tableEKReq.'.uId');
        $this->db->where($this->tableEKReq.'.uId = '.$uId);
        return $this->db->get();
    }

    public function setBatchEKVfcLookup($data){
        $this->db->insert_batch($this->tableEKVfcLookup,$data);
    }

    public function getEKReqSpecific($nip){
        $this->db->select($this->tableEKReq.'.*,'
                            .$this->tableUser.'.username as reqByName,'
                            .$this->tableEKVfcLookup.'.reqTo as vfcNIP,'
                            .$this->tableEKVfcLookup.'.status as vfcStatus'
                        );
        $this->db->from($this->tableEKReq);
        $this->db->join($this->tableEKVfcLookup,
            $this->tableEKVfcLookup.'.uId = '.$this->tableEKReq.'.uId and '.
            $this->tableEKVfcLookup.'.ekin_start = '.$this->tableEKReq.'.ekin_start and '.
            $this->tableEKVfcLookup.'.ekin_end = '.$this->tableEKReq.'.ekin_end',
            'left'
        );
        $this->db->join($this->tableUser,$this->tableUser.'.id = '.$this->tableEKReq.'.reqBy');
        $this->db->where($this->tableEKVfcLookup.'.reqTo = '.$nip);
        $this->db->where($this->tableEKVfcLookup.".status = 'pending'");
        $this->db->order_by($this->tableEKReq.'.uId');
        $this->db->order_by($this->tableEKReq.'.ekin_start');
        $this->db->order_by($this->tableEKReq.'.ekin_end');
        return $this->db->get();
    }

    public function getEKReqVfc($uId,$dateStart,$dateEnd){
        $this->db->select(
                            $this->tableEKVfcLookup.'.reqTo as vfcNIP,'
                            .$this->tableEKVfcLookup.'.reqToName as vfcName,'
                            .$this->tableEKVfcLookup.'.status as vfcStatus,'
                            .$this->tableEKVfcLookup.'.jobTitle as vfcJobTitle'
                        );
        $this->db->from($this->tableEKVfcLookup);
        $this->db->where($this->tableEKVfcLookup.'.uId = '.$uId);
        $this->db->where($this->tableEKVfcLookup.'.ekin_start = "'.$dateStart.'"');
        $this->db->where($this->tableEKVfcLookup.'.ekin_end = "'.$dateEnd.'"');
        return $this->db->get();
    }

    public function updateEKReqSpecific($uId,$start,$end,$nip,$data){
        $this->db->set($data);
        $this->db->where('uId',$uId);
        $this->db->where('reqTo',$nip);
        $this->db->where('ekin_start',$start);
        $this->db->where('ekin_end',$end);
        $this->db->update($this->tableEKVfcLookup);
    }
}
