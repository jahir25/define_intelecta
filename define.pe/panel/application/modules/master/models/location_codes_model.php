<?php



if (!defined('BASEPATH'))

    exit('No direct script access allowed');



class Location_codes_model extends CI_Model {



    function __construct() {

        parent::__construct();

    }


    public function get_departments() {

        return $this->db->get( 'departments' )->result();

    }

    public function get_department_by_id( $_id ) {

        if( !$_id )
            return FALSE;

        return $this->db->where( 'id', $_id )
                        ->get( 'departments' )->result();
    }

    public function get_provinces( $_id ) {

        if( !$_id )
            return FALSE;

        return $this->db->where( 'department_id', $_id )
                        ->get( 'provinces' )->result();
    }

    public function get_province_by_id( $_id ) {

        if( !$_id )
            return FALSE;

        return $this->db->where( 'id', $_id )
                        ->get( 'provinces' )->result();
    }

    public function get_districts( $_id ) {

        if( !$_id )
            return FALSE;

        return $this->db->where( 'province_id', $_id )
                        ->get( 'districts' )->result();
    }

    public function get_district_by_id( $_id ) {

        if( !$_id )
            return FALSE;

        return $this->db->where( 'id', $_id )
                        ->get( 'districts' )->result();
    }
 

    

}

