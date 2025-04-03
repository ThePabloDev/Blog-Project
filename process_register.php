<?php
require_once __DIR__ . '/init.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;
    $errors = Validator::validateRegisterData($data);

    if (empty($errors)) {
        if ($auth->register($data['name'], $data['email'], $data['password'])) {
            $_SESSION['success_message'] = 'Cadastro realizado com sucesso! Faça login para continuar.';
            header('Location: login.php');
            exit;
        } else {
            $_SESSION['errors'] = ['Ocorreu um erro ao cadastrar. O email já pode estar em uso.'];
        }
    } else {
        $_SESSION['errors'] = $errors;
        $_SESSION['form_data'] = $data;
    }
}

header('Location: register.php');
exit;