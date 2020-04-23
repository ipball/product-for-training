<h2 class="mt-4">Permission management</h2>
<div>
    <a href="<?=base_url('author')?>" class="btn btn-sm btn-outline-dark" role="button">Back</a>
</div>
<form class="form mt-3" action="<?=base_url('author/save_permission')?>" method="post">
    <?php echo form_hidden('author_id', $author_id); ?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="width:60px;">#</th>
                <th style="width:300px;">Menu Name</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($menus as $key => $menu): ?>
            <tr>
                <td><?=$key+1?></td>
                <td><?=$menu['name']?></td>
                <td>
                    <?php echo form_radio('is_visible['.$menu['name'].']', 1, $menu['is_checked']==1) ?> Visible
                    <?php echo form_radio('is_visible['.$menu['name'].']', 0, $menu['is_checked']==0) ?> None
                </td>
                <td>
                    <label class="is-all" data-id="check-<?=$menu['name']?>"><?php echo form_checkbox('is_all['.$menu['name'].']', 1, false, array('class'=>'check-all')) ?> All</label>
                    <label><?php echo form_checkbox('is_view['.$menu['name'].']', 1, $menu['is_view']==1, array('class'=>'check-'.$menu['name'])) ?> View</label>
                    <label><?php echo form_checkbox('is_create['.$menu['name'].']', 1, $menu['is_create']==1, array('class'=>'check-'.$menu['name'])) ?> Create</label>
                    <label><?php echo form_checkbox('is_update['.$menu['name'].']', 1, $menu['is_update']==1, array('class'=>'check-'.$menu['name'])) ?> Update</label>
                    <label><?php echo form_checkbox('is_delete['.$menu['name'].']', 1, $menu['is_delete']==1, array('class'=>'check-'.$menu['name'])) ?> Delete</label>                    
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table> 
    <button type="submit" class="btn btn-sm btn-outline-primary">Save</button>
</form>