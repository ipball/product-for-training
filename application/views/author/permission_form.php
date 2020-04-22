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
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table> 
    <button type="submit" class="btn btn-sm btn-outline-primary">Save</button>
</form>