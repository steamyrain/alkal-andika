<?php

class DumpTruckModel extends CI_Model {

    private $table="alkal_dump_truck";

    public function tampilTrukDanMerek() {
        $this->db->select($this->table.'.*,'.'alkal_brand.brand');
        $this->db->from($this->table);
        $this->db->join('alkal_brand','alkal_brand.id='.$this->table.'.brandId');
        return $this->db->get();
    }
    public function insertDT($data){
        $this->db->insert($this->table,$data);
    }
    public function getDTBrandCategory() {
        $this->db->select($this->table.'.*,'.'alkal_brand.brand, alkal_category_dt.category');
        $this->db->from($this->table);
        $this->db->join('alkal_brand','alkal_brand.id='.$this->table.'.brandId');
        $this->db->join('alkal_category_dt','alkal_category_dt.id='.$this->table.'.catId');
        return $this->db->get();
    }

    public function getDTBrandCategoryWhere($dtId) {
        $this->db->select($this->table.'.*,'.'alkal_brand.brand, alkal_category_dt.category');
        $this->db->from($this->table);
        $this->db->join('alkal_brand','alkal_brand.id='.$this->table.'.brandId');
        $this->db->join('alkal_category_dt','alkal_category_dt.id='.$this->table.'.catId');
        $this->db->where($this->table.'.id='.$dtId);
        return $this->db->get();
    }

    public function getDTPN() {
        $this->db->select('plate_number');
        return $this->db->get($this->table);
    }

    public function deleteDT($dtId){
        $this->db->delete($this->table,array('id'=>$dtId));
    }

    public function editDt($data,$id){
        $this->db->update($this->table,$data,'id='.$id);
    }

    public function getPNCategory(){
        $this->db->select($this->table.'.id, plate_number, category');
        $this->db->from($this->table);
        $this->db->join('alkal_category_dt','alkal_category_dt.id='.$this->table.'.catId');
        $this->db->order_by('catId','asc');
        $this->db->order_by('plate_number','asc');
        return $this->db->get();
    }
}
