<h2 class="mt-4">Blog management</h2>
<div>
    <a href="<?=base_url('blog')?>" class="btn btn-sm btn-outline-dark" role="button">Back</a>
</div>
<form class="form row" action="<?=base_url('blog/save')?>" method="post" enctype="multipart/form-data">
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
        <table class="table table-bordered">
            <tr>
                <th style="width:200px;" class="text-right">Cover</th>
                <td>
                    <img src="<?=$blog['cover_image']?>" alt="" width="200" class="cover-image">
                    <div>
                        <input type="file" name="cover_image">
                    </div>
                    <div>
                        <button class="btn btn-sm btn-outline-warning mt-1 btn-cover-reset" data-image="<?=$blog['data_image']?>" data-href="<?=base_url('blog/delete_cover/' . $blog['id'])?>" type="button">Reset Image</button>
                    </div>
                </td>
            </tr>
            <tr>
                <th class="text-right">Title</th>
                <td><?php echo form_input(array('name'=>'cover_title','value' => $blog['cover_title'], 'class'=>'form-control')); ?></td>
            </tr>
            <tr>
                <th class="text-right">Alt</th>
                <td><?php echo form_input(array('name'=>'cover_alt','value' => $blog['cover_alt'], 'class'=>'form-control')); ?></td>
            </tr>
        </table>
    </div>

    <div class="col-md-12">
        <div class="mb-3">
            <button class="btn btn-sm btn-outline-warning add-gallery" type="button">Add Gallery</button>
        </div>
        <table class="table table-bordered" id="tableGallery">
            <?php if(count($blog['gallerys']) > 0): ?>
            <?php foreach($blog['gallerys'] as $gallery): ?>
            <tr>
                <td style="width:300px;">
                    <img src="<?=base_url('uploads/' . $gallery['path_name'] )?>" class="gallery-image" alt="" width="200">
                    <div>
                        <input type="file" name="uploadfile[]" class="upload-file">
                    </div>
                    <div>
                        <button class="btn btn-sm btn-outline-danger mt-1 btn-gallery-delete" data-href="<?=base_url('blog/delete_gallery/' . $gallery['id'])?>" type="button">Delete Image</button>
                    </div>
                </td>
                <td>
                    <label>Order</label>
                    <?php echo form_input(array('name'=>'ordering[]','value' => $gallery['ordering'], 'class'=>'form-control')); ?>
                </td>
                <td>
                    <label>Title</label>
                    <?php echo form_input(array('name'=>'title_name[]','value' => $gallery['title_name'], 'class'=>'form-control')); ?>
                </td>
                <td>
                    <label>Alt</label>
                    <?php echo form_input(array('name'=>'alt_name[]','value' => $gallery['alt_name'], 'class'=>'form-control')); ?>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php else: ?>
            <tr>
                <td style="width:300px;">
                    <img src="<?=base_url('assets/img/bg/1.jpg')?>" alt="" width="200">
                    <div>
                        <input type="file" name="uploadfile[]" class="upload-file">
                    </div>
                    <div>
                        <button class="btn btn-sm btn-outline-danger mt-1 btn-gallery-delete" type="button">Delete Image</button>
                    </div>
                </td>
                <td>
                    <label>Order</label>
                    <?php echo form_input(array('name'=>'ordering[]','value' => '', 'class'=>'form-control')); ?>
                </td>
                <td>
                    <label>Title</label>
                    <?php echo form_input(array('name'=>'title_name[]','value' => '', 'class'=>'form-control')); ?>
                </td>
                <td>
                    <label>Alt</label>
                    <?php echo form_input(array('name'=>'alt_name[]','value' => '', 'class'=>'form-control')); ?>
                </td>
            </tr>
            <?php endif; ?>
        </table>        
    </div>
    

    <div class="col-md-12">
        <button type="submit" class="btn btn-sm btn-outline-primary">Save</button>
    </div>
</form>