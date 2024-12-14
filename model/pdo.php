<?php
function pdo_get_connection()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    try {
        $conn = new PDO("mysql:host=$servername;dbname=duan1_team10", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}
function pdo_execute($sql)
{
    $sql_args = array_slice(func_get_args(), 1);
    try {
        $conn = pdo_get_connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($sql_args);
    } catch (PDOException $e) {
        throw $e;
    } finally {
        unset($conn);
    }
}
// truy vấn nhiều dữ liệu
function pdo_query($sql, ...$params)
{
    try {
        // Kết nối với cơ sở dữ liệu
        $conn = pdo_get_connection();
        
        // Chuẩn bị câu truy vấn
        $stmt = $conn->prepare($sql);
        
        // Thực thi câu truy vấn với tham số đã được truyền vào
        $stmt->execute($params);
        
        // Lấy tất cả kết quả
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $rows;
    } catch (PDOException $e) {
        // Xử lý lỗi (nếu có)
        throw $e;
    } finally {
        // Đảm bảo kết nối sẽ được đóng sau khi sử dụng
        unset($conn);
    }
}

// truy vấn  1 dữ liệu
function pdo_query_one($sql)
{
    $sql_args = array_slice(func_get_args(), 1);
    try {
        $conn = pdo_get_connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($sql_args);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // đọc và hiển thị giá trị trong danh sách trả về
        return $row;
    } catch (PDOException $e) {
        throw $e;
    } finally {
        unset($conn);
    }
}
pdo_get_connection();