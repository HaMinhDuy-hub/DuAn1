<?php
$file_path = __DIR__ . '/../../model/Category.php'; // Điều chỉnh đúng số cấp thư mục

$id = isset($_GET['id']) ? $_GET['id'] : null;
if ($id) {
    Category::delete($id); // Soft delete
    $message = "Xóa danh mục thành công!";
}
header('Location: index.php?action=list_categories');
exit;
?>
