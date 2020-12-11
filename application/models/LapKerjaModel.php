<?php
    class LapKerjaModel extends CI_Model {
        
        // table name
        private $table = 'alkal_laporan_kerja';

        // public method to show all the data from table
        public function getDataLaporanWithName() {
            $this->db->select(
                $this->table.'.id,'.
                $this->table.'.created_at,'.
                $this->table.'.plate_number,'.
                $this->table.'.serial_number,'.
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
                $this->table.'.id,'.
                $this->table.'.created_at,'.
                $this->table.'.plate_number,'.
                $this->table.'.serial_number,'.
                $this->table.'.km_onStart,'.
                $this->table.'.km_onFinish,'.
                $this->table.'.km_total,'.
                $this->table.'.gasoline,'.
                $this->table.'.project_location,'.
                $this->table.'.userId,'.
                'user.username'
            );
            $this->db->from($this->table);
            $this->db->where($this->table.'.id',$id);
            $this->db->join('user','user.id = '
                .$this->table.'.userId'
            );
            return $this->db->get();
        }

        public function getOperatorsDataLaporan(int $uid) {
            $this->db->select(
                $this->table.'.created_at,'.
                $this->table.'.plate_number,'.
                $this->table.'.serial_number,'.
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
        
        public function editLaporan($data,$id) {
           $this->db->update($this->table,$data,'id='.$id); 
        }

        public function deleteLaporan($id) {
           $this->db->delete($this->table,array('id'=>$id)); 
        }

        public function printAllFormat() {
            $this->db->select(
                $this->table.'.created_at,'.
                $this->table.'.plate_number,'.
                $this->table.'.serial_number,'.
                $this->table.'.km_onStart,'.
                $this->table.'.km_onFinish,'.
                $this->table.'.km_total,'.
                $this->table.'.gasoline,'.
                $this->table.'.project_location,'.
                $this->table.'.userId,'.
                'user.username, alkal_alat_berat.sub_category, alkal_category_alat_berat.category'
            );
            $this->db->from($this->table);
            $this->db->join('user',$this->table.'.userId = user.id');
            $this->db->join('alkal_alat_berat',$this->table.'.serial_number = alkal_alat_berat.serial_number or '.$this->table.'.plate_number = alkal_alat_berat.plate_number');
            $this->db->join('alkal_category_alat_berat','alkal_category_alat_berat.id = alkal_alat_berat.catId');
            return $this->db->get();
        }
    }
?>
