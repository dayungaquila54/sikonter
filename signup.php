<?php

use Inc\InputValidator;
use Inc\XssProtection;

require_once __DIR__ . "/inc/include.php";

if($auth->getUser()) {
  redirect(base_url());
}

if(isset($_POST)) {
  $inputs   = XssProtection::sanitizeInput($_POST);
  $email    = $inputs['email'];
  $password = $inputs['password'];
  $surname  = $inputs['surname'];

  # Validate form
  $validator = new InputValidator();
  $validator->validateEmail($email)->validateMinLength($email, 5)->validateRequired($email, 5)->validateRequired($password)->validateMinLength($password, 8)->validateRequired($surname)->validateMinLength($surname, 5);

  if($validator->isValid()) {
    $data = [
      'email'    => $email,
      'password' => password_hash($password, PASSWORD_DEFAULT),
      'surname'  => $surname,
      'role'     => 'users',
    ];
    $db->insert('users', $data);
    redirect(base_url('/auth/login'));
  } else {
    $_SESSION['errors'] = $validator->getErrors();
    redirect(base_url('/auth/login'));
  }
}