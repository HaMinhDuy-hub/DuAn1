    <?php
    class Category
    {
        // Lấy tất cả danh mục
        public static function getAll()
        {
            $sql = "SELECT * FROM categories WHERE deleted_at IS NULL";
            return pdo_query($sql);
        }

        // Thêm danh mục mới
        public static function insert($name)
        {
            $sql = "INSERT INTO categories (name, created_at) VALUES (?, NOW())";
            pdo_execute($sql, $name);
        }

        // Xóa danh mục
        public static function delete($id)
        {
            $sql = "UPDATE categories SET deleted_at = NOW() WHERE id = ?";
            pdo_execute($sql, $id);
        }

        // Lấy thông tin danh mục theo ID
        public static function getOne($id)
        {
            $sql = "SELECT * FROM categories WHERE id = ? AND deleted_at IS NULL";
            return pdo_query_one($sql, $id);
        }
        // Cập nhập danh mục
        public static function update($id, $name)
{
    $sql = "UPDATE categories SET name = ? WHERE id = ? AND (deleted_at IS NULL OR deleted_at = '')";
    try {
        return pdo_execute($sql, $name, $id);
    } catch (PDOException $e) {
        // Ghi lại lỗi nếu có
        error_log($e->getMessage());
        throw new Exception('Lỗi khi cập nhật danh mục.');
    }
}
    // Khôi phục danh mục
    public static function restore($id)
    {
        $sql = "UPDATE categories SET deleted_at = NULL WHERE id = ?";
        return pdo_execute($sql, $id);
    }
    // Lấy danh sách các danh mục đã xóa mềm
    public static function getDeletedCategories()
    {
        $sql = "SELECT * FROM categories WHERE deleted_at IS NOT NULL";
        return pdo_query($sql);
    }
    public static function countCategories()
    {
        $sql = "SELECT COUNT(*) AS total FROM categories WHERE deleted_at IS NULL";
        $result = pdo_query_one($sql);
    
        // Kiểm tra kết quả
        if ($result) {
            return $result['total'];
        } else {
            return 0; // Trả về 0 nếu không có kết quả
        }
    }
 }
    ?>
