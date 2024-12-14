<?php
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Lấy chi tiết sản phẩm từ phương thức trong model
    $productVariants = Product::getProductDetails($product_id);

    if (!$productVariants) {
        echo "<p>Sản phẩm không tồn tại hoặc đã bị xóa.</p>";
        exit;
    }
}
?>

<div class="content-wrapper">
    <h2>Chi tiết sản phẩm</h2>
    <p><strong>ID:</strong> <?= $product['id'] ?></p>
    <p><strong>Tên sản phẩm:</strong> <?= htmlspecialchars($product['name']) ?></p>
    
    <!-- Hiển thị danh sách kích cỡ -->
    <p><strong>Kích cỡ:</strong>
        <?php foreach ($productVariants as $variant) : ?>
            <span class="badge badge-secondary"><?= htmlspecialchars($variant['size_name']) ?></span>
        <?php endforeach; ?>
    </p>

    <!-- Hiển thị số lượng cho từng biến thể -->
    <p><strong>Số lượng:</strong>
        <?php foreach ($productVariants as $variant) : ?>
            <br><strong>Kích cỡ <?= htmlspecialchars($variant['size_name']) ?>:</strong> <?= $variant['quantity'] ?>
            <!-- Thêm nút xóa biến thể -->
            <a href="index.php?act=delete_variant&id=<?= $variant['id'] ?>&product_id=<?= $product['id'] ?>" class="btn btn-danger d-inline-block mr-2" onclick="return confirm('Bạn có chắc chắn muốn xóa biến thể này?');">Xóa</a>
        <?php endforeach; ?>
    </p>

    <a href="index.php?act=add_variant&product_id=<?= $product['id'] ?>" class="btn btn-success">Thêm biến thể</a>
    <a href="index.php?act=list_product" class="btn btn-secondary">Quay lại danh sách</a>
</div>



