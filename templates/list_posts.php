<section class="posts">
    <h2>Últimas Postagens</h2>

    <?php if (!empty($_GET['success'])): ?>
        <div class="alert alert-success">
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
        <div class="alert alert-danger">
            <?= $_SESSION['error_message'] ?>
        </div>
        <?php unset($_SESSION['error_message']); ?>
    <?php endif; ?>

    <?php if (empty($posts)): ?>
        <p>Nenhuma postagem encontrada.</p>
    <?php else: ?>
        <?php foreach ($posts as $post): ?>
            <article class="post card mb-4">
                <div class="card-body">
                    <h3 class="card-title"><?= htmlspecialchars($post['title']) ?></h3>
                    <p class="text-muted small">
                        Postado em <?= date('d/m/Y H:i', strtotime($post['created_at'])) ?>
                        <?php if ($post['created_at'] != $post['updated_at']): ?>
                            <br>Atualizado em <?= date('d/m/Y H:i', strtotime($post['updated_at'])) ?>
                        <?php endif; ?>
                    </p>
                    
                    <?php if (!empty($post['image_path'])): ?>
                        <div class="post-image mb-3">
                            <img src="<?= $post['image_path'] ?>" class="img-fluid rounded" alt="<?= htmlspecialchars($post['title']) ?>">
                        </div>
                    <?php endif; ?>
                    
                    <div class="card-text">
                        <?= nl2br(htmlspecialchars($post['content'])) ?>
                    </div>

                    <?php if ($auth->isLoggedIn() && $post['user_id'] == $_SESSION['user_id']): ?>
                        <div class="mt-3 d-flex justify-content-end gap-2">
                            <a href="edit_post.php?id=<?= $post['id'] ?>" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil"></i> Editar
                            </a>
                            
                            <form action="delete_post.php" method="GET" class="d-inline">
                                <input type="hidden" name="id" value="<?= $post['id'] ?>">
                                <button type="submit" class="btn btn-danger btn-sm" 
                                        onclick="return confirm('Tem certeza que deseja deletar este post?')">
                                    <i class="bi bi-trash"></i> Deletar
                                </button>
                            </form>
                        </div>
                    <?php endif; ?>
                </div>
            </article>
        <?php endforeach; ?>
    <?php endif; ?>
</section>