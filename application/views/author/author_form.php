<h2 class="mt-4">Blog management</h2>
<div>
    <a href="<?=base_url('author')?>" class="btn btn-sm btn-outline-dark" role="button">Back</a>
</div>
<form class="form row" action="<?=base_url('author/save')?>" method="post">
    <?php echo form_hidden('id', $author['id']); ?>
    <div class="form-group col-md-12">
        <label for="Name">Name</label>
        <?php echo form_input(array('name'=>'name','value' => $author['name'], 'class'=>'form-control')); ?>
    </div>
    <div class="form-group col-md-6">
        <label for="username">username</label>
        <?php echo form_input(array('name'=>'username','value' => $author['username'], 'class'=>'form-control')); ?>
    </div>
    <div class="form-group col-md-6">
        <label for="password">password</label>
        <?php echo form_password(array('name'=>'password','value' => '', 'class'=>'form-control')); ?>
    </div>
    <div class="form-group col-md-12">
        <label for="Role">Role</label>
        <?php echo form_dropdown('role', $roles, $author['role'], array('class' => 'form-control')); ?>
    </div>

    <div class="col-md-12">
        <button type="submit" class="btn btn-sm btn-outline-primary">Save</button>
    </div>
</form>