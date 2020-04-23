<?php
class Author extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // check_permission();
        $this->load->model('Author_model');
        $this->load->model('Menu_model');
        $this->load->model('Permission_model');
    }

    public function index()
    {        
        $data['authors'] = $this->Author_model->get_all();
        template('author/index', $data, array('script'=>'author.js'));
    }

    public function create()
    {
        $data['roles'] = get_roles();
        $data['author'] = $this->Author_model->data();
        template('author/author_form', $data, array('script'=>'author.js'));
    }

    public function edit($id)
    {
        $data['roles'] = get_roles();
        $data['author'] = $this->Author_model->get_by_id($id);
        template('author/author_form', $data, array('script'=>'author.js'));
    }

    public function save()
    {        
        $post = $this->input->post();

        if(empty($post['id'])) {
            $data = $this->Author_model->data();
        }

        $data['id'] = $post['id'];
        $data['name'] = $post['name'];
        $data['username'] = $post['username'];
        $data['role'] = $post['role'];
        
        if(!empty($post['password'])) {
            $data['password'] = sha1($post['password']);
        }
        
        if(empty($post['id'])) {            
            $this->Author_model->save($data);
        } else {
            $this->Author_model->update($data);
        }

        redirect('author');
    }

    public function delete($id)
    {
        $this->Author_model->delete($id);
        echo json_encode(true);
    }

    public function delete_checked()
    {
        $post = $this->input->post();
        foreach($post['check_id'] as $key => $check) {
            $this->Author_model->delete($key);
        }

        echo json_encode(true);
    }

    public function permission($id)
    {
        $data['author_id'] = $id;
        $data['menus'] = $this->Menu_model->get_all();        
        $permissions = $this->Permission_model->get_by_author($id);        
        $new_pms = array();
        $new_crud = array();
        foreach ($permissions as $permission ) {
            $new_pms[$permission['menu_name']] = $permission['visible'];
            $new_crud[$permission['menu_name']]['is_view'] = !empty($permission['is_view']);
            $new_crud[$permission['menu_name']]['is_create'] = !empty($permission['is_create']);
            $new_crud[$permission['menu_name']]['is_update'] = !empty($permission['is_update']);
            $new_crud[$permission['menu_name']]['is_delete'] = !empty($permission['is_delete']);
        }
        
        foreach($data['menus'] as &$item) {
            $item['is_checked'] = !empty($new_pms[$item['name']]) ? $new_pms[$item['name']] : 0;
            $item['is_view'] = !empty($new_crud[$item['name']]['is_view']) ? $new_crud[$item['name']]['is_view'] : 0;
            $item['is_create'] = !empty($new_crud[$item['name']]['is_create']) ? $new_crud[$item['name']]['is_create'] : 0;
            $item['is_update'] = !empty($new_crud[$item['name']]['is_update']) ? $new_crud[$item['name']]['is_update'] : 0;
            $item['is_delete'] = !empty($new_crud[$item['name']]['is_delete']) ? $new_crud[$item['name']]['is_delete'] : 0;
        }
        
        template('author/permission_form', $data, array('script'=>'author.js'));
    }

    public function save_permission()
    {
        $post = $this->input->post();

        // permission visible
        $this->Permission_model->delete_by_author($post['author_id']);        
        foreach($post['is_visible'] as $key => $visible) {
            $data = array(
                'menu_name' => $key,
                'author_id' => $post['author_id'],
                'visible' => $visible
            );                        
            $this->Permission_model->save($data);
        }

        // permission crud
        $is_action = array('is_view', 'is_create', 'is_update', 'is_delete');
        
        foreach($is_action as $action) {
            if(!empty($post[$action])) {
                foreach($post[$action] as $menu_name => $menu_value) {
                    $data = array(
                        'author_id' => $post['author_id'],
                        'menu_name' => $menu_name,
                        $action => $menu_value
                    );
                    $this->Permission_model->update_by_author($data);                    
                }
            }
        }

        redirect('author');
    }
}