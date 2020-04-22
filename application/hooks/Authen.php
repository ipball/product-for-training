<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Authen
{
    public function __construct()
    {
        $this->CI = &get_instance();
    }

    public function checklogin()
    {
        $class = $this->CI->router->fetch_class();
        $method = $this->CI->router->fetch_method();        

        $auth_user = $this->CI->session->userdata('auth_user');
        if (!empty($auth_user['id'])) {
            if ($class == 'auth' && $method == 'login') {
                redirect(base_url());
            }

        } else {
            if($class != 'auth') {
                $this->CI->session->set_flashdata('message', 'คุณยังไม่ได้เข้าสู่ระบบ!');
                redirect('auth');
            }
        }
    }
}
