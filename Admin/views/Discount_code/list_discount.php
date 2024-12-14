<?php
require_once __DIR__ . '/../../model/Discount_code.php';

$discounts = DiscountCode::getAll(); // Lấy danh sách mã giảm giá
if (isset($_SESSION['message'])) {
    echo "<p class='alert alert-success'>{$_SESSION['message']}</p>";
    unset($_SESSION['message']);
}
?>

<div class="content-wrapper">
    <h2>Danh sách mã giảm giá</h2>
    <a href="index.php?act=add_discount" class="btn btn-primary mb-3">Thêm mã giảm giá</a>
    <a href="index.php?act=archive_discount" class="btn btn-warning mb-3">Kho lưu trữ</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>STT</th>
                <th>Mã giảm giá</th>
                <th>Phần trăm giảm</th>
                <th>Ngày bắt đầu</th>
                <th>Ngày kết thúc</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
        <?php $index = 1; ?> 
        <?php foreach ($discount_codes as $index => $code) : ?>
            <tr>
            <td><?= $index + 1 ?></td>
                    <td><?= htmlspecialchars($code['code']) ?></td>
                    <td><?= htmlspecialchars($code['discount_percent']) ?>%</td>
                    <td><?= htmlspecialchars($code['start_date']) ?></td>
                    <td><?= htmlspecialchars($code['expiry_date']) ?></td>
                    <td><?= $code['is_active'] ? 'Hoạt động' : 'Ngừng hoạt động' ?></td>
                    <td>
                        <a href="index.php?act=edit_discount&id=<?= $code['id'] ?>" class="btn btn-warning">Sửa</a>
                        <a href="index.php?act=toggle_status&id=<?= $code['id'] ?>&status=<?= $code['is_active'] ? 0 : 1 ?>" 
                           class="btn <?= $code['is_active'] ? 'btn-secondary' : 'btn-success' ?>">
                           <?= $code['is_active'] ? 'Ngừng hoạt động' : 'Kích hoạt' ?>
                        </a>
                        <a href="index.php?act=delete_discount&id=<?= $code['id'] ?>" 
                           class="btn btn-danger" 
                           onclick="return confirm('Bạn có chắc muốn xóa mã giảm giá này?')">Xóa</a>
                    </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>


