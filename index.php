<?php
require_once 'init.php';

if (!$auth->isLoggedIn()) {
    header('Location: login.php');
    exit;
}

if (isset($_SESSION['success_message'])) {
    echo '<div class="alert alert-success">' . $_SESSION['success_message'] . '</div>';
    unset($_SESSION['success_message']);
}

if (isset($_SESSION['error_message'])) {
    echo '<div class="alert alert-danger">' . $_SESSION['error_message'] . '</div>';
    unset($_SESSION['error_message']);
}

$post = new Post();
$posts = $post->getAll();

require_once 'templates/header.php';
require_once 'templates/list_posts.php';
require_once 'templates/footer.php';