<?php

use Inc\InputValidator;
use Inc\XssProtection;

require_once __DIR__ . "/inc/include.php";

if ($auth->getUser()) {
  redirect(base_url("/"));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $inputs    = XssProtection::sanitizeInput($_POST);
  $email     = $inputs['email'];
  $password  = $inputs['password'];
  $remember  = filter_var($inputs['remember'], FILTER_VALIDATE_BOOLEAN);

  $validator = new InputValidator(); // Create an instance of InputValidator

  $validator->validateEmail($email)
    ->validateMinLength($email, 5)
    ->validateRequired($email)
    ->validateRequired($password)
    ->validateMinLength($password, 8);

  # Validate it!
  if ($validator->isValid()) {
    if ($auth->attempt(['email' => $email, 'password' => $password], $remember)) {
      redirect("./");
    } else {
      $_SESSION['errors'] = ["Woops, email or password isn't valid or not found on our records! Recheck again your credential before continue!"];
    }
  } else {
    $_SESSION['errors'] = $validator->getErrors();
  }

  redirect(base_url("/auth/login"));
}

redirect(base_url("/auth/login"));
