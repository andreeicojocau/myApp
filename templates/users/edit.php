<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header card-header-primary">
        <h4 class="card-title">Edit User</h4>
        <p class="card-category">Update user data</p>
      </div>
      <?php if($this->hasErrors()): ?>
        <?php foreach($this->getErrors() as $key => $value): ?>
          <div class="d-flex justify-content-center">
            <h3><span class="badge badge-danger"><?php echo $this->getError($key); ?></span></h3>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
      <div class="errors"></div>
      <div class="card-body">
        <form method="POST" action="<?php echo genUrl('users.update', ['id' => $this->data['user']->id]); ?>">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="bmd-label-floating">Name</label>
                <input type="text" required="true" class="form-control" name="name" id="name" value="<?php echo $this->data['user']->name ?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="bmd-label-floating">Email</label>
                <input type="email" required="true" class="form-control" name="email" id="email" value="<?php echo $this->data['user']->email ?>">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="bmd-label-floating">Password</label>
                <input type="password" class="form-control" name="password" id="password">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="bmd-label-floating">Password confirm</label>
                <input type="password" class="form-control" name="confirmed_password" id="confirmed_password">
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary pull-right">Save</button>
          <div class="clearfix"></div>
        </form>
      </div>
    </div>
  </div>
</div>