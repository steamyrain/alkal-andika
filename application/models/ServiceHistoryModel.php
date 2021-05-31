<?php
class ServiceHistoryModel extends CI_Model {

    public function getDTServiceHistories($nopol=true,$dt_id,$service_id){
        if((($nopol) && isset($dt_id)) && isset($service_id)){
            $this->db->select('b.plate_number as plate_number,a.dt_id as dt_id,a.service_id as service_id,a.service_desc as service_desc,c.service_name as service_name,a.service_date as service_date,d.subservice_name as subservice_name,a.unit_price as unit_price,a.unit_total as unit_total,a.id as dt_service_history_id,a.subservice_id as subservice_id');
            $this->db->from('alkal_service_history_dt a');
            $this->db->join('alkal_dump_truck b','b.id = a.dt_id');
            $this->db->join('alkal_service_list_dt c','a.service_id = c.id');
            $this->db->join('alkal_service_sublist_dt d','d.id = a.subservice_id');
            $this->db->where('a.dt_id',$dt_id);
            $this->db->where('a.service_id',$service_id);
            return $this->db->get();
        }
        else if((!$nopol && !isset($dt_id)) && !isset($service_id)){
            return $this->db->get('alkal_service_history_dt');
        }
    }

    public function getDTServiceList($id){
        if (isset($id)){
            $this->db->select('a.id as id, a.service_name as service_name, b.id as subservice_id, b.subservice_name as subservice_name,b.unit as unit');
            $this->db->from('alkal_service_list_dt a');
            $this->db->join('alkal_service_sublist_dt b','b.service_id = a.id');
            $this->db->join('alkal_service_dt_lookup c','c.service_id = a.id');
            $this->db->join('alkal_category_dt_service_lookup d','d.category_service_id = c.category_service_id');
            $this->db->join('alkal_dump_truck e','e.catId = d.category_id');
            $this->db->where('e.id = '.$id);
            return $this->db->get();
        } else {
            $this->db->select('a.id as id, a.service_name as service_name');
            $this->db->from('alkal_service_list_dt a');
            return $this->db->get();
        }
    }

    public function getDTServiceListSel($id){
        if (isset($id)){
            $this->db->select('alkal_dump_truck.id as dt_id, alkal_service_list_dt.id as service_id, alkal_service_list_dt.service_name as service_name');
            $this->db->from('alkal_dump_truck');
            $this->db->join('alkal_category_dt_service_lookup','alkal_category_dt_service_lookup.category_id = alkal_dump_truck.catId');
            $this->db->join('alkal_service_dt_lookup','alkal_service_dt_lookup.category_service_id = alkal_category_dt_service_lookup.category_service_id');
            $this->db->join('alkal_service_list_dt','alkal_service_list_dt.id = alkal_service_dt_lookup.service_id');
            $this->db->where('alkal_dump_truck.id = '.$id);
            return $this->db->get();
        }
    }

    public function setDTServiceHistory($data) {
        $validData = [];
        foreach($data as $dat){
            if(!empty($dat)){
                array_push($validData,$dat);
            }
        }
        if(count($validData)>0){
            $this->db->insert_batch('alkal_service_history_dt',$validData);
        }
    }

    public function getDTServiceHistoryRekap($data){
        $this->db->select('a.plate_number plate_number,e.service_name service_name,d.service_date service_date,f.subservice_name as service_unit,d.unit_total as unit_total');
        $this->db->from('alkal_dump_truck a');
        $this->db->join('alkal_category_dt_service_lookup b','b.category_id = a.catId');
        $this->db->join('alkal_service_dt_lookup c','c.category_service_id = b.category_service_id');
        $this->db->join('alkal_service_history_dt d','d.service_id = c.service_id','left'); 
        $this->db->join('alkal_service_list_dt e','e.id = c.service_id'); 
        $this->db->join('alkal_service_sublist_dt f','f.id = d.subservice_id'); 
        $this->db->where('a.id = '.$data['dt_id']);
        $this->db->where("year(d.service_date) between '".$data['rekap_start']."' and '".$data['rekap_end']."'");
        $this->db->order_by("e.service_name,d.service_date desc");
        return $this->db->get();
    }
}
