<?php
$file_path = __DIR__ . '/../../model/Category.php'; // Điều chỉnh đúng số cấp thư mục

if (!file_exists($file_path)) {
    die("Lỗi: Không tìm thấy tệp tại đường dẫn $file_path"); // Hiển thị đường dẫn chính xác để kiểm tra
}
if (isset($_SESSION['message'])) {
    echo "<p class='alert alert-success'>{$_SESSION['message']}</p>";
    // Xóa thông báo sau khi đã hiển thị
    unset($_SESSION['message']);
}
require_once $file_path;

$categories = Category::getAll();
?>

<div class="content-wrapper">
    <h2>Danh sách danh mục</h2>
    <a href="index.php?act=add_category" class="btn btn-primary mb-3">Thêm danh mục</a>
    <a href="index.php?act=archive_categories" class="btn btn-warning mb-3">Kho lưu trữ</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên danh mục</th>
                <th>Ngày tạo</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
        <?php $index = 1; ?>    
            <?php foreach ($categories as $category) : ?>
                <tr>
                <td><?= $index++ ?></td>
                    <td><?= htmlspecialchars($category['name']) ?></td>
                    <td><?= $category['created_at'] ?></td>
                    <td>
                        <a href="index.php?act=edit_category&id=<?= $category['id'] ?>" class="btn btn-warning">Sửa</a>
                        <a href="index.php?act=delete_category&id=<?= $category['id'] ?>" 
                           class="btn btn-danger" 
                           onclick="return confirm('Bạn có chắc muốn xóa danh mục này?')">Xóa</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php if (isset($message)) echo "<p class='alert alert-success'>$message</p>"; ?>
</div>
