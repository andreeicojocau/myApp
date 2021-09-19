<div class="col-md-12">
  <div class="d-flex justify-content-end">
    <a class="btn btn-success" title="Add user" href="<?php echo genUrl('users.store') ?>"><i class="material-icons">add</i></a>
  </div>
  <div class="card card-plain">
    <div class="card-header card-header-primary">
      <h4 class="card-title mt-0"> User List</h4>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table">
          <thead class=" text-primary">
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Actions</th>
          </thead>
          <tbody>
            <?php if (isset($this->data['users'])) : ?>
              <?php foreach ($this->data['users'] as $user) : ?>
                <tr>
                  <td><?php echo $user->id ?></td>
                  <td><?php echo $user->name ?></td>
                  <td><?php echo $user->email ?></td>
                  <td>
                    <a class="btn btn-primary" href="<?php echo genUrl('users.update', ['id' => $user->id]) ?>" title="Edit user">
                      <i class="material-icons">edit</i>
                    </a>
                    <a class="btn btn-danger" href="<?php echo genUrl('users.delete', ['id' => $user->id]) ?>" title="Delete user"><i class="material-icons">delete</i></a>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>