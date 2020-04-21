<h2 class="mt-4">Blog management</h2>
<div>
    <a href="<?=base_url('blog')?>" class="btn btn-sm btn-outline-dark" role="button">Back</a>
</div>
<form class="form row" action="<?=base_url('blog/save')?>" method="post">
    <?php echo form_hidden('id', $blog['id']); ?>
    <div class="form-group col-md-12">
        <label for="Name">Name</label>
        <?php echo form_input(array('name'=>'name','value' => $blog['name'], 'class'=>'form-control')); ?>
    </div>
    <div class="form-group col-md-12">
        <label for="Name">Detail</label>
        <?php echo form_textarea(array('name' => 'detail', 'value'=> $blog['detail'], 'class'=>'form-control', 'rows' => 3)) ?>
    </div>

    <div class="col-md-12">
        <button type="submit" class="btn btn-sm btn-outline-primary">Save</button>
    </div>
</form>