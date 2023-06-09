<?php

use Inc\Auth;
use Inc\DBConnection;

# Import all required files
require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/class.db.php';
require_once __DIR__ . '/class.auth.php';
require_once __DIR__ . '/class.xss.php';
require_once __DIR__ . '/class.validate.php';

# Database Initializaition
# Change with the required credentials
$hostname = '';   // Ganti sesuai dengan kredensial mysql kamu
$username = '';        // Ganti sesuai dengan kredensial mysql kamu
$password = '';  // Ganti sesuai dengan kredensial mysql kamu
$database = 'db_sikonterr'; // Ganti sesuai dengan kredensial mysql kamu

$db     = new DBConnection($hostname, $username, $password, $database);
$dbInit = $db->getConnection();
$auth   = new Auth($dbInit);