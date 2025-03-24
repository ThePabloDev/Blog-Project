<?php
require_once 'classes/Database.php';
require_once 'classes/Post.php';
require_once 'classes/Validator.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;
    $errors = Validator::validatePostData($data, $_FILES);

    if (empty($errors)) {
        $post = new Post();
        $post->setTitle($data['title']);
        $post->setContent($data['content']);

        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $upload_dir = 'uploads/';

            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }

            $file_extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $file_name = uniqid() . '.' . strtolower($file_extension);
            $file_path = $upload_dir . $file_name;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $file_path)) {
                $post->setImagePath($file_path);
            }
        }

        if ($post->save()) {
            header('Location: index.php?success=1');
            exit;
        } else {
            $_SESSION['errors'] = ['Ocorreu um erro ao salvar a postagem.'];
            $_SESSION['data'] = $data;
            header('Location: add_post.php');
            exit;
        }
    } else {
        $_SESSION['errors'] = $errors;
        $_SESSION['data'] = $data;
        header('Location: add_post.php');
        exit;
    }
} else {
    header('Location: index.php');
    exit;
}