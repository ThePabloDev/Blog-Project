<?php
require_once 'classes/Database.php';
require_once 'classes/Post.php';
require_once 'classes/Validator.php';
require_once 'templates/header.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$data = $_SESSION['data'] ?? [];
$errors = $_SESSION['errors'] ?? [];

unset($_SESSION['data']);
unset($_SESSION['errors']);

require_once 'templates/add_post.php';
require_once 'templates/footer.php';