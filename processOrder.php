<?php

use Inc\XssProtection;

require_once __DIR__ . '/inc/include.php';

# Redirect to login.php if user not present
if (!$auth->getUser()) redirect(base_url('/auth/login'), 301);

# Getting User Data
$user = $auth->getUser();

if($_SERVER['REQUEST_METHOD']) {
  $data = XssProtection::sanitizeInput($_POST);

  $productDetail = $db->getConnection()->prepare("SELECT price FROM products WHERE id = ?");
  $productDetail->bind_param('s', $data['product']);
  $productDetail->execute();
  $products = $productDetail->get_result()->fetch_assoc();
  
  $purchase = $db->insert('purchases', array_merge([
    'users' => $user['id'],
    'date' => date('Y-m-d'),
    'quantity' => 1,
  ], $data));

  sleep(3);

  $invoice = $db->insert('invoices', [
    'id' => 'INV-' . rand(1, 999999999),
    'date' => date('Y-m-d'),
    'purchase_id' => $purchase['id'],
    'customer' => $user['id'],
    'total' => 1 * (int) $products['price'],
    'status' => 'unpaid',
  ]);

  redirect('/');
}