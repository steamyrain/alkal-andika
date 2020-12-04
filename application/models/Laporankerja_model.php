<?php
    class Laporankerja_model extends CI_Model {
        // table name
        private $table = 'laporan_kerja';

        // public method to show all the data from table
        public function getDataLaporan() {
            return $this->db->get($this->table);
        }

        // public method to insert data to table
        public function setDataLaporan($data) {
           $this->db->insert($this->table,$data); 
        }
    }
?>
