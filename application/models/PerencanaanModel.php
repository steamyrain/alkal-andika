<?php 


class PerencanaanModel extends CI_Model{
    var $column_order = array(null, 'lokasi','kendaraan','serial','operator'); //set column field database for datatable orderable
    var $column_search = array('lokasi','kendaraan','serial','operator'); //set column field database for datatable searchable 
    var $order = array('id_pr' => 'asc'); 

    public function get_data($table){
		return $this->db->get($table);
	}

	public function get_data_new($in){

         $this->db->where('tanggal', $in);
		return $this->db->get('alkal_perencanaan');
	}
  


    public function joinTgl(){
        $this->db->select("*");
        $this->db->from("perencanaan_tgl");
        $this->db->join('alkal_perencanaan','alkal_perencanaan.id_tgl = perencanaan_tgl.id_tgl');
        return $this->db->get();

      
    }
   
    function getUsers($in){

        // Fetch users
        $this->db->select('*');
        if($in != null){
             $this->db->where("username like '%".$in."%' ");
        }
     $fetched_records = $this->db->get('user');
     $users = $fetched_records->result_array();

   
        // Initialize Array with fetched data
        $data = array();
        foreach($users as $user){
           $data[] = array("id"=>$user['username'], "text"=>$user['username']);
        }
        return $data;
     }

	public function getOperatorOnly(){
        $this->db->select("id,username");
        $this->db->from("user");
        $this->db->where("user.job_id=1 or user.job_id=2");
        $this->db->order_by("username");
        return $this->db->get();
    }

    private function _get_datatables_query()
    {
         
        $this->db->from('alkal_perencanaan');
 
        $i = 0;
     
        foreach ($this->column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from('alkal_perencanaan');
        return $this->db->count_all_results();
    }



     public function getAlat() {
        $this->db->select('alkal_alat_berat.id as id,plate_number,serial_number,category,sub_category,type');
        $this->db->from("alkal_alat_berat");
        $this->db->join('alkal_category_alat_berat','alkal_category_alat_berat.id = .alkal_alat_berat.catId');
        $this->db->order_by('category','asc');
        $this->db->order_by('type','asc');
        return $this->db->get();
    }
   

    public function insert_data($data,$table){
		$this->db->insert($table,$data);
	}

	public function update_data($table,$data,$where){
		$this->db->update($table, $data, $where);
	}

    public function delete_data($where,$table){
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function getFilterByTanggal(){
        $this->db->query('SELECT * FROM alkal_perencanaan ORDER BY tanggal ASC');
        return $this->db->get();
    }

    public function get_periode($from_date) //, $to_date
    {
        $this->db->select('*');
        $this->db->from('alkal_perencanaan');
        $this->db->where('tanggal ', $from_date);
        // $this->db->where('tanggal <=', $to_date);
        $this->db->order_by('lokasi', 'asc');
    
        $query = $this->db->get();
        
        if ($query->num_rows() > 0 ) {
            return $query->result();
        }else{
            return null;
        }
    }
    
      public function getdatacetak($tanggal)
        {

 
        $this->db->select('*');
        $this->db->from('alkal_perencanaan');
        $this->db->where('tanggal', $tanggal);
        // $this->db->where('tanggal <=', $to_date);
        $this->db->order_by('lokasi', 'asc');
    
        $query = $this->db->get();
        
        if ($query->num_rows() > 0 ) {
            return $query->result();
        }else{
            return null;
        }
        
    }
    
     public   function update($table = null, $data = null, $where = null)
    {
        $this->db->update($table, $data, $where);
    }
   


}

?>