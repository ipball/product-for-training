<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Gallery_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function data()
    {
        return array(
            'id' => null,
            'ordering' => 0,
            'path_name' => null,
            'title_name' => null,
            'alt_name' => null,
            'blog_id' => 0
        );
    }

    public function get_by_id($id)
    {
        $query = $this->db->where('id', $id)->from('gallerys')->get();
        return $query->row_array();
    }

    public function get_by_blog($id)
    {
        $query = $this->db->select('*')
        ->from('gallerys')
        ->where('blog_id', $id)
        ->get();

        return $query->result_array();
    }

    public function save($data)
    {
        $this->db->insert('gallerys', $data);
    }

    public function delete($id)
    {
        $this->db->where('id', $id);        
        $this->db->delete('gallerys');
    }
}