<?php
require_once __DIR__ . '/../../model/pdo.php';
$file_path = __DIR__ . '/../../model/Order.php'; 
include_once $file_path; 

$orderId = $_GET['id'] ?? 0;
$orderModel = new Order();
$order = $orderModel->getOrderById($orderId);
$orderStatuses = $orderModel->getAllOrderStatuses();

if (!$order) {
    echo "Không tìm thấy đơn hàng!";
    exit;
}
?>

<div class="content-wrapper">
    <h2>Chỉnh sửa đơn hàng</h2>
    <form action="index.php?act=update_order" method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($order['id']) ?>">
        
        <div class="form-group">
            <label for="status_id">Trạng thái đơn hàng</label>
            <select name="status_id" id="status_id" class="form-control">
                <?php foreach ($orderStatuses as $status) : ?>
                    <option value="<?= $status['id'] ?>" <?= $status['id'] == $order['status_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($status['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

                <div class="form-group">
            <label for="payment_status">Trạng thái thanh toán</label>
            <select name="payment_status" id="payment_status" class="form-control">
                <option value="Đã Thanh Toán" <?= isset($order['payment_status']) && $order['payment_status'] == 'Đã Thanh Toán' ? 'selected' : '' ?>>Đã Thanh Toán</option>
                <option value="Chưa Thanh Toán" <?= isset($order['payment_status']) && $order['payment_status'] == 'Chưa Thanh Toán' ? 'selected' : '' ?>>Chưa Thanh Toán</option>
            </select>
        </div>

        <div class="form-group">
            <label for="shipping_status">Trạng thái giao hàng</label>
            <select name="shipping_status" id="shipping_status" class="form-control">
                <option value="Đã Giao Hàng" <?= isset($order['shipping_status']) && $order['shipping_status'] == 'Đã Giao Hàng' ? 'selected' : '' ?>>Đã Giao Hàng</option>
                <option value="Đang Giao Hàng" <?= isset($order['shipping_status']) && $order['shipping_status'] == 'Đang Giao Hàng' ? 'selected' : '' ?>>Đang Giao Hàng</option>
                <option value="Đã Hủy" <?= isset($order['shipping_status']) && $order['shipping_status'] == 'Đã Hủy' ? 'selected' : '' ?>>Đã Hủy</option>
            </select>
        </div>


        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
</div>
