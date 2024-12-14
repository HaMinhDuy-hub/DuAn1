<?php
$file_path = __DIR__ . '/../../model/Category.php'; // Điều chỉnh đúng số cấp thư mục

$id = isset($_GET['id']) ? $_GET['id'] : null;
$category = Category::getOne($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    if (!empty($name)) {
        Category::update($id, $name);
        $message = "Cập nhật danh mục thành công!";
        header('Location: index.php?act=list_categories');
        exit;
    } else {
        $message = "Vui lòng nhập tên danh mục!";
    }
}
?>

<div class="content-wrapper">
    <h2>Sửa danh mục</h2>
    <form action="index.php?act=update_category" method="POST">
    <input type="hidden" name="id" value="<?= $category['id'] ?>">
    <div class="form-group">
        <label for="name">Tên danh mục:</label>
        <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($category['name']) ?>" required>
    </div>
    <button type="submit" name="update" class="btn btn-primary">Cập nhật</button>
    <a href="index.php?act=list_categories" class="btn btn-secondary">Danh sách</a>
</form>
    <?php if (isset($message)) echo "<p class='alert alert-success'>$message</p>"; ?>
</div>
