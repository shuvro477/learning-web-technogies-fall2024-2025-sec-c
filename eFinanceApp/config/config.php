<?php

if (!defined('BASE_URL')) {
    define('BASE_URL', 'http://localhost/eFinanceApp');
}

if (!defined('DB_HOST')) {
    define('DB_HOST', 'localhost');
}

if (!defined('DB_NAME')) {
    define('DB_NAME', 'efinance_db');
}

if (!defined('DB_USER')) {
    define('DB_USER', 'root');
}

if (!defined('DB_PASS')) {
    define('DB_PASS', '');
}

try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>