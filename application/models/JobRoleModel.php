<?php

class JobRoleModel extends CI_Model{
    private $table = 'alkal_user_job_role_lookup';

    public function getJobRole($uid) {
        $this->db->select('job_roleid,role_name');
        $this->db->from($this->table);
        $this->db->join('alkal_user_job_role','alkal_user_job_role.id = '.$this->table.'.job_roleid');
        $this->db->where($this->table.'.uid = '.$uid);
        return $this->db->get();
    }

    public function getAllJobRole() {
        $this->db->select('id,role_name');
        $this->db->from('alkal_user_job_role');
        return $this->db->get();
    }
}
