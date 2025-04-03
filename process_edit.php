<?php
require_once 'init.php';

if (!$auth->isLoggedIn()) {
    $_SESSION['error_message'] = 'Você precisa estar logado para editar posts';
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post_id = (int)$_POST['id'];
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    
    // Validação dos dados
    $errors = Validator::validatePostData($_POST, $_FILES);
    
    if (empty($errors)) {
        $post = new Post();
        $current_post = $post->find($post_id);
        
        // Verifica se o post existe e pertence ao usuário
        if (!$current_post || $current_post['user_id'] != $_SESSION['user_id']) {
            $_SESSION['error_message'] = 'Post não encontrado ou você não tem permissão para editá-lo';
            header('Location: index.php');
            exit;
        }
        
        $image_path = null;
        $upload_dir = 'uploads/';
        
        // Lógica para remover imagem existente
        if (!empty($_POST['remove_image']) && !empty($current_post['image_path'])) {
            if (file_exists($current_post['image_path'])) {
                unlink($current_post['image_path']);
            }
            $image_path = ''; // String vazia para remover no banco
        }
        // Lógica para upload de nova imagem
        elseif (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }
            
            $file_extension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
            $file_name = uniqid() . '.' . $file_extension;
            $file_path = $upload_dir . $file_name;
            
            if (move_uploaded_file($_FILES['image']['tmp_name'], $file_path)) {
                // Remove a imagem antiga se existir
                if (!empty($current_post['image_path']) && file_exists($current_post['image_path'])) {
                    unlink($current_post['image_path']);
                }
                $image_path = $file_path;
            }
        }
        
        // Atualiza o post
        if ($post->update($post_id, $title, $content, $image_path)) {
            $_SESSION['success_message'] = 'Post atualizado com sucesso!';
            header('Location: index.php');
            exit;
        } else {
            $_SESSION['error_message'] = 'Erro ao atualizar o post';
        }
    } else {
        $_SESSION['errors'] = $errors;
        $_SESSION['form_data'] = [
            'title' => $title,
            'content' => $content
        ];
        header("Location: edit_post.php?id=$post_id");
        exit;
    }
}

header('Location: index.php');
exit;