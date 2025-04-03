<?php
require_once 'init.php';

if (!$auth->isLoggedIn()) {
    header('Location: login.php');
    exit;
}

$data = $_SESSION['data'] ?? [];
$errors = $_SESSION['errors'] ?? [];

unset($_SESSION['data']);
unset($_SESSION['errors']);

require_once 'templates/header.php';
require_once 'templates/add_post.php';
require_once 'templates/footer.php';