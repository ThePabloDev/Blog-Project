<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/classes/Database.php';
require_once __DIR__ . '/classes/Auth.php';
require_once __DIR__ . '/classes/Post.php';
require_once __DIR__ . '/classes/Validator.php';

$auth = new Auth();
$user = $auth->getUser();

if (basename($_SERVER['PHP_SELF']) !== 'login.php' && 
    basename($_SERVER['PHP_SELF']) !== 'register.php' &&
    basename($_SERVER['PHP_SELF']) !== 'process_login.php' &&
    basename($_SERVER['PHP_SELF']) !== 'process_register.php') {
    if (!$auth->isLoggedIn()) {
        header('Location: login.php');
        exit;
    }
}
?>