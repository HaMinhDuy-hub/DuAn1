<?php
require_once 'pdo.php';

class User
{
    // Lấy tất cả người dùng
    public static function getAll()
{
    $sql = "SELECT users.*, roles.name AS role_name 
            FROM users 
            JOIN roles ON users.role_id = roles.id 
            WHERE users.deleted_at IS NULL";
    return pdo_query($sql); // Chỉ lấy tài khoản chưa bị xóa
}

    // Lấy thông tin người dùng theo ID
    public static function getOne($id)
    {
        $sql = "SELECT * FROM users WHERE id = ? AND deleted_at IS NULL";
        return pdo_query_one($sql, $id);
    }

    // Thêm người dùng mới
    public static function add($role_id, $fullname, $username, $email, $password, $avatar = null)
    {
        $sql = "INSERT INTO users (role_id, fullname, username, email, password, avatar, created_at) 
                VALUES (?, ?, ?, ?, ?, ?, NOW())";
        return pdo_execute($sql, $role_id, $fullname, $username, $email, $password, $avatar);
    }

    // Cập nhật thông tin người dùng
    public static function update($id, $role_id, $fullname, $username, $email, $avatar, $is_active)
    {
        $sql = "UPDATE users 
                SET role_id = ?, fullname = ?, username = ?, email = ?, avatar = ?, is_active = ?, updated_at = NOW() 
                WHERE id = ? AND deleted_at IS NULL";
        return pdo_execute($sql, $role_id, $fullname, $username, $email, $avatar, $is_active, $id);
    }
    // Xóa mềm
    public static function softDelete($id)
{
    $sql = "UPDATE users SET deleted_at = NOW() WHERE id = ? AND deleted_at IS NULL";
    return pdo_execute($sql, $id); // Đánh dấu xóa mềm
}

// Khôi phục tài khoản
public static function restore($id)
{
    $sql = "UPDATE users SET deleted_at = NULL WHERE id = ?";
    return pdo_execute($sql, $id); // Khôi phục tài khoản
}

// Lấy danh sách tài khoản đã bị xóa
public static function getArchived()
{
    $sql = "SELECT users.*, roles.name AS role_name 
            FROM users 
            JOIN roles ON users.role_id = roles.id 
            WHERE users.deleted_at IS NOT NULL";
    return pdo_query($sql); // Lấy tài khoản đã bị xóa
}

    // kích hoạt
    public static function toggleActive($id, $status)
{
    $sql = "UPDATE users SET is_active = ? WHERE id = ?";
    try {
        return pdo_execute($sql, $status, $id);
    } catch (PDOException $e) {
        error_log($e->getMessage());
        throw new Exception('Không thể thay đổi trạng thái tài khoản.');
    }
}
// Đếm số người dùng chưa bị xóa
public static function countUsers()
{
    $sql = "SELECT COUNT(*) AS total FROM users WHERE deleted_at IS NULL";
    $result = pdo_query_one($sql); // Lấy kết quả từ cơ sở dữ liệu
    return isset($result['total']) ? $result['total'] : 0; // Trả về tổng số sản phẩm, mặc định là 0 nếu không có
}
}
