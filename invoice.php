<?php

require_once(__DIR__ . '/inc/include.php');

# Redirect to login.php if user not present
if (!$auth->getUser()) redirect(base_url('/auth/login'), 301);

# Getting User Data
$user = $auth->getUser();

# Products Data
$invoice = $db->getConnection()->prepare("SELECT invoices.*, purchases.product, products.name FROM invoices LEFT JOIN purchases ON purchases.id = invoices.purchase_id LEFT JOIN products ON purchases.product = products.id WHERE customer = ?");
$invoice->bind_param('s', $user['id']);
$invoice->execute();
$invoiceList = $invoice->get_result();

?><!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <title>All Invoice</title>

  <link rel="stylesheet" href="<?= asset('css/bootstrap.min.css', 'frontend', '5.3.0') ?>" />
</head>

<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="<?=base_url() ?>">Sikonter</a>
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
            <a class="nav-link" href="<?=base_url() ?>">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="<?=base_url('order') ?>">New Order</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?=base_url('purchases') ?>">Purchase</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="<?=base_url('invoices') ?>">Invoices</a>
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

          <a href="<?=base_url('admin') ?>" class="btn btn-warning">Go To Admin</a>
        </div>
      <?php endif; ?>
      <!-- Alert if is Admin -->

      <div class="row">
        <div class="col-md-3">
          <div class="list-group">
            <a class="list-group-item" href="<?=base_url('/') ?>">Home</a>
            <a class="list-group-item" href="<?=base_url('/order') ?>">Order</a>
            <a class="list-group-item" href="<?=base_url('/purchase') ?>">Purchase</a>
            <a class="list-group-item active" href="<?=base_url('/invoices') ?>">Invoice</a>
          </div>
        </div>
        <div class="col-md-9">
          <h1>Invoice Order</h1>
          <p>List of your invoices order.</p>

          <hr />

          <div class="table-responsive">
            <table class="table-striped table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Product</th>
                  <th>Date</th>
                  <th>Status</th>
                  <th>Pay</th>
                </tr>
              </thead>
              <tbody>
                <?php if($invoiceList->num_rows > 0) : ?>
                <?php while($data = $invoiceList->fetch_assoc()) : ?>
                <tr>
                  <td><?=$data['id'] ?></td>
                  <td><?=$data['name'] ?></td>
                  <td><?=date('l, j F Y', strtotime($data['date'])) ?></td>
                  <td>
                    <?php if($data['status'] === 'paid') : ?>
                      <span class="badge bg-success">Success</span>
                    <?php else : ?>
                      <span class="badge bg-warning">Pending</span>
                    <?php endif; ?>
                  </td>
                  <td>
                    <a href="<?=base_url("pay/{$data['id']}") ?>" class="btn btn-primary<?php if($data['status'] === 'paid') : ?> disabled<?php endif; ?>">Pay Now</a>
                  </td>
                </tr>
                <?php endwhile; ?>
                <?php else: ?>
                <tr>
                  <td colspan="5">Woops, data not found!</td>
                </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div>
  </main>

  <script src="<?= asset('js/bootstrap.bundle.min.js', 'frontend', '5.3.0') ?>"></script>
</body>

</html>