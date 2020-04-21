<?php
defined('BASEPATH') or exit('No direct script access allowed');

function template($content, $data = array(), $value = array())
{
    $CI = &get_instance();
    $temp['title'] = !empty($value['title']) ? $value['title'] : 'ระบบสินค้า';
    $temp['script'] = !empty($value['script']) ? $value['script'] : null;
    $temp['content'] = $CI->load->view($content, $data, true);
    $CI->load->view('layouts/master', $temp);
}