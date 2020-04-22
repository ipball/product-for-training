<h2 class="mt-4">Blog management</h2>
  <form action="#" id="blogForm">
    <div>
      <a href="<?=base_url('blog/create')?>" class="btn btn-sm btn-outline-info" role="button">Create New</a>
      <button class="btn btn-sm btn-outline-danger btn-delete-selected" type="button">Delete Selected</button>
    </div>
    <div class="table-responsive mt-4">
      <table class="table table-striped table-sm">
        <thead>
          <tr>
            <td>#</td>
            <th>Name</th>
            <th>author</th>
            <th>Date</th>
            <th>Action</th>              
          </tr>
        </thead>
        <tbody>
          <?php foreach($blogs as $blog): ?>
          <tr>
            <td><input type="checkbox" name="check_id[<?=$blog['id']?>]" class="checkbox" value="1"></td>            
            <td><?=$blog['blog_name']?></td>              
            <td><?=$blog['author_name']?></td>              
            <td><?=$blog['created_at']?></td>              
            <td>
              <a href="<?=base_url('blog/edit/' . $blog['id'])?>" class="btn btn-sm btn-outline-warning" role="button">Edit</a>
              <button class="btn btn-sm btn-outline-warning btn-delete" data-id="<?=$blog['id']?>" type="button">Delete</button>
          </td>              
          </tr>            
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </form>