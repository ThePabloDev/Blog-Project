<?php
class Validator {

    public static function validateRegisterData($data) {
        $errors = [];

        if (empty($data['name'])) {
            $errors['name'] = 'O nome é obrigatório.';
        } elseif (strlen($data['name']) > 100) {
            $errors['name'] = 'O nome não pode ter mais de 100 caracteres.';
        }

        if (empty($data['email'])) {
            $errors['email'] = 'O email é obrigatório.';
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'O email não é válido.';
        } elseif (strlen($data['email']) > 100) {
            $errors['email'] = 'O email não pode ter mais de 100 caracteres.';
        }

        if (empty($data['password'])) {
            $errors['password'] = 'A senha é obrigatória.';
        } elseif (strlen($data['password']) < 6) {
            $errors['password'] = 'A senha deve ter pelo menos 6 caracteres.';
        }

        if ($data['password'] !== $data['confirm_password']) {
            $errors['confirm_password'] = 'As senhas não coincidem.';
        }

        return $errors;
    }


    public static function validateLoginData($data) {
        $errors = [];

        if (empty($data['email'])) {
            $errors['email'] = 'O email é obrigatório.';
        }

        if (empty($data['password'])) {
            $errors['password'] = 'A senha é obrigatória.';
        }

        return $errors;
    }

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