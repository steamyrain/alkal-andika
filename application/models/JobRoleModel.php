<?php

class JobRoleModel extends CI_Model{
    private $lookup_table = 'alkal_user_job_role_lookup';
    private $table='alkal_user_job_role';

    public function getJobRole($uid) {
        $this->db->select('job_roleid,role_name');
        $this->db->from($this->lookup_table);
        $this->db->join('alkal_user_job_role','alkal_user_job_role.id = '.$this->lookup_table.'.job_roleid');
        $this->db->where($this->lookup_table.'.uid = '.$uid);
        return $this->db->get();
    }

    public function getAllJobRole() {
        $this->db->select('id,role_name');
        $this->db->from($this->table);
        return $this->db->get();
    }

    public function getAllJobRoleExcept($ids){
      if(isset($ids)){
        $this->db->select('role_name');
        $this->db->from($this->table);
        foreach($ids as $id){
          $this->db->where('id !=',$id);
        }
        return $this->db->get();
      } else {
        return null;
      }
    }
}
