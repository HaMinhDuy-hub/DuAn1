<?php
require_once 'pdo.php'; // Đảm bảo file pdo.php đã được kết nối với cơ sở dữ liệu

class Product
{
    // Lấy tất cả sản phẩm
    public static function getAll() {
        $sql = "SELECT p.id, p.name, p.price, p.created_at, p.product_image, c.name as category_name
                FROM products p
                LEFT JOIN categories c ON p.category_id = c.id
                WHERE p.deleted_at IS NULL";  // Đảm bảo chỉ lấy sản phẩm chưa xóa mềm
        return pdo_query($sql);
    }

    // Thêm sản phẩm mới
    public static function insert($category_id, $name, $price, $description, $product_image)
    {
        $sql = "INSERT INTO products (category_id, name, price, description, product_image, created_at) 
                VALUES (?, ?, ?, ?, ?, NOW())";
        pdo_execute($sql, $category_id, $name, $price, $description, $product_image); // Thêm sản phẩm mới
    }

    // Xóa sản phẩm (Xóa mềm)
    public static function delete($id)
    {
        $sql = "UPDATE products SET deleted_at = NOW() WHERE id = ?";
        pdo_execute($sql, $id); // Xóa sản phẩm bằng cách cập nhật trường deleted_at
    }

    // Lấy thông tin sản phẩm theo ID
    public static function getOne($id)
    {
        $sql = "SELECT * FROM products WHERE id = ? AND deleted_at IS NULL";
        return pdo_query_one($sql, $id); // Lấy thông tin sản phẩm theo ID, không bao gồm sản phẩm đã xóa
    }

    // Cập nhật thông tin sản phẩm
    public static function update($id, $category_id, $name, $price, $description, $product_image)
    {
        $sql = "UPDATE products SET category_id = ?, name = ?, price = ?, description = ?, product_image = ? 
                WHERE id = ? AND deleted_at IS NULL";
        try {
            return pdo_execute($sql, $category_id, $name, $price, $description, $product_image, $id); // Cập nhật thông tin sản phẩm
        } catch (PDOException $e) {
            // Ghi lại lỗi nếu có
            error_log($e->getMessage());
            throw new Exception('Lỗi khi cập nhật sản phẩm.');
        }
    }

    // Khôi phục sản phẩm đã xóa
    public static function restore($id)
    {
        $sql = "UPDATE products SET deleted_at = NULL WHERE id = ?";
        return pdo_execute($sql, $id); // Khôi phục sản phẩm đã bị xóa mềm
    }

    // Đếm tổng số sản phẩm chưa bị xóa
public static function countProducts()
{
    $sql = "SELECT COUNT(*) AS total FROM products WHERE deleted_at IS NULL";
    $result = pdo_query_one($sql); // Lấy kết quả từ cơ sở dữ liệu
    return isset($result['total']) ? $result['total'] : 0; // Trả về tổng số sản phẩm, mặc định là 0 nếu không có
}

    // Lấy sản phẩm theo danh mục
    public static function getByCategory($category_id)
    {
        $sql = "SELECT * FROM products WHERE category_id = ? AND deleted_at IS NULL";
        return pdo_query($sql, $category_id); // Lấy sản phẩm theo danh mục
    }

    // Lấy sản phẩm với phân trang
    public static function getAllWithPagination($limit, $offset)
    {
        $sql = "SELECT * FROM products WHERE deleted_at IS NULL LIMIT ? OFFSET ?";
        return pdo_query($sql, $limit, $offset); // Lấy sản phẩm với phân trang
    }
    public static function getProductDetails($product_id) {
        // Lấy thông tin sản phẩm từ bảng product_variants, bao gồm màu sắc và cỡ
        $sql = "SELECT pv.id, p.name AS product_name, c.name AS color_name, s.name AS size_name, pv.quantity
                FROM product_variants pv
                JOIN products p ON pv.product_id = p.id
                LEFT JOIN colors c ON pv.color_id = c.id
                LEFT JOIN sizes s ON pv.size_id = s.id
                WHERE pv.product_id = ? AND pv.deleted_at IS NULL";

        return pdo_query($sql, $product_id); // Trả về danh sách các variant của sản phẩm
    }
    public static function getById($id)
    {
        $sql = "SELECT * FROM products WHERE id = ?";
        return pdo_query_one($sql, $id);
    }
    // Phương thức lấy sản phẩm đã xóa mềm
    public static function getArchivedProducts()
{
    $sql = "SELECT p.id, p.name, p.price, p.created_at, p.deleted_at, c.name AS category_name
            FROM products p
            LEFT JOIN categories c ON p.category_id = c.id
            WHERE p.deleted_at IS NOT NULL";
    return pdo_query($sql); // Trả về danh sách sản phẩm đã xóa mềm kèm tên danh mục
}
// Xóa vĩnh viễn

}
?>
