<?php

class KdoModel extends CI_Model {

    private $table="alkal_kdo";

    public function getKdoBrandCategory() {
        $this->db->select($this->table.'.*, alkal_brand.brand, alkal_category_kdo.category');
        $this->db->from($this->table);
        $this->db->join('alkal_brand','alkal_brand.id='.$this->table.'.brandId');
        $this->db->join('alkal_category_kdo','alkal_category_kdo.id='.$this->table.'.catId','left');
        return $this->db->get();
    }

    public function getKdoBrandCategoryWhere($id) {
        $this->db->select($this->table.'.*,'.'alkal_brand.brand, alkal_category_kdo.category');
        $this->db->from($this->table);
        $this->db->join('alkal_brand','alkal_brand.id='.$this->table.'.brandId');
        $this->db->join('alkal_category_kdo','alkal_category_kdo.id='.$this->table.'.catId','left');
        $this->db->where($this->table.'.id='.$id);
        return $this->db->get();
    }

    public function getKdoPN() {
        $this->db->select('plate_number');
        return $this->db->get($this->table);
    }

    public function insertKdo($data){
        $this->db->insert($this->table,$data);
    }

    public function deleteKdo($id){
        $this->db->delete($this->table,array('id'=>$id));
    }

    public function editKdo($data,$id){
        $this->db->update($this->table,$data,'id='.$id);
    }

    public function getPNCategory(){
        $this->db->select($this->table.'.id, plate_number, category,type');
        $this->db->from($this->table);
        $this->db->join('alkal_category_kdo','alkal_category_kdo.id='.$this->table.'.catId');
        $this->db->order_by('catId','asc');
        $this->db->order_by('plate_number','asc');
        return $this->db->get();
    }
}
