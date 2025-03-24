<?php
class Validator {
    public static function validatePostData($data, $files = null) {
        $errors = [];

        if (empty($data['title'])) {
            $errors['title'] = 'O título é obrigatório.';
        } elseif (strlen($data['title']) > 255) {
            $errors['title'] = 'O título não pode ter mais de 255 caracteres.';
        }

        if (empty($data['content'])) {
            $errors['content'] = 'O conteúdo é obrigatório.';
        }

        if ($files && isset($files['image'])) {
            $image = $files['image'];

            if ($image['error'] === UPLOAD_ERR_OK) {
                $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
                $max_size = 2 * 1024 * 1024; // 2MB

                if (!in_array($image['type'], $allowed_types)) {
                    $errors['image'] = 'Apenas imagens JPEG, PNG ou GIF são permitidas.';
                }

                if ($image['size'] > $max_size) {
                    $errors['image'] = 'A imagem não pode ser maior que 2MB.';
                }

                $check = getimagesize($image['tmp_name']);
                if ($check === false) {
                    $errors['image'] = 'O arquivo não é uma imagem válida.';
                }
            } elseif ($image['error'] !== UPLOAD_ERR_NO_FILE) {
                $errors['image'] = 'Ocorreu um erro no upload da imagem. Código: ' . $image['error'];
            }
        }

        return $errors;
    }
}