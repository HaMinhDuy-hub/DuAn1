<div class="content-wrapper">
<h2>Kho lưu trữ mã giảm giá</h2>
<table class="table" border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên mã</th>
            <th>Phần trăm giảm</th>
            <th>Ngày bắt đầu</th>
            <th>Ngày hết hạn</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Lấy danh sách các mã giảm giá đã bị xóa
        $discount_codes = DiscountCode::getArchivedDiscountCodes(); // Hàm này sẽ trả về các mã có deleted_at NOT NULL

        foreach ($discount_codes as $code) {
            echo "<tr>";
            echo "<td>{$code['id']}</td>";
            echo "<td>{$code['code']}</td>";
            echo "<td>{$code['discount_percent']}%</td>";
            echo "<td>{$code['start_date']}</td>";
            echo "<td>{$code['expiry_date']}</td>";
            echo "<td><a href='index.php?act=restore_discount&id={$code['id']}' class='btn btn-success'>Khôi phục</a></td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>
    </div>
