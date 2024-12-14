<?php
require_once 'pdo.php';

class Order
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = pdo_get_connection();
    }

    // Insert a new order
    public function insertOrder($data)
    {
        $sql = "INSERT INTO orders (customer_id, payment_method, payment_status, shipping_status, created_at) VALUES (:customer_id, :payment_method, :payment_status, :shipping_status, :created_at)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($data);
    }


    // Update order status
    public function updateOrder($orderId, $statusId, $paymentStatus, $shippingStatus)
{
    $sql = "UPDATE orders 
            SET status_id = :status_id
            WHERE id = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
        'id' => $orderId,
        'status_id' => $statusId,
    ]);

    // Cập nhật trạng thái thanh toán và giao hàng (nếu cần)
    $sqlStatus = "UPDATE order_status
                  SET payment_status = :payment_status, 
                      shipping_status = :shipping_status
                  WHERE id = :status_id";
    $stmtStatus = $this->pdo->prepare($sqlStatus);
    return $stmtStatus->execute([
        'payment_status' => $paymentStatus,
        'shipping_status' => $shippingStatus,
        'status_id' => $statusId,
    ]);
}


    
    // Fetch all order statuses for dropdown
    public function getAllOrderStatuses()
    {
        $sql = "SELECT id, name FROM order_status";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    


    // Logic for handling order business rules
    // public function handleOrderLogic($orderId)
    // {
    //     $sql = "SELECT * FROM orders WHERE id = :id";
    //     $stmt = $this->pdo->prepare($sql);
    //     $stmt->execute(['id' => $orderId]);
    //     $order = $stmt->fetch();

    //     if (!$order) {
    //         throw new Exception("Order not found.");
    //     }

    //     // Case: Shipping cancelled
    //     if ($order['shipping_status'] === 'cancelled') {
    //         if ($order['payment_status'] === 'paid') {
    //             $this->updateOrderStatus($orderId, 'refunded', 'cancelled');
    //         }
    //     }

    //     // Case: Shipping delivered
    //     elseif ($order['shipping_status'] === 'delivered') {
    //         if ($order['payment_method'] === 'COD' && $order['payment_status'] === 'unpaid') {
    //             $this->updateOrderStatus($orderId, 'paid', 'delivered');
    //         }
    //     }

    //     // Additional cases can be handled here
    // }

    // Fetch all orders
//     public function getAll()
// {
//     $sql = "SELECT o.id, o.customer_name, o.customer_email, o.customer_phone, 
//                    o.created_at, o.total_price, os.payment_status, os.shipping_status
//             FROM orders o
//             JOIN order_status os ON o.status_id = os.id
//             ORDER BY o.created_at DESC";
//     $stmt = $this->pdo->query($sql);
//     return $stmt->fetchAll();
// }
public function getAll()
{
    $sql = "SELECT o.id, 
                   o.customer_name, 
                   o.total_price, 
                   os.name AS order_status_name, 
                   os.payment_status, 
                   os.shipping_status
            FROM orders o
            JOIN order_status os ON o.status_id = os.id
            WHERE os.deleted_at IS NULL
            ORDER BY o.created_at DESC";
    $stmt = $this->pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


// public function getOrderById($id)
// {
//     $sql = "SELECT * FROM orders WHERE id = :id";
//     $stmt = $this->pdo->prepare($sql);
//     $stmt->execute(['id' => $id]);
//     return $stmt->fetch(PDO::FETCH_ASSOC);
// }

//     public function getOrderItems($orderId) {
//         $conn = pdo_get_connection();  

//         $query = "SELECT oi.*, p.product_name, p.price 
//                   FROM order_items oi
//                   JOIN products p ON oi.product_id = p.id
//                   WHERE oi.order_id = :order_id";
        
//         $stmt = $conn->prepare($query);
//         $stmt->bindParam(':order_id', $orderId, PDO::PARAM_INT);
//         $stmt->execute();
        
//         return $stmt->fetchAll(PDO::FETCH_ASSOC);
//     }
    public function getOrderById($id)
{
    $sql = "SELECT o.*, 
                   os.payment_status, 
                   os.shipping_status 
            FROM orders o
            LEFT JOIN order_status os ON o.status_id = os.id
            WHERE o.id = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

    // Đếm số đơn hàng chưa bị xóa
    public static function countOrders()
{
    $sql = "SELECT COUNT(*) AS total FROM orders WHERE deleted_at IS NULL";
    $result = pdo_query_one($sql); // Lấy kết quả từ cơ sở dữ liệu
    return isset($result['total']) ? $result['total'] : 0; // Trả về tổng số sản phẩm, mặc định là 0 nếu không có
}

}
