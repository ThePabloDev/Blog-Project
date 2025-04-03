<div class="container mt-5">
    <h2>Editar Postagem</h2>
    
    <?php if (isset($_SESSION['errors'])): ?>
        <div class="alert alert-danger">
            <?php foreach ($_SESSION['errors'] as $error): ?>
                <p><?= $error ?></p>
            <?php endforeach; ?>
            <?php unset($_SESSION['errors']); ?>
        </div>
    <?php endif; ?>

    <form action="process_edit.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $post['id'] ?>">
        
        <div class="mb-3">
            <label class="form-label">Título</label>
            <input type="text" name="title" class="form-control" 
                   value="<?= htmlspecialchars($post['title'] ?? '') ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Conteúdo</label>
            <textarea name="content" class="form-control" rows="8" required><?= 
                htmlspecialchars($post['content'] ?? '') 
            ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Imagem Atual</label>
            <?php if (!empty($post['image_path'])): ?>
                <div>
                    <img src="<?= $post['image_path'] ?>" class="img-thumbnail mb-2" style="max-width: 300px;">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remove_image" id="remove_image">
                        <label class="form-check-label" for="remove_image">
                            Remover imagem atual
                        </label>
                    </div>
                </div>
            <?php else: ?>
                <p>Nenhuma imagem associada</p>
            <?php endif; ?>
            
            <label class="form-label mt-2">Nova Imagem (opcional)</label>
            <input type="file" name="image" class="form-control" accept="image/*">
            <div class="form-text">Formatos aceitos: JPG, PNG, GIF. Tamanho máximo: 2MB</div>
        </div>

        <div class="d-flex justify-content-between">
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        </div>
    </form>
</div>