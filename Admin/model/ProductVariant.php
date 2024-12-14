<?php
require_once 'pdo.php';

class ProductVariant
{
    // Thêm biến thể vào bảng product_variants
    public static function insert($product_id, $color_id, $size_id, $quantity)
    {
        // Kiểm tra xem biến thể đã tồn tại chưa
        $existingVariant = self::checkVariantExists($product_id, $color_id, $size_id);
        
        // Nếu đã tồn tại, không thêm
        if ($existingVariant) {
            return false;  // Biến thể đã tồn tại
        }

        // Chèn biến thể mới vào cơ sở dữ liệu
        $sql = "INSERT INTO product_variants (product_id, color_id, size_id, quantity) 
                VALUES (?, ?, ?, ?)";
        pdo_execute($sql, $product_id, $color_id, $size_id, $quantity);
        return true;  // Thành công
    }

    // Kiểm tra xem biến thể đã tồn tại hay chưa
    public static function checkVariantExists($product_id, $color_id, $size_id)
    {
        $sql = "SELECT * FROM product_variants WHERE product_id = ? AND color_id = ? AND size_id = ?";
        return pdo_query_one($sql, $product_id, $color_id, $size_id);
    }

    // Lấy tất cả các biến thể của sản phẩm theo product_id
    public static function getAllByProductId($product_id)
    {
        $sql = "SELECT pv.*, c.name AS color_name, s.name AS size_name
                FROM product_variants pv
                LEFT JOIN colors c ON pv.color_id = c.id
                LEFT JOIN sizes s ON pv.size_id = s.id
                WHERE pv.product_id = ?";
        return pdo_query($sql, $product_id);
    }

    // Xóa biến thể theo variant_id
    public static function delete($variant_id)
    {
        $sql = "DELETE FROM product_variants WHERE id = ?";
        pdo_execute($sql, $variant_id);
    }
}
?>
