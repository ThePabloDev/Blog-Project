<?php
require_once __DIR__ . '/../init.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Maneiro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        .navbar {
            margin-bottom: 30px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .user-greeting {
            color: #555;
            margin-right: 15px;
            font-weight: 500;
        }
    </style>
</head>
<body>
<div class="container">
    <header>
        <h1 class="text-center my-4">Blog Maneiro</h1>
        <nav class="navbar navbar-expand-lg navbar-light bg-light rounded">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">
                    <i class="bi bi-house-door"></i> Home
                </a>
                
                <div class="d-flex align-items-center">
                    <?php if ($auth->isLoggedIn()): ?>
                        <span class="user-greeting">
                            <i class="bi bi-person-circle"></i> Olá, <?= htmlspecialchars($user['name']) ?>
                        </span>
                        <a href="add_post.php" class="btn btn-success btn-sm me-2">
                            <i class="bi bi-plus-circle"></i> Novo Post
                        </a>
                        <a href="logout.php" class="btn btn-outline-danger btn-sm">
                            <i class="bi bi-box-arrow-right"></i> Sair
                        </a>
                    <?php else: ?>
                        <a href="login.php" class="btn btn-outline-primary me-2">
                            <i class="bi bi-box-arrow-in-right"></i> Login
                        </a>
                        <a href="register.php" class="btn btn-primary">
                            <i class="bi bi-person-plus"></i> Cadastrar
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
    </header>
    <main>