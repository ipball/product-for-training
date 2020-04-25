<?php
defined('BASEPATH') or exit('No direct script access allowed');

function template($content, $data = array(), $value = array())
{
    $CI = &get_instance();
    $CI->load->model('Permission_model');

    $temp['auth_user'] = $CI->session->userdata('auth_user');
    $permissions = $CI->Permission_model->get_by_author($temp['auth_user']['id']);
    $visibles = array();
    $crud = array();
    foreach ($permissions as $perm) {
        $visibles[$perm['menu_name']] = !empty($perm['visible']) ? $perm['visible'] : 0;
        $crud[$perm['menu_name']]['is_view'] = !empty($perm['is_view']) ? $perm['is_view'] : 0;
        $crud[$perm['menu_name']]['is_create'] = !empty($perm['is_create']) ? $perm['is_create'] : 0;
        $crud[$perm['menu_name']]['is_update'] = !empty($perm['is_update']) ? $perm['is_update'] : 0;
        $crud[$perm['menu_name']]['is_delete'] = !empty($perm['is_delete']) ? $perm['is_delete'] : 0;
    }

    $CI->session->set_userdata('permissions', $visibles);
    $CI->session->set_userdata('crud', $crud);

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
    $method = $CI->router->fetch_method();
    $in_menu = array('author', 'blog', 'customer');
    $in_method = array('index', 'create', 'edit', 'delete');
    // $permissions = $CI->session->userdata('permissions');
    $crud = $CI->session->userdata('crud');
    if (in_array($method, $in_method) && in_array($menu, $in_menu)) {
        $auth_actions = array(
            'index' => 'is_view',
            'create' => 'is_create',
            'edit' => 'is_update',
            'delete' => 'is_delete'
        );

        if ($crud[$menu][$auth_actions[$method]] == 0) {
            redirect('auth/page_denine');
        }
    }
}
