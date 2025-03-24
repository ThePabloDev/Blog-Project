<?php
require_once __DIR__ . '/classes/Database.php';
require_once __DIR__ . '/classes/Post.php';

error_log("Iniciando delete_post.php");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    $_SESSION['error_message'] = "ID inválido ou não fornecido.";
    error_log("ID inválido: " . ($_GET['id'] ?? 'Nenhum ID fornecido'));
    header("Location: index.php");
    exit;
}

$post_id = (int)$_GET['id'];
error_log("Tentando deletar post ID: $post_id");

try {
    $post = new Post();

    $post_data = $post->find($post_id);
    if (!$post_data) {
        $_SESSION['error_message'] = "Post não encontrado.";
        error_log("Post não encontrado para ID: $post_id");
        header("Location: index.php");
        exit;
    }

    if ($post->delete($post_id)) {
        $_SESSION['success_message'] = "Post deletado com sucesso!";
        error_log("Post ID $post_id deletado com sucesso");
    } else {
        $_SESSION['error_message'] = "Falha ao deletar o post.";
        error_log("Falha ao deletar post ID: $post_id");
    }
} catch (Exception $e) {
    $_SESSION['error_message'] = "Erro ao processar a requisição.";
    error_log("Erro ao deletar post: " . $e->getMessage());
}

header("Location: index.php");
exit;