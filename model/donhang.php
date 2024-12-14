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
    public function taodonhang($total_price, $payment_method, $customer_name, $shipping_address, $customer_phone, $customer_email, $user_id, $status_id)
    {
        $sql = "INSERT INTO orders (total_price, payment_method, customer_name, shipping_address, customer_phone, customer_email, user_id, status_id) 
                VALUES (:total_price, :payment_method, :customer_name, :shipping_address, :customer_phone, :customer_email, :user_id, :status_id)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':total_price' => $total_price,
            ':payment_method' => $payment_method,
            ':customer_name' => $customer_name,
            ':shipping_address' => $shipping_address,
            ':customer_phone' => $customer_phone,
            ':customer_email' => $customer_email,
            ':user_id' => $user_id,
            ':status_id' => $status_id
        ]);
    }
    public function ctdonhang()
    {
        $sql = "SELECT o.id, o.customer_name, o.customer_email, o.customer_phone, 
                       o.created_at, o.total_price, os.payment_status, os.shipping_status
                FROM orders o
                JOIN order_status os ON o.status_id = os.id
                ORDER BY o.created_at DESC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }
    public function cttungdonhang($id)
    {
        $sql = "SELECT * FROM orders WHERE id = :id";
        return pdo_query_one($sql, $id);
    }
    public function ctdonhangitem($orderId) {
        $conn = pdo_get_connection();  

        $query = "SELECT oi.*, p.product_name, p.price 
                  FROM order_items oi
                  JOIN products p ON oi.product_id = p.id
                  WHERE oi.order_id = :order_id";
        
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':order_id', $orderId, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}