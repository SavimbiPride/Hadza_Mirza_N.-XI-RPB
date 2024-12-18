<?php require 'conn.php'; ?>
<nav class="navbar bg-body-tertiary fixed-top">
  <div class="container-fluid">
    <img src="img/logo remove.png" class="card-img-top" alt="logo img" style="width: 5rem;">
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header">
      <img src="img/logo remove.png" class="card-img-top" alt="logo img" style="width: 10rem;">
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="dashboard.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="management_admin.php">admin management</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="management_user.php">user management</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              settings
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="logout.php">log out</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>