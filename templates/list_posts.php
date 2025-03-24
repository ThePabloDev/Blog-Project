<section class="posts">
    <h2>Últimas Postagens</h2>

    <?php if (!empty($_GET['success'])): ?>
        <div class="success-message">
            Postagem criada com sucesso!
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['success_message'])): ?>
        <div class="alert alert-success">
            <?= $_SESSION['success_message'] ?>
        </div>
        <?php unset($_SESSION['success_message']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['error_message'])): ?>
        <div class="alert alert-error">
            <?= $_SESSION['error_message'] ?>
        </div>
        <?php unset($_SESSION['error_message']); ?>
    <?php endif; ?>

    <?php if (empty($posts)): ?>
        <p>Nenhuma postagem encontrada.</p>
    <?php else: ?>
        <?php foreach ($posts as $post): ?>
            <article class="post">
                <h3><?= htmlspecialchars($post['title']) ?></h3>
                <p class="date"><?= date('d/m/Y H:i', strtotime($post['created_at'])) ?></p>
                <?php if (!empty($post['image_path'])): ?>
                    <div class="post-image">
                        <img src="<?= $post['image_path'] ?>" alt="<?= htmlspecialchars($post['title']) ?>">
                    </div>
                <?php endif; ?>
                <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>

                <form action="delete_post.php" method="GET" class="delete-form">
                    <input type="hidden" name="id" value="<?= $post['id'] ?>">
                    <button type="submit" class="delete-btn" onclick="return confirm('Tem certeza que deseja deletar este post?')">Deletar</button>
                </form>
            </article>
        <?php endforeach; ?>
    <?php endif; ?>
</section>