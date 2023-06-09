<?php

/**
 * The function stored
 * 
 * @since 1.0.0
 * @version 1.0.0
 * @author 
 */

/**
 * Abbrevating for large number length function
 * 
 * @see https://www.solusilain.com/solusi-menyingkat-format-angka-ribuan-rb-jutaan-jt-dst-di-php/
 * @author SolusiLain.com 
 */
function numberAbbr($n, $precision = 1) {
	$abbreviations = ['', 'K', 'M', 'B', 'T'];
	$index = 0;

	while ($n >= 1000 && $index < count($abbreviations) - 1) {
		$n /= 1000;
		$index++;
	}

	$numbers = number_format($n, $precision);

	if ($precision > 0) {
		$decimalSeparator = '.' . str_repeat('0', $precision);
		$numbers = str_replace($decimalSeparator, '', $numbers);
	}

	return $numbers . $abbreviations[$index];
}

/**
 * Get base URL
 * 
 * @since 1.0.1
 * @author 
 * @param mixed $addUrl The additional URL to added
 * @return $url The complete baseUrl link
 */
function base_url($url = null) {
  $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
  $base = $protocol . $_SERVER['HTTP_HOST'];

  if (!empty($url)) {
    $base .= '/' . trim($url, '/');
  }

  return $base;
}

/**
 * Get base assets URL.
 * 
 * @since 1.0.1
 * @author 
 * @param mixed $addUrl The additional URL to added
 * @param mixed $type The type and refer into assets path
 * @return $url The complete baseUrl link
 */
function asset($addUrl = null, $type = 'root', $version = '1.0.0') {
  $base = '/assets';
  
  if ($type == 'admin') {
    $base .= '/admin';
  } elseif ($type == 'frontend') {
    $base .= '/frontend';
  }
  
  return base_url($base . ($addUrl ? '/' . ltrim($addUrl, '/') : '') . "?version={$version}");
}

/**
 * Get the old input value for a given input name.
 *
 * @since 1.0.1
 * @author 
 * @param string $fieldName The name of the input field.
 * @param mixed $default The default value to return if the input value is not found.
 * @return mixed The old input value or the default value.
 */
function old($fieldName, $default = '') {
  return $_POST[$fieldName] ?? $_GET[$fieldName] ?? $default;
}

/**
 * Dump and die for debuggin with xdebug and kill next process like laravel
 * 
 * Note: if you a native php user, use xdebug extension in your php. If you wanna tutorial, read on @see docs below.
 * 
 * @since 1.0.1
 * @author 
 * @param mixed $x The variable to be debugged
 * @see https://stackoverflow.com/a/58947494/17911271
 * @see https://www.warungbelajar.com/tutorial-php-part-56-debugging-php-menggunakan-xdebug-dan-visual-studio-code.html Xdebug Install (Bahasa Indonesia)
 * @see https://medium.com/hookigroup/php-debugging-dengan-xdebug-visual-studio-code-59d3924c74d1 Xdebug Install (English)
 */
function dd(...$x) {
  array_map(function($x) { var_dump($x); }, func_get_args()); die;
}

/**
 * Redirect to a specified URL.
 *
 * @since 1.0.1
 * @author 
 * @param string $url The URL to redirect to.
 * @param int $statusCode The HTTP status code for the redirect. Defaults to 302 (Found).
 */
function redirect($url, $statusCode = 302) {
  header("Location: " . $url, true, $statusCode);
  exit;
}