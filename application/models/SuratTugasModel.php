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
    
    public function getSuratTugas(){
        return $this->db->get($this->table);
    }

    public function getSpecificSuratTugasSubject($id){
        $this->db->select(
            $this->table.'
                .*, 
                user.username,
            '
        );
        $this->db->from($this->table);
        $this->db->join($this->tableSubject,$this->tableSubject.'.surat_id='.$this->table.'.id');
        $this->db->join('user','user.id='.$this->tableSubject.'.subject_id');
        $this->db->where($this->table.'.id='.$id);
        return $this->db->get();
    }

    public function getSpecificSuratTugasHeavy($id){
        $this->db->select('
                alkal_category_alat_berat.category,
                alkal_alat_berat.sub_category,
                alkal_alat_berat.type,
                alkal_alat_berat.plate_number,
                alkal_alat_berat.serial_number
            '
        );
        $this->db->from($this->table);
        $this->db->join($this->tableHeavy,$this->tableHeavy.'.surat_id='.$this->table.'.id');
        $this->db->join('alkal_alat_berat','alkal_alat_berat.id='.$this->tableHeavy.'.heavy_id');
        $this->db->join('alkal_category_alat_berat','alkal_alat_berat.catId=alkal_category_alat_berat.id');
        $this->db->where($this->table.'.id='.$id);
        return $this->db->get();
    }

    public function getAllSTOperator($id){
        $this->db->select(
            '
                user.id,
            '
            .$this->tableSubject.'.id as stOpId'
        );
        $this->db->from($this->table);
        $this->db->join($this->tableSubject,$this->tableSubject.'.surat_id='.$this->table.'.id');
        $this->db->join('user','user.id='.$this->tableSubject.'.subject_id');
        $this->db->where($this->table.'.id='.$id.' AND user.job_id=1');
        return $this->db->get();
    }
    
    public function getAllSTDriver($id){
        $this->db->select(
            ' 
                user.id,
            '
            .$this->tableSubject.'.id as stDrId'
        );
        $this->db->from($this->table);
        $this->db->join($this->tableSubject,$this->tableSubject.'.surat_id='.$this->table.'.id');
        $this->db->join('user','user.id='.$this->tableSubject.'.subject_id');
        $this->db->where($this->table.'.id='.$id.' AND user.job_id=2');
        return $this->db->get();
    }

    public function getAllSTLabour($id){
        $this->db->select(
            ' 
                user.id,
            '
            .$this->tableSubject.'.id as stLaId'
        );
        $this->db->from($this->table);
        $this->db->join($this->tableSubject,$this->tableSubject.'.surat_id='.$this->table.'.id');
        $this->db->join('user','user.id='.$this->tableSubject.'.subject_id');
        $this->db->where($this->table.'.id='.$id.' AND user.job_id=4');
        return $this->db->get();
    }

    public function getAllSTHeavy($id){
        $this->db->select(
            $this->tableHeavy.'.id as stHeId,'
            .$this->tableHeavy.'.heavy_id,'
            .$this->tableHeavy.'.heavy_fuel'
        );
        $this->db->from($this->table);
        $this->db->join($this->tableHeavy,$this->tableHeavy.'.surat_id='.$this->table.'.id');
        $this->db->where($this->table.'.id='.$id);
        return $this->db->get();
    }

    public function getAllSTDT($id){
        $this->db->select(
            $this->tableDT.'.id as stDTId,'
            .$this->tableDT.'.dt_id,'
            .$this->tableDT.'.dt_fuel'
        );
        $this->db->from($this->table);
        $this->db->join($this->tableDT,$this->tableDT.'.surat_id='.$this->table.'.id');
        $this->db->where($this->table.'.id='.$id);
        return $this->db->get();
    }

}
