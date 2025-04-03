<?php
require_once __DIR__ . '/init.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;
    $errors = Validator::validateLoginData($data);

    if (empty($errors)) {
        if ($auth->login($data['email'], $data['password'])) {
            $_SESSION['success_message'] = 'Login realizado com sucesso!';
            header('Location: index.php');
            exit;
        } else {
            $_SESSION['login_error'] = 'Email ou senha incorretos.';
        }
    } else {
        $_SESSION['errors'] = $errors;
    }
}

header('Location: login.php');
exit;