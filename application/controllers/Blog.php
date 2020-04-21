<?php
class Blog extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Blog_model');
    }

    public function index()
    {        
        $data['blogs'] = $this->Blog_model->get_all();
        template('blog/index', $data, array('script'=>'product.js'));
    }

    public function create()
    {
        $data['blog'] = $this->Blog_model->data();
        template('blog/blog_form', $data, array('script'=>'product.js'));
    }

    public function edit($id)
    {
        $data['blog'] = $this->Blog_model->get_by_id($id);
        template('blog/blog_form', $data, array('script'=>'product.js'));
    }

    public function save()
    {        
        $post = $this->input->post();

        if(empty($post['id'])) {
            $data = $this->Blog_model->data();
        }

        $data['id'] = $post['id'];
        $data['name'] = $post['name'];
        $data['detail'] = $post['detail'];
        $data['author_id'] = 2; // <<<<< hardcode        
        
        if(empty($post['id'])) {
            $data['created_at'] = $data['created_at'];
            $this->Blog_model->save($data);
        } else {
            $this->Blog_model->update($data);
        }

        redirect('blog');
    }

    public function delete($id)
    {
        $this->Blog_model->delete($id);
        echo json_encode(true);
    }
}