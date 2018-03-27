<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function add($_data) {

        if (empty($_data))
            return FALSE;

        return $this->db->insert('users', $_data);
    }

    public function update($_data, $_id) {

        if (empty($_data))
            return FALSE;

        if (empty($_id))
            return FALSE;

        return $this->db->where('id', $_id)
                        ->update('users', $_data);
    }

    public function get() {

        return $this->db->where('state !=', 99)
                        ->get('users')->result();
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
                        ->get('users')->row();
    }

    public function get_user_groups() {

        return $this->db->where(
                                array(
                                    'state !=' => 99
                                    
                                )
                        )
                        ->get('user_groups')->result();
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


      public function get_registered_user_id_by_group($_username,$_user_group_id) {
        if (empty($_username)) 
            return false;
            
        if (!is_numeric($_user_group_id)) 
            return false;
        


        return $this->db->where(
                                array(
                                    'state !=' => 99,
                                    'username' => $_username,
                                    'user_group_id' => $_user_group_id
                                )
                        )
                        ->get('users')->row();
    }



    public function get_registered_user_admin() {



        return $this->db->where(
                                array(
                                    'state !=' => 99,
                                    'user_group_id' => 1
                                )
                        )
                        ->get('users')->row();
    }

    public function get_by_dni($_dni) {

        if (empty($_dni))
            return FALSE;

        return $this->db->where(
                                array(
                                    'state !=' => 99,
                                    'dni' => $_dni
                                )
                        )
                        ->get('users')->row();
    }
public function get_by_username($_username) {

        if (empty($_username))
            return FALSE;

        return $this->db->where(
                                array(
                                    'state !=' => 99,
                                    'username' => $_username
                                )
                        )
                        ->get('users')->row();
    }
    public function get_count($_like = '') {

        if ($_like !== '' && $_like !== '_woval') {
            $this->db->where("(
                    u.name LIKE '%$_like%' OR
                    lastname LIKE '%$_like%' OR
                    dni LIKE '%$_like%'
            )");
        }
        return $this->db->select('count(u.id) as count')
                         ->join('user_groups ug', 'ug.id = u.user_group_id')
                        ->where('u.state !=', 99)
                        ->get('users u')->row();
    }

    public function get_pagination($_limit = 10, $_offset = 0, $_select = '', $_like = '') {
        
        if ($_select !== '' && $_like !== '_woval')
            $this->db->select($_select);

        if ($_like !== '' && $_like !== '_woval') {
            $this->db->where("(
                    u.name LIKE '%$_like%' OR
                    lastname LIKE '%$_like%' OR
                    dni LIKE '%$_like%'
            )");



        }

        $this->db->select($_select);

        return $this->db
                        ->join('user_groups ug', 'ug.id = u.user_group_id')
                        ->where('u.state !=', 99)
                        ->limit($_limit, $_offset)
                        ->order_by('u.id', 'desc')
                        ->get('users u')->result();
    }

}
 