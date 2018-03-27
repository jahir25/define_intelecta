<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Settings_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function update($_data, $_id) {

        if (empty($_data))
            return FALSE;

        if (empty($_id))
            return FALSE;

        return $this->db->where('id', $_id)
                        ->update('settings', $_data);
    }

    public function get($_select = '*') {

        return $this->db->select($_select)
                        ->get('settings',1)->row();
    }

    public function get_by_id($_id) {

        if (empty($_id))
            return FALSE;

        return $this->db->where(
                                array(
                                    'id' => $_id
                                )
                        )
                        ->get('settings')->row();
    }

}
