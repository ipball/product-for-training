<h2 class="mt-4">Author management</h2>
  <form action="#" id="authorForm">
    <div>
      <a href="<?=base_url('author/create')?>" class="btn btn-sm btn-outline-info" role="button">Create New</a>
    </div>
    <div class="table-responsive mt-4">
      <table class="table table-striped table-sm">
        <thead>
          <tr>            
            <th>Name</th>
            <th>Username</th>
            <th>Role</th>
            <th>Action</th>              
          </tr>
        </thead>
        <tbody>
          <?php foreach($authors as $author): ?>
          <tr>        
            <td><?=$author['name']?></td>              
            <td><?=$author['username']?></td>          
            <td>####Home Work####</td>   
            <td>
              <a href="<?=base_url('author/permission/' . $author['id'])?>" class="btn btn-sm btn-outline-dark" role="button">Permission</a>
              <a href="<?=base_url('author/edit/' . $author['id'])?>" class="btn btn-sm btn-outline-warning" role="button">Edit</a>
              <button class="btn btn-sm btn-outline-danger btn-delete" data-id="<?=$author['id']?>" type="button">Delete#Homework</button>
          </td>              
          </tr>            
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </form>