<?php
    class LKDTModel extends CI_Model {
        
        // table name
        private $table = 'alkal_lk_dt';

        // public method to show all the data from table
        public function getDataLaporanWithName() {
            $this->db->select(
                $this->table.'.id,'.
                $this->table.'.plate_number,'.
                $this->table.'.km_onStart,'.
                $this->table.'.km_onFinish,'.
                $this->table.'.km_total,'.
                $this->table.'.gasoline,'.
                $this->table.'.project_location,'.
                'user.username'
            );
            $this->db->from($this->table);
            $this->db->join('user','user.id = '
                .$this->table.'.userId'
            );
            return $this->db->get();
        }

        public function getOperatorsDataLaporan(int $uid) {
            $this->db->select(
                $this->table.'.created_at,'.
                $this->table.'.plate_number,'.
                $this->table.'.km_onStart,'.
                $this->table.'.km_onFinish,'.
                $this->table.'.km_total,'.
                $this->table.'.project_location'
            );
            $this->db->from($this->table);
            $this->db->where('userId',$uid);
            return $this->db->get();
        } 

        // public method to insert data to table
        public function setDataLaporan($data) {
           $this->db->insert($this->table,$data); 
        }
    }
?>