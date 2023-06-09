<?php

require_once(__DIR__ . '/inc/include.php');

# Redirect to login.php if user not present
if (!$auth->getUser()) redirect(base_url('/auth/login'), 301);

# Getting User Data
$user = $auth->getUser();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <title>Dashboard</title>

  <link rel="stylesheet" href="<?= asset('css/bootstrap.min.css', 'frontend', '5.3.0') ?>" />
</head>

<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="<?= base_url() ?>">Sikonter</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="<?= $auth->avatar() ?>" class="rounded-circle" height="30px" alt="<?= $user['surname'] ?>" />
              <span class="d-none d-md-none d-lg-inline"><?= $user['surname'] ?></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="javascript:void(0)">My Profile</a></li>
              <li><a class="dropdown-item" href="javascript:void(0)">Change Password</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="<?= base_url('logout.php') ?>">Logout</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <nav class="navbar border-bottom navbar-expand-lg bg-body-tertiary">
    <div class="container">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarBottom" aria-controls="navbarBottom" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarBottom">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="<?= base_url() ?>">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('order') ?>">New Order</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('purchases') ?>">Purchase</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('invoices') ?>">Invoices</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <main class="mt-3">
    <div class="container">

      <!-- Alert if is Admin -->
      <?php if ($user['role'] == 'admin') : ?>
        <div class="alert alert-warning">
          <h4>Warning</h4>
          <p class="mb-3">You are now logged in as admin. Please login to this panel to easily manage any data!</p>

          <a href="<?= base_url('admin') ?>" class="btn btn-warning">Go To Admin</a>
        </div>
      <?php endif; ?>
      <!-- Alert if is Admin -->

      <div class="row">
        <div class="col-xl-4 col-md-6">
          <div class="card bg-primary text-white mb-4">
            <div class="card-body">Order New</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
              <a class="small text-white stretched-link text-decoration-none" href="<?=base_url('order') ?>">View Details</a>
              <div class="small text-white"><svg class="svg-inline--fa fa-angle-right" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512" data-fa-i2svg="">
                  <path fill="currentColor" d="M246.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L178.7 256 41.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z"></path>
                </svg><!-- <i class="fas fa-angle-right"></i> Font Awesome fontawesome.com --></div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-md-6">
          <div class="card bg-warning text-white mb-4">
            <div class="card-body">See Your Invoice</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
              <a class="small text-white stretched-link text-decoration-none" href="<?=base_url('invoices') ?>">View Details</a>
              <div class="small text-white"><svg class="svg-inline--fa fa-angle-right" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512" data-fa-i2svg="">
                  <path fill="currentColor" d="M246.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L178.7 256 41.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z"></path>
                </svg><!-- <i class="fas fa-angle-right"></i> Font Awesome fontawesome.com --></div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-md-6">
          <div class="card bg-success text-white mb-4">
            <div class="card-body">Your Purchases</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
              <a class="small text-white stretched-link text-decoration-none" href="<?=base_url('purchases') ?>">View Details</a>
              <div class="small text-white"><svg class="svg-inline--fa fa-angle-right" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512" data-fa-i2svg="">
                  <path fill="currentColor" d="M246.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L178.7 256 41.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z"></path>
                </svg><!-- <i class="fas fa-angle-right"></i> Font Awesome fontawesome.com --></div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </main>

  <script src="<?= asset('js/bootstrap.bundle.min.js', 'frontend', '5.3.0') ?>"></script>
</body>

</html>