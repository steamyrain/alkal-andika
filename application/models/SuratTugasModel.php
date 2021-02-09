<?php 
class SuratTugasModel extends CI_Model {

    private $table='alkal_surat_tugas';
    private $tableSubject = 'alkal_st_subject';
    private $tableHeavy = 'alkal_st_heavy';
    private $tableDT = 'alkal_st_dt';
    private $tableKDO = 'alkal_st_kdo';

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

    public function insertSTKDO($data) {
        $this->db->insert_batch($this->tableKDO,$data);
    }
    
    public function getSuratTugas(){
        return $this->db->get($this->table);
    }

    public function getSpecificSuratTugasOperator($id){
        $this->db->select(
            '
                user.username,
            '
        );
        $this->db->from($this->tableSubject);
        $this->db->join('user','user.id='.$this->tableSubject.'.subject_id');
        $this->db->where($this->tableSubject.'.surat_id='.$id);
        $this->db->where('user.job_id=1');
        $this->db->order_by('user.username');
        return $this->db->get();
    }

    public function getSpecificSuratTugasDriver($id){
        $this->db->select(
            '
                user.username,
            '
        );
        $this->db->from($this->tableSubject);
        $this->db->join('user','user.id='.$this->tableSubject.'.subject_id');
        $this->db->where($this->tableSubject.'.surat_id='.$id);
        $this->db->where('user.job_id=2');
        $this->db->order_by('user.username');
        return $this->db->get();
    }

    public function getSpecificSuratTugasDriverPlusMechanic($id){
        $this->db->select(
            '
                user.username,
            '
        );
        $this->db->from($this->tableSubject);
        $this->db->join('user','user.id='.$this->tableSubject.'.subject_id and '.$this->tableSubject.'.surat_id='.$id);
        $this->db->where('user.job_id=2 or user.job_id=3');
        $this->db->order_by('user.username');
        return $this->db->get();
    }

    public function getSpecificSuratTugasLabour($id){
        $this->db->select(
            '
                user.username,
            '
        );
        $this->db->from($this->tableSubject);
        $this->db->join('user','user.id='.$this->tableSubject.'.subject_id');
        $this->db->where($this->tableSubject.'.surat_id='.$id);
        $this->db->where('user.job_id=4');
        $this->db->order_by('user.username');
        return $this->db->get();
    }

    public function getSpecificSuratTugas($id){
        $this->db->select(
            $this->table.'
                .* 
            '
        );
        $this->db->from($this->table);
        $this->db->where($this->table.'.id='.$id);
        return $this->db->get();
    }

    public function getSpecificSuratTugasHeavy($id){
        $this->db->select('
                alkal_category_alat_berat.category,
                alkal_alat_berat.sub_category,
                alkal_alat_berat.type,
                alkal_alat_berat.plate_number,
                alkal_alat_berat.serial_number,
                alkal_st_heavy.heavy_fuel
            '
        );
        $this->db->from($this->table);
        $this->db->join($this->tableHeavy,$this->tableHeavy.'.surat_id='.$this->table.'.id');
        $this->db->join('alkal_alat_berat','alkal_alat_berat.id='.$this->tableHeavy.'.heavy_id');
        $this->db->join('alkal_category_alat_berat','alkal_alat_berat.catId=alkal_category_alat_berat.id');
        $this->db->where($this->table.'.id='.$id);
        return $this->db->get();
    }

    public function getSpecificSuratTugasDT($id){
        $this->db->select('
                alkal_category_dt.category,
                alkal_dump_truck.type,
                alkal_dump_truck.plate_number,
                alkal_st_dt.dt_fuel
            '
        );
        $this->db->from($this->table);
        $this->db->join($this->tableDT,$this->tableDT.'.surat_id='.$this->table.'.id');
        $this->db->join('alkal_dump_truck','alkal_dump_truck.id='.$this->tableDT.'.dt_id');
        $this->db->join('alkal_category_dt','alkal_dump_truck.catId=alkal_category_dt.id');
        $this->db->where($this->table.'.id='.$id);
        return $this->db->get();
    }
    
    public function getSpecificSuratTugasKDO($id){
        $this->db->select('
                alkal_category_kdo.category,
                alkal_kdo.type,
                alkal_kdo.plate_number,
                alkal_st_kdo.kdo_fuel
            '
        );
        $this->db->from($this->table);
        $this->db->join($this->tableKDO,$this->tableKDO.'.surat_id='.$this->table.'.id');
        $this->db->join('alkal_kdo','alkal_kdo.id='.$this->tableKDO.'.kdo_id');
        $this->db->join('alkal_category_kdo','alkal_kdo.catId=alkal_category_kdo.id','left');
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

    public function getAllSTDriverPlusMechanic($id){
        $this->db->select(
            ' 
                user.id,
            '
            .$this->tableSubject.'.id as stDrId'
        );
        $this->db->from($this->table);
        $this->db->join($this->tableSubject,$this->tableSubject.'.surat_id='.$this->table.'.id');
        $this->db->join('user','user.id='.$this->tableSubject.'.subject_id');
        $this->db->where($this->table.'.id='.$id.' AND user.job_id=2 OR user.job_id=3');
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

    public function getAllSTKDO($id){
        $this->db->select(
            $this->tableKDO.'.id as stKDOId,'
            .$this->tableKDO.'.kdo_id,'
            .$this->tableKDO.'.kdo_fuel'
        );
        $this->db->from($this->table);
        $this->db->join($this->tableKDO,$this->tableKDO.'.surat_id='.$this->table.'.id');
        $this->db->where($this->table.'.id='.$id);
        return $this->db->get();
    }

    public function updateSTSubject($id,$data){
        $this->db->set('subject_id',$data);
        $this->db->where('id',$id);
        $this->db->update($this->tableSubject);
    }

    public function deleteSTSubject($id){
        $this->db->where('id',$id);
        $this->db->delete($this->tableSubject);
    }

    public function updateSTHeavy($id,$data){
        $this->db->where('id',$id);
        $this->db->update($this->tableHeavy,$data);
    }

    public function deleteSTHeavy($id){
        $this->db->where('id',$id);
        $this->db->delete($this->tableHeavy);
    }

    public function updateSTDT($id,$data){
        $this->db->where('id',$id);
        $this->db->update($this->tableDT,$data);
    }

    public function deleteSTDT($id){
        $this->db->where('id',$id);
        $this->db->delete($this->tableDT);
    }

    public function updateSTKDO($id,$data){
        $this->db->where('id',$id);
        $this->db->update($this->tableKDO,$data);
    }

    public function deleteSTKDO($id){
        $this->db->where('id',$id);
        $this->db->delete($this->tableKDO);
    }

    public function getSpecificSTDetail($id){
        $this->db->select('location,date,job_desc');
        $this->db->limit(1);
        return $this->db->get_where($this->table,array('id'=>$id));
    }

    public function updateST($id,$data){
        $this->db->where('id',$id);
        $this->db->update($this->table,$data);
    }

    public function deleteST($id){
        $this->db->where('id',$id);
        $this->db->delete($this->table);
    }
}
