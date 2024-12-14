<style>
.content-wrapper {
    background-color: #f8f9fa;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.table {
    margin: 0;
    border-collapse: collapse;
}

.table th,
.table td {
    vertical-align: middle;
}

.table thead th {
    font-size: 16px;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.badge {
    font-size: 14px;
    padding: 6px 10px;
    border-radius: 12px;
}

.table-hover tbody tr:hover {
    background-color: #f1f1f1;
}

.btn {
    transition: all 0.3s ease-in-out;
}

.btn:hover {
    transform: scale(1.05);
}
</style>
<div class="content-wrapper container py-4">
    <h2 class="text-center mb-4">Danh Sách Đơn Hàng</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr class="text-center">
                    <th>STT</th>
                    <th>Khách Hàng</th>
                    <th>Ngày Tạo Đơn</th>
                    <th>Tổng Tiền</th>
                    <th>TT Thanh Toán</th>
                    <th>TT Vận Chuyển</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php $index = 1; ?>
                <?php foreach ($orders as $order) : ?>
                <tr>
                    <td class="text-center"><?= $index++ ?></td>
                    <td><?= htmlspecialchars($order['customer_name']) ?></td>
                    <td class="text-center"><?= $order['created_at'] ?></td>
                    <td class="text-end"><?= number_format($order['total_price'], 0, ',', '.') ?> VND</td>
                    <td class="text-center">
                        <span class="badge bg-<?= $order['payment_status'] === 'paid' ? 'success' : 'danger' ?>">
                            <?= ucfirst($order['payment_status']) ?>
                        </span>
                    </td>
                    <td class="text-center">
                        <span class="badge bg-<?= $order['shipping_status'] === 'delivered' ? 'success' : 'warning' ?>">
                            <?= ucfirst($order['shipping_status']) ?>
                        </span>
                    </td>
                    <td class="text-center">
                        <a href="index.php?act=cttungdonhang&id=<?=$order['id']?>" class="btn btn-info">Chi Tiết</a>

                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>