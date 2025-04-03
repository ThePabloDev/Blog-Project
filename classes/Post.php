<?php
class Post {
    private $db;
    private $id;
    private $title;
    private $content;
    private $image_path;
    private $created_at;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function setId($id) { $this->id = $id; }
    public function setTitle($title) { $this->title = $title; }
    public function setContent($content) { $this->content = $content; }
    public function setImagePath($image_path) { $this->image_path = $image_path; }

    public function getId() { return $this->id; }
    public function getTitle() { return $this->title; }
    public function getContent() { return $this->content; }
    public function getImagePath() { return $this->image_path; }
    public function getCreatedAt() { return $this->created_at; }

    public function save() {
        $query = "INSERT INTO posts (title, content, image_path, user_id) VALUES (:title, :content, :image_path, :user_id)";
        $stmt = $this->db->prepare($query);
    
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':content', $this->content);
        $stmt->bindParam(':image_path', $this->image_path);
        $stmt->bindParam(':user_id', $_SESSION['user_id']);
    
        return $stmt->execute();
    }

    public function getAll() {
        $query = "SELECT * FROM posts ORDER BY created_at DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id) {
        $query = "SELECT * FROM posts WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update() {
        $query = "UPDATE posts SET title = :title, content = :content, image_path = :image_path WHERE id = :id";
        $stmt = $this->db->prepare($query);

        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':content', $this->content);
        $stmt->bindParam(':image_path', $this->image_path);
        $stmt->bindParam(':id', $this->id);

        return $stmt->execute();
    }

    public function delete($id) {
        error_log("Método delete() chamado para ID: $id");

        try {
            $post = $this->find($id);
            if (!$post) {
                error_log("Post não encontrado no banco de dados");
                return false;
            }

            if (!empty($post['image_path'])) {
                $image_path = $post['image_path'];
                if (file_exists($image_path)) {
                    if (!unlink($image_path)) {
                        error_log("Falha ao deletar arquivo de imagem: $image_path");
                    } else {
                        error_log("Imagem deletada: $image_path");
                    }
                }
            }

            $query = "DELETE FROM posts WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            $result = $stmt->execute();
            error_log("Resultado da exclusão no banco: " . ($result ? 'Sucesso' : 'Falha'));

            return $result;
        } catch (PDOException $e) {
            error_log("Erro PDO ao deletar post: " . $e->getMessage());
            return false;
        }
    }
}