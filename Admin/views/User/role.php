<?php
require_once '../model/pdo.php';

class Role {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Hàm lấy vai trò của người dùng
    public function getUserRole($userId) {
        $stmt = $this->db->prepare("SELECT roles.name FROM roles JOIN users ON roles.id = users.role_id WHERE users.id = :userId");
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    // Hàm kiểm tra quyền truy cập
    public function hasPermission($userId, $permission) {
        // Kiểm tra quyền dựa trên vai trò
    }
}
?>
