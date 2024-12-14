<?php
$file_path = __DIR__ . '/../../model/Product.php'; // Điều chỉnh đúng số cấp thư mục
include_once $file_path; // Bao gồm file Product.php

// Lấy thông tin sản phẩm theo ID
$id = isset($_GET['id']) ? $_GET['id'] : null;
$product = Product::getOne($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ form
    $name = $_POST['name'];
    $category_id = $_POST['category_id'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $product_image = $_FILES['product_image']['name'];

    // Kiểm tra nếu có hình ảnh mới
    if (!empty($product_image)) {
        $target_dir = "uploads/"; // Đường dẫn thư mục lưu trữ ảnh
        $target_file = $target_dir . basename($product_image);
        move_uploaded_file($_FILES['product_image']['tmp_name'], $target_file); // Upload file ảnh
    } else {
        // Giữ nguyên ảnh cũ nếu không có ảnh mới
        $product_image = $product['product_image'];
    }

    // Kiểm tra thông tin hợp lệ và cập nhật
    if (!empty($name) && !empty($category_id) && !empty($price)) {
        Product::update($id, $category_id, $name, $price, $description, $product_image);
        $message = "Cập nhật sản phẩm thành công!";
        header('Location: index.php?act=list_products');
        exit;
    } else {
        $message = "Vui lòng điền đầy đủ thông tin sản phẩm!";
    }
}
?>

<div class="content-wrapper">
    <h2>Sửa sản phẩm</h2>
    <form action="index.php?act=update_product&id=<?= $id ?>" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Tên sản phẩm:</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= $product['name'] ?>" required>
        </div>
        <div class="form-group">
            <label for="category_id">Danh mục:</label>
            <select class="form-control" id="category_id" name="category_id" required>
                <!-- Lấy danh sách danh mục -->
                <?php
                $categories = Category::getAll(); // Giả sử bạn đã có phương thức getAll() trong Category model
                foreach ($categories as $category) {
                    $selected = ($category['id'] == $product['category_id']) ? 'selected' : '';
                    echo "<option value='{$category['id']}' $selected>{$category['name']}</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="price">Giá:</label>
            <input type="number" class="form-control" id="price" name="price" value="<?= $product['price'] ?>" required>
        </div>
        <div class="form-group">
            <label for="description">Mô tả:</label>
            <textarea class="form-control" id="description" name="description" rows="4"><?= $product['description'] ?></textarea>
        </div>
        <div class="form-group">
            <label for="product_image">Hình ảnh sản phẩm:</label>
            <input type="file" class="form-control" id="product_image" name="product_image">
            <img src="/Duan1_team10-main/upload/<?= $product['product_image'] ?>" alt="Product Image" width="100">
        </div>
        <input type="hidden" name="id" value="<?= $product['id'] ?>">
        <button type="submit" name="update" class="btn btn-primary">Cập nhật</button>
        <a href="index.php?act=list_products" class="btn btn-secondary">Danh sách sản phẩm</a>
    </form>

    <?php if (isset($message)) echo "<p class='alert alert-success'>$message</p>"; ?>
</div>
