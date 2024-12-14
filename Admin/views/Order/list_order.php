<div class="content-wrapper">
    <h2>Danh sách đơn hàng</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>STT</th>
                <th>Khách hàng</th>
                <th>Tổng tiền</th>
                <th>Trạng thái đơn hàng</th>
                <th>Trạng thái thanh toán</th>
                <th>Trạng thái vận chuyển</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php $index = 1; ?> 
            <?php foreach ($orders as $order) : ?>
                <tr>
                    <td><?= $index++ ?></td>
                    <td><?= htmlspecialchars($order['customer_name']) ?></td>
                    <td><?= number_format($order['total_price'], 0, ',', '.') ?> VND</td>
                    <td>
                        <span class="badge bg-<?= $order['order_status_name'] == 'secondary' ? 'primary' : 'success' ?>">
                            <?= ucfirst($order['order_status_name']) ?>
                        </span>
                    </td>
                    <td>
                        <span class="badge bg-<?= $order['payment_status'] == 'paid' ? 'success' : 'danger' ?>">
                            <?= ucfirst($order['payment_status']) ?>
                        </span>
                    </td>
                    <td>
                        <span class="badge bg-<?= $order['shipping_status'] == 'delivered' ? 'success' : 'warning' ?>">
                            <?= ucfirst($order['shipping_status']) ?>
                        </span>
                    </td>
                    <td>
                        <a href="index.php?act=edit_order&id=<?= $order['id'] ?>" class="btn btn-warning">Sửa</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>    
    </table>
</div>
