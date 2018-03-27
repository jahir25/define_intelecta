<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Auth_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function get_user_by_username($_username) {

        if (empty($_username))
            return FALSE;

        return $this->db->where(array('username' => $_username,'state !='=>99))
                        ->limit(1)
                        ->get('users')->row();
    }

    public function update($_data, $_id) {

        if (empty($_data))
            return FALSE;

        if (empty($_id))
            return FALSE;

        return $this->db->where('id', $_id)
                        ->update('users', $_data);
    }

    public function get_by_id($_id) {

        if (empty($_id))
            return FALSE;

        return $this->db->where(
                            array(
                                'id' => $_id
                                )
                            )
                        ->get('users')->row();
    }


     public function get_user_groups_by_id($_id) {

        if (!is_numeric($_id))
            return FALSE;

        return $this->db->where(
                                array(
                                    
                                    'id' => $_id,
                                    'state !='=>99
                                )
                        )
                        ->get('user_groups')->row();
    }












    

}
