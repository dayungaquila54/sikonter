<?php

namespace Inc;

/**
 * Input validator class
 * 
 * @since 1.0.0
 * @version 1.0.0
 * @author 
 */
class InputValidator
{
  /**
   * Private variable to store validation bags
   * 
   * @since 1.0.0
   * @version 1.0.0
   * @author 
   * @var array Contains validation error messages
   */
  private static $errors = [];

  public function __construct()
  {
    session_destroy();
    session_start();
  }

  /**
   * Validates an email address.
   * 
   * @since 1.0.0
   * @version 1.0.0
   * @author 
   * @param string $email The email address to validate
   * @return \Inc\InputValidator
   */
  public static function validateEmail($email)
  {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      self::$errors[] = "Invalid email format";
    }

    return new self();
  }

  /**
   * Validates the minimum length of a value.
   * 
   * @since 1.0.0
   * @version 1.0.0
   * @author 
   * @param string $value The value to validate
   * @param int $minLength The minimum length required
   * @return \Inc\InputValidator
   */
  public static function validateMinLength($value, $minLength)
  {
    if (strlen($value) < $minLength) {
      self::$errors[] = "Minimum length should be $minLength";
    }

    return new self();
  }

  /**
   * Validates the maximum length of a value.
   * 
   * @since 1.0.0
   * @version 1.0.0
   * @author 
   * @param string $value The value to validate
   * @param int $maxLength The maximum length allowed
   * @return \Inc\InputValidator
   */
  public static function validateMaxLength($value, $maxLength)
  {
    if (strlen($value) > $maxLength) {
      self::$errors[] = "Maximum length exceeded ($maxLength)";
    }

    return new self();
  }

  /**
   * Validates if a value is required.
   * 
   * @since 1.0.0
   * @version 1.0.0
   * @author 
   * @param mixed $value The value to validate
   * @return \Inc\InputValidator
   */
  public static function validateRequired($value)
  {
    if (empty($value)) {
      self::$errors[] = "This field is required";
    }

    return new self();
  }

  /**
   * Validates if a value is numeric.
   * 
   * @since 1.0.0
   * @version 1.0.0
   * @author 
   * @param mixed $value The value to validate
   * @return \Inc\InputValidator
   */
  public static function validateNumber($value)
  {
    if (!is_numeric($value)) {
      self::$errors[] = "Invalid number format";
    }

    return new self();
  }

  /**
   * Checks if all the validations pass.
   * 
   * @since 1.0.0
   * @version 1.0.0
   * @author 
   * @return bool True if all validations pass, false otherwise
   */
  public static function isValid()
  {
    return empty(self::$errors);
  }

  /**
   * Returns the validation error messages.
   * 
   * @since 1.0.0
   * @version 1.0.0
   * @author 
   * @return array Validation error messages
   */
  public static function getErrors()
  {
    return self::$errors;
  }
}
