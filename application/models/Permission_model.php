<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Permission_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function data()
    {
        return array(
            'menu_name' => null,
            'author_id' => null,
            'visible' => 0,
            'is_read' => 0,
            'is_create' => 0,
            'is_update' => 0,
            'is_delete' => 0
        );
    }

    public function save($data)
    {
        $this->db->insert('permissions', $data);
    }

    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('permissions', $data);
    }

    public function update_by_author($data)
    {
        $this->db->where('author_id', $data['author_id'])->where('menu_name', $data['menu_name']);
        $this->db->update('permissions', $data);
    }

    public function delete_by_author($id)
    {
        $this->db->where('author_id', $id);
        $this->db->delete('permissions');
    }

    public function get_by_author($id)
    {
        $query = $this->db->from('permissions')->where('author_id', $id)->get();
        return $query->result_array();
    }
    
}
