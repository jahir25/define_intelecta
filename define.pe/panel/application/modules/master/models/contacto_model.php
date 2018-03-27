<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contacto_model extends CI_Model {


	var $order = array('id' => 'desc');
    private  $table = 'contactos';

    function __construct() {
        parent::__construct();
    }

    

    private function searchDateWhere($item, $_like, $_params,$_col ='add_date')
    {

             if(!empty($_params['date_ini']) && !empty($_params['date_end'])) {

                $_date_ini = $_params['date_ini'];
                $_date_end = $_params['date_end'];
               
                 $this->db->where("(
                    $item LIKE '%$_like%' 
                    AND ($_col >= '$_date_ini' AND $_col <= '$_date_end'  )
                )");

            }else{
               $this->db->where("(
                 $item LIKE '%$_like%' 

                )"); 
            }
 
    }

    private function searchDateOrWhere($item, $_like, $_params, $_col ='add_date')
    {

            if(!empty($_params['date_ini']) && !empty($_params['date_end'])) {

                    $_date_ini = $_params['date_ini'];
                    $_date_end = $_params['date_end'];
                   
                     $this->db->or_where("(
                        $item LIKE '%$_like%' 
                        AND ($_col >= '$_date_ini' AND $_col <= '$_date_end'  )

                    )");

                    }else{
                        $this->db->or_where("(
                                $item LIKE '%$_like%' 
                        )");

 
            }


           
         
    }



    private function _get_datatables_query($_params,$column_order,$column_search,$_col='add_date')
    {


        $this->db->from($this->table);
        $i = 0;
        foreach ($column_search as $item) 
        {
            if($_params['search']['value'])  
            {
                $_like = $_params['search']['value'];
                if($i===0)  
                    $this->searchDateWhere($item, $_like, $_params,$_col);
                else
                    $this->searchDateOrWhere($item, $_like, $_params,$_col);
            }

            $i++;
        }
             

        if(isset($_params['order']))  
        {
            $this->db->order_by($column_order[$_params['order']['0']['column']], $_params['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }

         
    }

    function get_datatables($_params,$column_order,$column_search,$_col='add_date')
    {
        $this->table = $this->table;

        $this->_get_datatables_query($_params,$column_order,$column_search,$_col);
        if($_params['length'] != -1){
            $this->db->limit($_params['length'], $_params['start']);
        }


        if(!empty($_params['date_ini']) && !empty($_params['date_end'])) {
           
            $this->db->where("$_col >=", $_params['date_ini']);
            $this->db->where("$_col <=", $_params['date_end']);

        }

    
       

        return  $this->db->get()->result();
    }

    function count_filtered($_params,$column_order,$column_search,$_col='add_date')
    {
        $this->_get_datatables_query($_params,$column_order,$column_search,$_col);
        $query = $this->db->get();
        
        return $query->num_rows();
    }

    public function count_all()
    {
        
        $this->db->from($this->table);
       
        return $this->db->count_all_results();
    }
    


    public function get_by_id($_id) {

        if (empty($_id))
            return FALSE;

        return $this->db->where(
                                array(
                                    'state !=' => 99,
                                    'id' => $_id
                                )
                        )
                        ->get($this->table)->row();
    }

    public function add($_data) {

        if (empty($_data))
            return FALSE;

        return $this->db->insert($this->table, $_data);
    }

}
