<?php
$file_path = __DIR__ . '/../../model/Product.php'; // Điều chỉnh đúng số cấp thư mục

if (!file_exists($file_path)) {
    die("Lỗi: Không tìm thấy tệp tại đường dẫn $file_path"); // Hiển thị đường dẫn chính xác để kiểm tra
}
if (isset($_SESSION['message'])) {
    echo "<p class='alert alert-success'>{$_SESSION['message']}</p>";
    // Xóa thông báo sau khi đã hiển thị
    unset($_SESSION['message']);
}
require_once $file_path;

$products = Product::getAll(); // Lấy tất cả sản phẩm
?>

<div class="content-wrapper">
    <h2>Danh sách sản phẩm</h2>
    <a href="index.php?act=add_product" class="btn btn-primary mb-3">Thêm sản phẩm</a>
    <a href="index.php?act=archive_products" class="btn btn-warning mb-3">Kho lưu trữ</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên sản phẩm</th>
                <th>Danh mục</th>
                <th>Giá</th>
                <th>Ngày tạo</th>
                <th>Ảnh sản phẩm</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
        <?php $index = 1; ?> 
            <?php foreach ($products as $product) : ?>
                <tr>
                <td><?= $index++ ?></td>
                    <td><?= htmlspecialchars($product['name']) ?></td>
                    <td><?= htmlspecialchars($product['category_name']) ?></td> <!-- Hiển thị tên danh mục -->
                    <td><?= number_format($product['price'], 0, ',', '.') ?> VND</td> <!-- Hiển thị giá sản phẩm -->
                    <td><?= $product['created_at'] ?></td>
                    <td>
                        <?php if ($product['product_image']) : ?>
                            <img src="/Duan1_team10-main/upload/<?= htmlspecialchars($product['product_image']) ?>" alt="Ảnh sản phẩm" width="50">
                        <?php else: ?>
                            <p>Không có ảnh</p>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="index.php?act=edit_product&id=<?= $product['id'] ?>" class="btn btn-warning">Sửa</a>
                        <a href="index.php?act=delete_product&id=<?= $product['id'] ?>" 
                           class="btn btn-danger" 
                           onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')">Xóa</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php if (isset($message)) echo "<p class='alert alert-success'>$message</p>"; ?>
</div>
