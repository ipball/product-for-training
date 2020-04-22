<?php
defined('BASEPATH') or exit('No direct script access allowed');

function template($content, $data = array(), $value = array())
{
    $CI = &get_instance();
    $CI->load->model('Permission_model');

    $temp['auth_user'] = $CI->session->userdata('auth_user');
    $permissions = $CI->Permission_model->get_by_author($temp['auth_user']['id']);
    $visibles = array();
    foreach ($permissions as $value) {
        $visibles[$value['menu_name']] = $value['visible'];
    }

    $CI->session->set_userdata('permissions', $visibles);
    $temp['visibles'] = $visibles;
    $temp['title'] = !empty($value['title']) ? $value['title'] : 'ระบบสินค้า';
    $temp['script'] = !empty($value['script']) ? $value['script'] : null;
    $temp['content'] = $CI->load->view($content, $data, true);
    $CI->load->view('layouts/master', $temp);
}

function get_roles($data = 'โปรดเลือกข้อมูล')
{
    return array('' => $data, '1' => 'Administrator', '2' => 'User');
}

function check_permission()
{
    $CI = &get_instance();
    $menu = $CI->router->fetch_class();
    $permissions = $CI->session->userdata('permissions');
    log_message('debug', print_r($permissions[$menu], true));
    if ($permissions[$menu] == 0) {
        redirect('auth/page_denine');
    }
}
