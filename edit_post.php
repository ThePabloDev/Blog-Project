<?php
require_once 'init.php';

if (!$auth->isLoggedIn()) {
    $_SESSION['error_message'] = 'Você precisa estar logado para editar posts';
    header('Location: login.php');
    exit;
}

$post_id = $_GET['id'] ?? 0;
$post = (new Post())->find($post_id);

if (!$post || $post['user_id'] != $_SESSION['user_id']) {
    $_SESSION['error_message'] = 'Post não encontrado ou você não tem permissão para editá-lo';
    header('Location: index.php');
    exit;
}

if (isset($_SESSION['form_data'])) {
    $post = array_merge($post, $_SESSION['form_data']);
    unset($_SESSION['form_data']);
}

require_once 'templates/header.php';
require_once 'templates/edit_post.php';
require_once 'templates/footer.php';