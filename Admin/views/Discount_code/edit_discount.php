<?php
require_once __DIR__ . '/../../model/Discount_code.php';
?>

<div class="content-wrapper">
    <h2>Chỉnh sửa mã giảm giá</h2>
    <form method="post" action="">
        <input type="hidden" name="id" value="<?= htmlspecialchars($discount_code['id']) ?>">

        <div class="mb-3">
            <label for="code" class="form-label">Tên mã giảm giá</label>
            <input type="text" id="code" name="code" class="form-control" value="<?= htmlspecialchars($discount_code['code']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="discount_percent" class="form-label">Phần trăm giảm giá</label>
            <input type="number" id="discount_percent" name="discount_percent" class="form-control" value="<?= htmlspecialchars($discount_code['discount_percent']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="start_date" class="form-label">Ngày bắt đầu</label>
            <input type="date" id="start_date" name="start_date" class="form-control" value="<?= htmlspecialchars($discount_code['start_date']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="expiry_date" class="form-label">Ngày hết hạn</label>
            <input type="date" id="expiry_date" name="expiry_date" class="form-control" value="<?= htmlspecialchars($discount_code['expiry_date']) ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
        <a href="index.php?act=list_discount" class="btn btn-secondary">Hủy</a>
    </form>
</div>
