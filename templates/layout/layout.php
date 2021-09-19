<!doctype html>
<html lang="en">

<head>
  <?php echo $this->load('layout/header'); ?>
</head>

<body>
  <div class="wrapper ">
    <!-- Sidebar -->
    <div class="sidebar" data-color="purple" data-background-color="white">
      <div class="logo">
        <a href="<?php echo genUrl('index') ?>" class="simple-text logo-mini">
          MyApp
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item <?php echo $this->activeMenu == 'dashboard' ? 'active' : '' ?>">
            <a class="nav-link" href="<?php echo genUrl('index') ?>">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item <?php echo $this->activeMenu == 'users' ? 'active' : '' ?>">
            <a class="nav-link" href="<?php echo genUrl('users') ?>">
              <i class="material-icons">manage_accounts</i>
              <p>Users</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <!-- End Sidebar -->
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="<?php echo genUrl('logout'); ?>">
                  <i class="material-icons">logout</i> Log out
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <!-- Content -->
      <div class="content">
        <div class="container-fluid">
          <?php echo $this->load($this->template); ?>
        </div>
      </div>
      <!-- End Content -->
      <!-- Footer Tribute to theme creators -->
      <footer class="footer">
        <?php echo $this->load('layout/footer'); ?> 
      </footer>
      <!-- End Footer -->
    </div>
  </div>
</body>

</html>