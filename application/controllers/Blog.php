<?php
class Blog extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_permission();
        $this->load->model('Blog_model');
        $this->load->model('Gallery_model');
    }

    public function index()
    {
        $data['blogs'] = $this->Blog_model->get_all();

        template('blog/index', $data, array('script' => 'product.js'));
    }

    public function create()
    {
        $data['blog'] = $this->Blog_model->data();
        $data['blog']['cover_image'] = base_url('assets/img/bg/1.jpg');
        $data['blog']['data_image'] = 0;
        $data['blog']['gallerys'] = array();
        template('blog/blog_form', $data, array('script' => 'product.js'));
    }

    public function edit($id)
    {
        $data['blog'] = $this->Blog_model->get_by_id($id);

        $data['blog']['data_image'] = !empty($data['blog']['cover_image']) ? 1 : 0;
        $data['blog']['cover_image'] = !empty($data['blog']['cover_image']) ? base_url('uploads/' . $data['blog']['cover_image']) : base_url('assets/img/bg/1.jpg');
        $data['blog']['gallerys'] = $this->Gallery_model->get_by_blog($id);        

        template('blog/blog_form', $data, array('script' => 'product.js'));
    }

    public function save()
    {
        $post = $this->input->post();
        if (empty($post['id'])) {
            $data = $this->Blog_model->data();
        }

        // set var
        $file_name = $_FILES['cover_image']['name'];

        $data['id'] = $post['id'];
        $data['name'] = $post['name'];
        $data['detail'] = $post['detail'];
        $data['author_id'] = 2; // <<<<< hardcode
        $data['cover_title'] = $post['cover_title'];
        $data['cover_alt'] = $post['cover_alt'];

        // upload image cover
        // กำหนดการอัพโหลด
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'jpg|png|gif|jpeg';
        $config['max_size'] = 1024 * 5;
        $config['overwrite'] = true;

        //ทำการโหลด lib
        $this->load->library('upload', $config);
        if (!empty($file_name)) {
            $file_input = 'cover_image';
            $this->upload->do_upload($file_input);

            $data['cover_image'] = $file_name;
        }

        if (empty($post['id'])) {
            $data['created_at'] = $data['created_at'];
            $this->Blog_model->save($data);
            $last_id = $this->db->insert_id();
        } else {
            $this->Blog_model->update($data);
            $last_id = $data['id'];
        }

        // multiple upload file
        $gallery = array();
        log_message('debug', print_r($post, true));
        foreach ($_FILES['uploadfile']['name'] as $key => $name_file) {
            if(!empty($_FILES['uploadfile']['name'][$key])) {
                $_FILES['file']['name'] = $_FILES['uploadfile']['name'][$key];
                $_FILES['file']['type'] = $_FILES['uploadfile']['type'][$key];
                $_FILES['file']['tmp_name'] = $_FILES['uploadfile']['tmp_name'][$key];
                $_FILES['file']['error'] = $_FILES['uploadfile']['error'][$key];
                $_FILES['file']['size'] = $_FILES['uploadfile']['size'][$key];
    
                $this->upload->do_upload('file');            
                
                $gallery['path_name'] = $_FILES['uploadfile']['name'][$key];
                $gallery['ordering'] = $post['ordering'][$key];
                $gallery['title_name'] = $post['title_name'][$key];
                $gallery['alt_name'] = $post['alt_name'][$key];
                $gallery['blog_id'] = $last_id;
                $this->Gallery_model->save($gallery);
            }
        }

        redirect('blog');
    }

    public function delete($id)
    {
        $this->Blog_model->delete($id);
        echo json_encode(true);
    }

    public function delete_checked()
    {
        $post = $this->input->post();
        foreach ($post['check_id'] as $key => $check) {
            $this->Blog_model->delete($key);
        }

        echo json_encode(true);
    }

    public function delete_gallery($id)
    {
        // Homework delete image, delete db
        echo json_encode(true);
    }

    public function delete_cover($id)
    {
        echo json_encode(true);
    }
}
