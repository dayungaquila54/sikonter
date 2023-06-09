<?php

use Inc\XssProtection;

require_once(__DIR__ . '/inc/include.php');

# Redirect to login.php if user not present
if (!$auth->getUser()) redirect(base_url('/auth/login'), 301);

# Getting User Data
$user = $auth->getUser();

$input = XssProtection::sanitizeInput($_GET);

$payment = $db->getConnection()->prepare("SELECT * FROM invoices WHERE id = ? AND status = 'unpaid'");
$payment->bind_param('s', $input['id']);
$payment->execute();
$paymentData = $payment->get_result();

if($paymentData->num_rows === 0) {
  redirect(base_url("/invoices"));
}

$data = $paymentData->fetch_assoc();

$db->update('invoices', ['status' => 'paid'], "id = '{$data['id']}'");
$db->update('purchases', ['status' => true], "id = '{$data['purchase_id']}'");

redirect(base_url("/invoices"));