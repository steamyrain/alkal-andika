<?php 
class SuratTugasModel extends CI_Model {

    private $table='alkal_surat_tugas';
    private $tableSubject = 'alkal_st_subject';
    private $tableHeavy = 'alkal_st_heavy';
    private $tableDT = 'alkal_st_dt';

    public function insertSuratTugas($data) {
        $this->db->insert($this->table,$data);
        return $this->db->insert_id();
    }

    public function insertSTSubject($data) {
        $this->db->insert_batch($this->tableSubject,$data);
    }

    public function insertSTHeavy($data) {
        $this->db->insert_batch($this->tableHeavy,$data);
    }

    public function insertSTDT($data) {
        $this->db->insert_batch($this->tableDT,$data);
    }
}
