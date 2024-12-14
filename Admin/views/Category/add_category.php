<?php
$file_path = __DIR__ . '/../../model/Category.php'; // Điều chỉnh đúng số cấp thư mục

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    if (!empty($name)) {
        Category::insert($name); 
        $message = "Thêm danh mục thành công!";
    } else {
        $message = "Vui lòng nhập tên danh mục!";
    }
}
?>

<div class="content-wrapper">
    <h2>Thêm danh mục</h2>
    <form action="index.php?act=add_category" method="POST">
        <div class="form-group">
            <label for="name">Tên danh mục:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <button type="submit" name="add" class="btn btn-primary">Thêm mới</button>
        <a href="index.php?act=list_categories" class="btn btn-secondary">Danh sách</a>
    </form>
    <?php if (isset($message)) echo "<p class='alert alert-success'>$message</p>"; ?>
</div>
