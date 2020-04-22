<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Menu_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function data()
    {
        return array(
            'name' => null,
            'description' => null
        );
    }

    public function get_all()
    {
        $query = $this->db->from('menus')->get();
        return $query->result_array();
    }
}
