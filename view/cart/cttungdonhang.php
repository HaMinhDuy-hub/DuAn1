<?php

// Kiểm tra có ID đơn hàng không
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "\u0110ược cung cấp ID đơn hàng không hợp lệ.";
    exit;
}

$orderId = intval($_GET['id']); // Ép ID sang integer để tránh Injection
$order = new Order();
$orderDetail = $order->cttungdonhang($orderId);

if (!$orderDetail) {
    echo "\u0110ơn hàng không tồn tại.";
    exit;
}

$orderItems = $order->ctdonhangitem($orderId); // Lấy danh sách các sản phẩm trong đơn hàng
?>

<div class="content-wrapper">
    <h2>Chi tiết đơn hàng #<?= htmlspecialchars($orderDetail['id']) ?></h2>
    <p><strong>Khách hàng:</strong> <?= htmlspecialchars($orderDetail['customer_name']) ?></p>
    <p><strong>Email:</strong> <?= htmlspecialchars($orderDetail['customer_email']) ?></p>
    <p><strong>Số điện thoại:</strong> <?= htmlspecialchars($orderDetail['customer_phone']) ?></p>
    <p><strong>Địa chỉ giao hàng:</strong> <?= htmlspecialchars($orderDetail['shipping_address']) ?></p>
    <p><strong>Phương thức thanh toán:</strong> <?= htmlspecialchars($orderDetail['payment_method']) ?></p>
    <p><strong>Trạng thái thanh toán:</strong> <?= ucfirst(htmlspecialchars($orderDetail['payment_status'])) ?></p>
    <p><strong>Trạng thái vận chuyển:</strong> <?= ucfirst(htmlspecialchars($orderDetail['shipping_status'])) ?></p>
    <p><strong>Tổng tiền:</strong> <?= number_format($orderDetail['total_price'], 0, ',', '.') ?> VND</p>

    <h3>Danh sách các sản phẩm trong đơn hàng</h3>
    <?php if (!empty($orderItems)) : ?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Tổng</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orderItems as $item) : ?>
            <tr>
                <td><?= htmlspecialchars($item['product_name']) ?></td>
                <td><?= $item['quantity'] ?></td>
                <td><?= number_format($item['price'], 0, ',', '.') ?> VND</td>
                <td><?= number_format($item['quantity'] * $item['price'], 0, ',', '.') ?> VND</td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else : ?>
    <p>Không có sản phẩm nào trong đơn hàng.</p>
    <?php endif; ?>

    <a href="index.php?act=ctdonhang" class="btn btn-secondary">Quay lại</a>
</div>