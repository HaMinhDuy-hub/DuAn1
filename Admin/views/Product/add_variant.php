<?php
$file_path = __DIR__ . '/../../model/ProductVariant.php';
$color_path = __DIR__ . '/../../model/Color.php';
$size_path = __DIR__ . '/../../model/Size.php';

if (!file_exists($file_path) || !file_exists($color_path) || !file_exists($size_path)) {
    die("Lỗi: Không tìm thấy tệp cần thiết.");
}

require_once $file_path;
require_once $color_path;
require_once $size_path;

$colors = Color::getAll();
$sizes = Size::getAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'];
    $color_id = $_POST['color_id'];
    $size_id = $_POST['size_id'];
    $quantity = $_POST['quantity'];

    if (!empty($product_id) && !empty($color_id) && !empty($size_id) && !empty($quantity)) {
        ProductVariant::insert($product_id, $color_id, $size_id, $quantity);
        $message = "Thêm biến thể thành công!";
    } else {
        $message = "Vui lòng điền đầy đủ thông tin!";
    }
}
?>

<div class="content-wrapper">
    <h2>Thêm biến thể</h2>
    <?php if (!empty($message)) echo "<p class='alert alert-success'>$message</p>"; ?>
    <form action="index.php?act=add_variant&product_id=<?= $_GET['product_id'] ?>" method="POST">
        <input type="hidden" name="product_id" value="<?= $_GET['product_id'] ?>">
        <div class="form-group">
            <label for="color_id">Màu sắc:</label>
            <select class="form-control" id="color_id" name="color_id" required>
                <option value="">Chọn màu</option>
                <?php foreach ($colors as $color) : ?>
                    <option value="<?= $color['id'] ?>"><?= htmlspecialchars($color['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="size_id">Kích cỡ:</label>
            <select class="form-control" id="size_id" name="size_id" required>
                <option value="">Chọn kích cỡ</option>
                <?php foreach ($sizes as $size) : ?>
                    <option value="<?= $size['id'] ?>"><?= htmlspecialchars($size['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="quantity">Số lượng:</label>
            <input type="number" class="form-control" id="quantity" name="quantity" required>
        </div>
        <button type="submit" class="btn btn-primary">Thêm biến thể</button>
        <a href="index.php?act=view_product_details&id=<?= $_GET['product_id'] ?>" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
