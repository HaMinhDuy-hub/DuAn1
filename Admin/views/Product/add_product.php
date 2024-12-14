<?php
$file_path = __DIR__ . '/../../model/Product.php';
$category_file_path = __DIR__ . '/../../model/Category.php';

if (!file_exists($file_path) || !file_exists($category_file_path)) {
    die("Lỗi: Không tìm thấy tệp cần thiết để thực hiện thao tác.");
}

require_once $file_path;
require_once $category_file_path;

// Lấy danh sách danh mục để hiển thị trong dropdown
$categories = Category::getAll();

$message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    // Xử lý ảnh tải lên
    if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] == UPLOAD_ERR_OK) {
        $image_tmp = $_FILES['product_image']['tmp_name'];
        $image_name = uniqid() . '_' . $_FILES['product_image']['name'];
        $upload_dir = __DIR__ . '/../../../upload/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true); // Tạo thư mục nếu chưa tồn tại
        }
        $upload_path = $upload_dir . $image_name;
        move_uploaded_file($image_tmp, $upload_path); // Di chuyển file ảnh tới thư mục uploads
    } else {
        $image_name = null;
    }

    // Kiểm tra dữ liệu và thêm sản phẩm
    if (!empty($category_id) && !empty($name) && !empty($price) && !empty($description) && $image_name) {
        Product::insert($category_id, $name, $price, $description, $image_name);
        $message = "Thêm sản phẩm thành công!";
    } else {
        $message = "Vui lòng điền đầy đủ thông tin và tải ảnh sản phẩm!";
    }
}
?>

<div class="content-wrapper">
    <h2>Thêm sản phẩm</h2>
    <form action="index.php?act=add_product" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="category_id">Danh mục:</label>
            <select class="form-control" id="category_id" name="category_id" required>
                <option value="">Chọn danh mục</option>
                <?php foreach ($categories as $category) : ?>
                    <option value="<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="name">Tên sản phẩm:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="price">Giá sản phẩm:</label>
            <input type="number" class="form-control" id="price" name="price" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="description">Mô tả sản phẩm:</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>
        <div class="form-group">
            <label for="product_image">Ảnh sản phẩm:</label>
            <input type="file" class="form-control" id="product_image" name="product_image" required>
        </div>
        <button type="submit" name="add" class="btn btn-primary">Thêm mới</button>
        <a href="index.php?act=list_product" class="btn btn-secondary">Danh sách</a>
    </form>
    <?php if (!empty($message)) echo "<p class='alert alert-success'>$message</p>"; ?>
</div>
