<div class="content-wrapper">
    <section class="content-header">
        <h1>Thêm mã giảm giá</h1>
    </section>

    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Thông tin mã giảm giá</h3>
            </div>
            <div class="box-body">
                <?php if (isset($error)): ?>
                    <p class="alert alert-danger"><?= htmlspecialchars($error) ?></p>
                <?php endif; ?>
                <form action="" method="POST">
    <div class="form-group">
        <label for="code">Mã giảm giá</label>
        <input type="text" name="code" id="code" class="form-control" placeholder="Nhập mã giảm giá" required>
    </div>
    <div class="form-group">
        <label for="discount_percent">Phần trăm giảm giá (%)</label>
        <input type="number" name="discount_percent" id="discount_percent" class="form-control" placeholder="Nhập phần trăm giảm giá" required>
    </div>
    <div class="form-group">
        <label for="start_date">Ngày bắt đầu</label>
        <input type="date" name="start_date" id="start_date" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="expiry_date">Ngày kết thúc</label>
        <input type="date" name="expiry_date" id="expiry_date" class="form-control" required>
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Thêm mới</button>
    <a href="index.php?act=list_discount" class="btn btn-default">Quay lại</a>
</form>

            </div>
        </div>
    </section>
</div>
