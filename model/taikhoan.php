<?php
function insert_users($username, $password, $email)
{
    $sql = "INSERT INTO `users` (`username`, `password`, `email`) VALUES ('$username','$password','$email')";
    pdo_execute($sql);
}
function checkuser($username, $password)
{
    $sql = "SELECT * FROM users WHERE username='" . $username . "' AND password='" . $password . "'";
    $sp = pdo_query_one($sql);
    return $sp;
}
function login($username, $password)
{
    // Gọi hàm kiểm tra tài khoản
    $user = checkuser($username, $password);

    if ($user) {
        // Lưu thông tin cần thiết vào session
        $_SESSION['username'] = $user['username'];
        $_SESSION['iduser'] = $user['id'];
        $_SESSION['role_id'] = $user['role_id'];

        // Kiểm tra role để chuyển hướng
        if ($user['role_id'] == 1) {
            // Quản trị viên
            header("Location: admin/index.php");
        } else {
            // Người dùng thông thường
            header("Location: index.php");
        }
        exit(); // Đảm bảo dừng script sau khi chuyển hướng
    }

    // Trả về thông báo lỗi nếu đăng nhập thất bại
    return "Đăng nhập không thành công. Vui lòng kiểm tra lại thông tin đăng nhập.";
}