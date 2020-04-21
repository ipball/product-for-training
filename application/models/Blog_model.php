<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Blog_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function data()
    {
        return array(
            'id' => null,
            'name' => null,
            'detail' => null,
            'author_id' => null,
            'created_at' => date('Y-m-d H:i:s')
        );
    }

    public function get_by_id($id)
    {
        $query = $this->db->where('id', $id)->from('blogs')->get();
        return $query->row_array();
    }

    public function get_all()
    {
        $query = $this->db->select('b.id, b.name AS blog_name, a.name AS author_name, b.created_at')
        ->from('blogs b')
        ->join('authors a', 'b.author_id=a.id', 'inner')
        ->get();

        return $query->result_array();
    }

    public function save($data)
    {
        $this->db->insert('blogs', $data);
    }

    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('blogs', $data);
    }

    public function delete($id)
    {
        $this->db->where('id', $id);        
        $this->db->delete('blogs');
    }
}