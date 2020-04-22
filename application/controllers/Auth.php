<?php
class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Author_model');
    }

    public function index()
    {
        redirect('auth/login');
    }

    public function login()
    {        
        $this->load->view('auth/login');
    }

    public function check_login()
    {
        $post = $this->input->post();
        $user = $this->Author_model->get_by_login($post['username'], sha1($post['password']));
        if(!empty($user)){
            $newdata = array(
                'id' => $user['id'],
                'name' => $user['name'],
                'username' => $user['username'],
                'role' => $user['role'],
                'role_name' => ($user['role'] == 1 ? 'Administrator' : 'User')
            );
            $this->session->set_userdata('auth_user', $newdata);
            redirect('blog');
        } else {
            $this->session->set_flashdata('message', 'ชื่อผู้ใช้หรือรหัสผ่านผิดพลาด!');
            redirect('auth/login');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('auth_user');
        redirect('auth', 'refresh');
    }

    public function page_denine()
    {
        $this->load->view('error_denine');
    }
}