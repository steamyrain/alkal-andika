<?php
    class LKDTModel extends CI_Model {
        
        // table name
        private $table = 'alkal_lk_dt';

        // public method to show all the data from table
        public function getDataLaporanWithName() {
            $this->db->select(
                $this->table.'.id,'.
                $this->table.'.created_at,'.
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

        public function getDataLaporanSpecific($id) {
            $this->db->select(
                $this->table.'.userId,'.
                $this->table.'.created_at,'.
                $this->table.'.plate_number,'.
                $this->table.'.km_onStart,'.
                $this->table.'.km_onFinish,'.
                $this->table.'.km_total,'.
                $this->table.'.gasoline,'.
                $this->table.'.project_location'
            );
            $this->db->from($this->table);
            $this->db->where('id',$id);
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

        public function deleteLKDT($id) {
            $this->db->delete($this->table,array('id'=>$id));
        }

        public function editLKDT($data,$id) {
            $this->db->delete($this->table,$data,'id='.$id);
        }

        public function printAllFormat() {
            $this->db->select(
                $this->table.'.id,'.
                $this->table.'.created_at,'.
                $this->table.'.plate_number,'.
                $this->table.'.km_onStart,'.
                $this->table.'.km_onFinish,'.
                $this->table.'.km_total,'.
                $this->table.'.gasoline,'.
                $this->table.'.project_location,'.
                'user.username, alkal_category_dt.category'
            );
            $this->db->from($this->table);
            $this->db->join('user',$this->table.'.userId = user.id');
            $this->db->join('alkal_dump_truck',$this->table.'.plate_number = alkal_dump_truck.plate_number');
            $this->db->join('alkal_category_dt','alkal_dump_truck.catId= alkal_category_dt.id');
            return $this->db->get();
        }
    }
?>
