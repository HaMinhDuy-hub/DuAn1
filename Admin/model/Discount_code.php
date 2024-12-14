<?php

require_once 'pdo.php'; // Gọi file kết nối cơ sở dữ liệu

class DiscountCode {
    // Lấy danh sách tất cả mã giảm giá (không bị xóa mềm)
    public static function getAll() {
        $sql = "SELECT * FROM discount_codes WHERE deleted_at IS NULL";
        return pdo_query($sql);
    }

    // Lấy một mã giảm giá theo ID
    public static function getOne($id) {
        $sql = "SELECT * FROM discount_codes WHERE id = ? AND deleted_at IS NULL";
        return pdo_query_one($sql, $id);
    }

    // Thêm một mã giảm giá mới
    public static function add($code, $discount_percent, $start_date, $expiry_date) {
        $sql = "
            INSERT INTO discount_codes (code, discount_percent, start_date, expiry_date)
            VALUES (?, ?, ?, ?)
        ";
        pdo_execute($sql, $code, $discount_percent, $start_date, $expiry_date);
    }

    // Xóa mềm một mã giảm giá
    public static function softDelete($id) {
        $sql = "UPDATE discount_codes SET deleted_at = NOW() WHERE id = ?";
        pdo_execute($sql, $id);
    }

    // Cập nhật thông tin mã giảm giá
    public static function update($id, $code, $discount_percent, $start_date, $expiry_date) {
        $sql = "
            UPDATE discount_codes 
            SET code = ?, discount_percent = ?, start_date = ?, expiry_date = ?
            WHERE id = ?
        ";
        pdo_execute($sql, $code, $discount_percent, $start_date, $expiry_date, $id);
    }

    // Lưu trữ một mã giảm giá (đặt trạng thái is_active = 0)
    public static function archive($id) {
        $sql = "UPDATE discount_codes WHERE id = ? AND deleted_at IS NOT NULL";
        pdo_execute($sql, $id);
    }

    // Khôi phục một mã giảm giá (xóa deleted_at)
    public static function restore($id) {
        $sql = "UPDATE discount_codes SET is_active = 1, deleted_at = NULL WHERE id = ?";
        pdo_execute($sql, $id);  // Đảm bảo pdo_execute truyền tham số đúng cách
    }
    public static function getByActiveStatus($is_active)
{
    $sql = "SELECT * FROM discount_codes WHERE is_active = ?";
    return pdo_query($sql, $is_active);
}
    public static function updateStatus($id, $is_active)
{
    $sql = "UPDATE discount_codes SET is_active = ? WHERE id = ?";
    pdo_execute($sql, $is_active, $id);
}
public static function toggleStatus($id, $status)
{
    $sql = "UPDATE discount_codes SET is_active = ? WHERE id = ?";
    pdo_execute($sql, $status, $id);
}
public static function getArchivedDiscountCodes() {
    $sql = "SELECT * FROM discount_codes WHERE deleted_at IS NOT NULL";
    return pdo_query($sql); // Giả sử pdo_query là hàm trả về kết quả truy vấn
}

}
?>
