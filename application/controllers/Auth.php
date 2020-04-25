<?php
class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Author_model');
        $this->load->model('Permission_model');
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

            $permissions = $this->Permission_model->get_by_author($newdata['id']);
            $visibles = array();
            $crud = array();
            foreach ($permissions as $perm) {
                $visibles[$perm['menu_name']] = !empty($perm['visible']) ? $perm['visible'] : 0;
                $crud[$perm['menu_name']]['is_view'] = !empty($perm['is_view']) ? $perm['is_view'] : 0;
                $crud[$perm['menu_name']]['is_create'] = !empty($perm['is_create']) ? $perm['is_create'] : 0;
                $crud[$perm['menu_name']]['is_update'] = !empty($perm['is_update']) ? $perm['is_update'] : 0;
                $crud[$perm['menu_name']]['is_delete'] = !empty($perm['is_delete']) ? $perm['is_delete'] : 0;
            }

            $this->session->set_userdata('permissions', $visibles);
            $this->session->set_userdata('crud', $crud);


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