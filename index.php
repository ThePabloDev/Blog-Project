<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/classes/Database.php';
require_once __DIR__ . '/classes/Post.php';
require_once __DIR__ . '/templates/header.php';

if (isset($_SESSION['success_message'])) {
    echo '<div class="alert alert-success">' . $_SESSION['success_message'] . '</div>';
    unset($_SESSION['success_message']);
}

if (isset($_SESSION['error_message'])) {
    echo '<div class="alert alert-error">' . $_SESSION['error_message'] . '</div>';
    unset($_SESSION['error_message']);
}

$post = new Post();
$posts = $post->getAll();

require_once __DIR__ . '/templates/list_posts.php';
require_once __DIR__ . '/templates/footer.php';