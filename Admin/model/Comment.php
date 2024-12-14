<?php
require_once 'pdo.php';

class Comment
{
    // Lấy tất cả bình luận
public static function getAll()
{
    $sql = "
        SELECT c.id, c.content, c.created_at, u.fullname AS user_name, p.name AS product_name
        FROM comments c
        LEFT JOIN users u ON c.user_id = u.id
        LEFT JOIN products p ON c.product_id = p.id
        WHERE c.deleted_at IS NULL
    ";
    return pdo_query($sql);
}

// Lấy bình luận đã bị xóa mềm (archive)
public static function getArchived()
{
    $sql = "
        SELECT c.id, c.content, c.created_at, c.deleted_at, u.fullname AS user_name, p.name AS product_name
        FROM comments c
        LEFT JOIN users u ON c.user_id = u.id
        LEFT JOIN products p ON c.product_id = p.id
        WHERE c.deleted_at IS NOT NULL
    ";
    return pdo_query($sql);
}

    // Xóa mềm bình luận
    public static function softDelete($id)
    {
        $sql = "UPDATE comments SET deleted_at = NOW() WHERE id = ?";
        return pdo_execute($sql, $id);
    }

    // Khôi phục bình luận đã bị xóa mềm
    public static function restore($id)
    {
        $sql = "UPDATE comments SET deleted_at = NULL WHERE id = ?";
        return pdo_execute($sql, $id);
    }
    // Đếm số bình luận chưa bị xóa
    public static function countComments()
{
    $sql = "SELECT COUNT(*) AS total FROM comments WHERE deleted_at IS NULL";
    $result = pdo_query_one($sql); // Lấy kết quả từ cơ sở dữ liệu
    return isset($result['total']) ? $result['total'] : 0; // Trả về tổng số sản phẩm, mặc định là 0 nếu không có
}
}
?>
