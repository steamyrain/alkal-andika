<?php 
class SuratTugasModel extends CI_Model {
    private $table='alkal_surat_tugas';
    public function insertSuratTugas($data) {
        $this->db->insert($this->table,$data);
    }
}
