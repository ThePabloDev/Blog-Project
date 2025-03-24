<section class="add-post">
    <h2>Adicionar Nova Postagem</h2>

    <?php if (!empty($errors)): ?>
        <div class="errors">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="process_post.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Título:</label>
            <input type="text" id="title" name="title" value="<?= htmlspecialchars($data['title'] ?? '') ?>">
            <?php if (isset($errors['title'])): ?>
                <span class="error"><?= $errors['title'] ?></span>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="content">Conteúdo:</label>
            <textarea id="content" name="content" rows="5"><?= htmlspecialchars($data['content'] ?? '') ?></textarea>
            <?php if (isset($errors['content'])): ?>
                <span class="error"><?= $errors['content'] ?></span>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="image">Imagem da Postagem (opcional):</label>
            <input type="file" id="image" name="image" accept="image/*">
            <?php if (isset($errors['image'])): ?>
                <span class="error"><?= $errors['image'] ?></span>
            <?php endif; ?>
            <p class="hint">Formatos aceitos: JPEG, PNG, GIF (até 2MB)</p>
        </div>

        <button type="submit">Salvar Postagem</button>
    </form>
</section>