<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Author_model extends CI_Model
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
            'username' => null,
            'password' => null,
            'role' => null
        );
    }

    public function get_by_login($username, $password)
    {
        $query = $this->db->where('username', $username)
            ->where('password', $password)
            ->get('authors');
        return $query->row_array();
    }

    public function get_all()
    {
        $query = $this->db->from('authors')->get();
        return $query->result_array();
    }

    public function get_by_id($id)
    {
        $query = $this->db->where('id', $id)->from('authors')->get();
        return $query->row_array();
    }

    public function save($data)
    {
        $this->db->insert('authors', $data);
    }

    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('authors', $data);
    }

    public function delete($id)
    {
        $this->db->where('id', $id);        
        $this->db->delete('authors');
    }
}
