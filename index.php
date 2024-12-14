<?php 
session_start();
ob_start();
if (!isset($_SESSION['giohang'])) {
    $_SESSION['giohang'] = [];
}
include 'model/pdo.php';
include 'model/sanpham.php';
include 'model/danhmuc.php';
include 'view/header.php';
include 'global.php';
include 'model/taikhoan.php';
include 'model/donhang.php';

$dssp_new=load_sanpham_home();

if (isset($_GET['act']) && ($_GET['act'] != "")) {
    $act = $_GET['act'];
    switch($act){
        case 'sanpham':
            // Khởi tạo các biến mặc định
            $category_id = isset($_GET['category_id']) && $_GET['category_id'] > 0 ? $_GET['category_id'] : "";
            $keyw = isset($_POST['search']) ? trim($_POST['search']) : ""; 
            $list_sp_danhmuc = loadAll_sanphampage($keyw, $category_id);
            $list_danhmuc = loadall_danhmuc();
            include 'view/sanpham.php';
            break;
        case 'chitietsp':
            if (isset($_GET['id']) && ($_GET['id']) > 0) {
                $id = $_GET['id'];
                $category_id = "";
                $load__one = loadone_sanpham($id);
                $load__size = loadAll_size();
                extract($load__one);
                $load__sp__cungloai = load_sanpham_cungloai($id, $category_id);
                include "view/chitietsp.php";
            } else {
                include "view/home.php";
            }
            break;
        case 'themgiohang':
                if (isset($_POST['themgiohang']) && ($_POST['themgiohang'])) {
                    // Lấy dữ liệu từ form
                    $id = isset($_POST['id']) ? htmlspecialchars($_POST['id']) : '';
                    $tensp = isset($_POST['tensp']) ? htmlspecialchars($_POST['tensp']) : '';
                    $img = isset($_POST['img']) ? htmlspecialchars($_POST['img']) : '';
                    $gia = isset($_POST['gia']) ? (float)$_POST['gia'] : 0;
                    $sl = isset($_POST['sl']) && (int)$_POST['sl'] > 0 ? (int)$_POST['sl'] : 1;
                    // Đảm bảo giỏ hàng tồn tại
                    if (!isset($_SESSION['giohang'])) {
                        $_SESSION['giohang'] = [];
                    }
                    // Kiểm tra sản phẩm đã tồn tại trong giỏ hàng hay chưa
                    $fg = 0; // Cờ đánh dấu
                    $i = 0;  // Chỉ số trong mảng
                    foreach ($_SESSION['giohang'] as $item) {
                        if ($item[0] === $id) { // So sánh bằng ID thay vì tên
                            $slnew = $sl + $item[4];
                            $_SESSION['giohang'][$i][4] = $slnew;
                            $fg = 1;
                            break;
                        }
                        $i++;
                    }
                    // Nếu chưa tồn tại, thêm sản phẩm mới
                    if ($fg == 0) {
                        $item = [$id, $tensp, $img, $gia, $sl];
                        $_SESSION['giohang'][] = $item;
                    }
                    // Chuyển hướng đến trang giỏ hàng
                    header('Location: index.php?act=giohang');
                }
            break;
        case 'xoagiohang':
                if (isset($_GET['i']) && is_numeric($_GET['i']) && $_GET['i'] >= 0) {
                    // Kiểm tra nếu chỉ số `i` được truyền vào và có giá trị hợp lệ
                    if (isset($_SESSION['giohang']) && count($_SESSION['giohang']) > 0) {
                        // Xóa sản phẩm dựa trên chỉ số `i` nếu tồn tại
                        $index = (int)$_GET['i'];
                        if (isset($_SESSION['giohang'][$index])) {
                            array_splice($_SESSION['giohang'], $index, 1);
                        }
                    }
                } else {
                    // Xóa toàn bộ giỏ hàng nếu không có `i` hợp lệ
                    if (isset($_SESSION['giohang'])) {
                        unset($_SESSION['giohang']);
                    }
                }
                // Kiểm tra lại giỏ hàng sau khi cập nhật
                if (isset($_SESSION['giohang']) && count($_SESSION['giohang']) > 0) {
                    // Nếu vẫn còn sản phẩm trong giỏ hàng, chuyển hướng về trang giỏ hàng
                    header('Location: index.php?act=giohang');
                    exit; // Dừng thực thi để đảm bảo không chạy tiếp mã khác
                } else {
                    // Nếu giỏ hàng trống, chuyển hướng về trang chủ
                    header('Location: index.php?act=giohang');
                    exit; // Dừng thực thi
                }
                
        case 'giohang':
            include 'view/cart/giohang.php';
            break;
        case 'thanhtoan':
                if (isset($_POST['thanhtoan']) && $_POST['thanhtoan']) {
                    // Lấy dữ liệu từ form và làm sạch đầu vào
                    $total_price = isset($_POST['total_price']) ? trim($_POST['total_price']) : '';
                    $customer_name = isset($_POST['customer_name']) ? trim(htmlspecialchars($_POST['customer_name'])) : '';
                    $shipping_address = isset($_POST['shipping_address']) ? trim(htmlspecialchars($_POST['shipping_address'])) : '';
                    $customer_phone = isset($_POST['customer_phone']) ? trim(htmlspecialchars($_POST['customer_phone'])) : '';
                    $customer_email = isset($_POST['customer_email']) ? trim(htmlspecialchars($_POST['customer_email'])) : '';
                    $payment_method = isset($_POST['payment_method']) ? trim($_POST['payment_method']) : '';
                    // Lấy user_id từ session (nếu người dùng đã đăng nhập)
                    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
                    // Đặt trạng thái mặc định cho đơn hàng
                    $status_id = 1; // Ví dụ: 1 = "mới tạo"
                    // Kiểm tra xem tất cả các trường thông tin đã được điền đầy đủ hay chưa
                    if (empty($customer_name) || empty($shipping_address) || empty($customer_phone) || empty($customer_email) || empty($payment_method)) {
                        // Nếu thiếu thông tin, hiển thị thông báo lỗi và không thực hiện chuyển hướng
                        $error_message = "Vui lòng điền đầy đủ thông tin!";
                        // Dùng session để lưu thông báo lỗi
                        $_SESSION['error_message'] = $error_message;
                        // Quay lại trang thanh toán
                        header('Location: index.php?act=thanhtoan');
                        exit;
                    } else {
                        // Nếu tất cả thông tin hợp lệ, tạo đơn hàng và chuyển hướng đến trang cảm ơn
                        $order = new Order();
                        $order_id = $order->taodonhang(
                            $total_price,
                            $payment_method,
                            $customer_name,
                            $shipping_address,
                            $customer_phone,
                            $customer_email,
                            $user_id,
                            $status_id
                        );
                        
                        // Dùng session để lưu thông tin đơn hàng nếu cần
                        $_SESSION['order_id'] = $order_id;
                        
                        // Chuyển hướng đến trang cảm ơn
                        header('Location: index.php?act=camon');
                        exit; // Dừng script để tránh tiếp tục thực hiện sau khi chuyển hướng
                    }
                }
                include 'view/cart/thanhtoan.php'; // Hiển thị lại trang thanh toán nếu không có POST
                break;
        case 'ctdonhang':
                     // Hiển thị danh sách đơn hàng
                     $order = new Order();
                     $orders = $order->ctdonhang();
                    include 'view/cart/ctdonhang.php';
                    break;
        case 'cttungdonhang':
                        $order = new Order();
                        // Hiển thị danh sách đơn hàng
                        if (isset($_GET['id'])) {
                            $orderId = $_GET['id'];
                            $orderDetail = $order->cttungdonhang($orderId);
                            include "view/cart/cttungdonhang.php";
                        } else {
                            echo "Order ID is missing.";
                        }
                        break;
                
        case 'dang_ky':
                if (isset($_POST['dangky'])) {
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    $email = $_POST['email'];
                    insert_users($username, $password, $email);
                    $thongbao = "Đăng ký tài khoản thành công! Vui lòng đăng nhập.";
                }
                include "./view/taikhoan/dang_ky.php";
                break;
        case 'dang_nhap':
                    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['dang_nhap'])) {
                        // Kiểm tra và lấy dữ liệu đầu vào
                        $username = isset($_POST['username']) ? htmlspecialchars(trim($_POST['username'])) : '';
                        $password = isset($_POST['password']) ? trim($_POST['password']) : '';
                        // Biến thông báo mặc định
                        $thongbao = "Đăng nhập không thành công. Vui lòng kiểm tra lại thông tin đăng nhập.";
                        // Kiểm tra thông tin đăng nhập
                        if (!empty($username) && !empty($password)) {
                            $check = login($username, $password);
                            if ($check) {
                                // Đăng nhập thành công: Chuyển hướng hoặc xử lý logic
                                $thongbao = "Đăng nhập thành công.";
                                // Ví dụ: Chuyển hướng tới trang chủ
                                header('Location: ./index.php');
                                exit;
                            }
                        } else {
                            $thongbao = "Vui lòng nhập đầy đủ tên đăng nhập và mật khẩu.";
                        }
                    }
                    // Gửi biến thông báo tới view
                    include "./view/taikhoan/dang_nhap.php";
            break;
                
        case 'lienhe':
            include 'view/lienhe.php';
            break;
        case 'blog':
            include 'view/blog.php';
            break;
        case 'camon':
            include 'view/camon.php';
            break;
    }
} else {
    
   include 'view/home.php';
}
include 'view/footer.php';

?>