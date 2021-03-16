<?php

class JobListModel extends CI_Model{
    private $table = 'alkal_user_joblist';

    public function getJobList($roleid) {
        $this->db->select('id,job');
        $this->db->from($this->table);
        $this->db->where($this->table.'.role_id = '.$roleid);
        return $this->db->get();
    }
}
