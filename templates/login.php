<?php require_once 'header.php'; ?>

<div class="container mt-5">
    <h2>Login</h2>
    <?php if (isset($_SESSION['login_error'])): ?>
        <div class="alert alert-danger">
            <?php echo $_SESSION['login_error']; ?>
        </div>
        <?php unset($_SESSION['login_error']); ?>
    <?php endif; ?>

    <form action="process_login.php" method="POST">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Senha:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Entrar</button>
    </form>
    <p class="mt-3">Não tem uma conta? <a href="register.php">Cadastre-se</a></p>
</div>

<?php require_once 'footer.php'; ?>