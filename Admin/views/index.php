<?php
session_start();
ob_start();
include "header.php";
include "navbar.php";
include "sidebar.php";
include "../model/pdo.php";
include "../model/Product.php";
include "../model/Category.php";
include "../model/Color.php";
include "../model/Size.php";
include "../model/ProductVariant.php";
include "../model/User.php";
include "../model/Comment.php";
include "../model/Order.php";
include "../model/Discount_code.php";

$order = new Order();
$orderModel = new Order();

// Kiểm tra quyền Admin
// if ($_SESSION['role'] != 1) {
//     echo '<script>alert("Bạn không phải Admin");window.location.href="../index.php";</script>';
//     exit();
// }

// Điều hướng hành động
if (isset($_GET["act"]) && $_GET["act"] != "") {
    $act = $_GET["act"];
    switch ($act) {
        ///////////////////////////////////// danh mục

         // Thêm danh mục
         case "add_category":
            if (isset($_POST['add']) && $_POST['add']) {
                $name = $_POST['name'];
                Category::insert($name);
                $message = "Thêm danh mục thành công!";
            }
            include "Category/add_category.php";
            break;

        // Danh sách danh mục
        case "list_categories":
            $categories = Category::getAll();
            include "Category/list_categories.php";
            break;

        // Xóa danh mục
        case "delete_category":
            if (isset($_GET["id"]) && $_GET["id"] > 0) {
                Category::delete($_GET["id"]);
                $message = "Xóa danh mục thành công!";
            }
            $categories = Category::getAll();
            include "Category/list_categories.php";
            break;

        // Sửa danh mục
                case "edit_category":
                if (isset($_GET["id"]) && $_GET["id"] > 0) {
                    $category = Category::getOne($_GET["id"]);
                    if (!$category) {
                        $message = "Danh mục không tồn tại hoặc đã bị xóa.";
                    }
                }
                include "Category/edit_category.php";
                break;

            // Cập nhật danh mục
case "update_category":
    if (isset($_POST['name']) && $_POST['name']) {
        $id = $_POST["id"];
        $name = trim($_POST['name']); // Loại bỏ khoảng trắng không cần thiết

        if (!empty($name)) {
            Category::update($id, $name);
            // Lưu thông báo vào session
            $_SESSION['message'] = "Cập nhật danh mục thành công!";
        } else {
            // Lưu thông báo lỗi vào session
            $_SESSION['message'] = "Vui lòng nhập tên danh mục!";
        }

        // Điều hướng về trang danh sách danh mục sau khi cập nhật thành công
        header('Location: index.php?act=list_categories');
        exit; // Chấm dứt script để tránh việc tiếp tục thực thi mã sau khi điều hướng
    }
    break;
            // Kho lưu trữ
                case "archive_categories":
                    include "Category/archive_categories.php";
                    break;

        // Khôi phục danh mục
        case "restore_category":
            if (isset($_GET["id"]) && $_GET["id"] > 0) {
                Category::restore($_GET["id"]);
                $message = "Danh mục đã được khôi phục!";
             }
    $categories = Category::getAll();
    include "Category/list_categories.php";
    break;

        ////////////////////////////////////////////////////////// Sản phẩm

// Thêm sản phẩm
case "add_product":
    if (isset($_POST['add']) && $_POST['add']) {
        $category_id = $_POST['category_id'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $product_image = $_FILES['product_image']['name'];

        // Upload hình ảnh sản phẩm (nếu có)
        if ($product_image) {
            $target_dir = "uploads/products/";
            $target_file = $target_dir . basename($product_image);
            move_uploaded_file($_FILES['product_image']['tmp_name'], $target_file);
        }

        Product::insert($category_id, $name, $price, $description, $product_image);
        $message = "Thêm sản phẩm thành công!";
    }
    $categories = Category::getAll(); // Lấy danh sách danh mục để hiển thị trong form
    include "Product/add_product.php";
    break;

// Thêm biến thể cho sản phẩm
    case 'add_variant':
        // Lấy thông tin sản phẩm cần thêm biến thể
        $product_id = isset($_GET['product_id']) ? $_GET['product_id'] : null;
        
        // Nếu có product_id và là POST request, xử lý thêm biến thể
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $product_id) {
            $product_id = $_POST['product_id'];
            $color_id = $_POST['color_id'];
            $size_id = $_POST['size_id'];
            $quantity = $_POST['quantity'];

            if (!empty($product_id) && !empty($color_id) && !empty($size_id) && !empty($quantity)) {
                ProductVariant::insert($product_id, $color_id, $size_id, $quantity);
                $message = "Thêm biến thể thành công!";
            } else {
                $message = "Vui lòng điền đầy đủ thông tin!";
            }
        }
        
        // Lấy danh sách màu sắc và kích cỡ từ model
        $colors = Color::getAll();
        $sizes = Size::getAll();

        // Hiển thị form thêm biến thể
        include 'Product/add_variant.php'; // Hoặc tên file view bạn muốn
        break;


// Danh sách sản phẩm
case "list_product":
    $products = Product::getAll();
    $totalProducts = Product::countProducts();
    include "Product/list_product.php";
    break;

    // Chi tiết sản phẩm
    case "view_product_details":
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $product_id = intval($_GET['id']); // Chuyển sang số nguyên để tránh lỗi SQL injection
            
            // Lấy thông tin sản phẩm chi tiết
            $product = Product::getById($product_id); // Hàm này lấy sản phẩm theo ID
    
            if ($product) {
                // Lấy danh sách biến thể của sản phẩm
                $productVariants = Product::getProductDetails($product_id);
    
                // Lấy danh sách màu sắc và kích cỡ
                $colors = Color::getAll();
                $sizes = Size::getAll();
            } else {
                $error_message = "Không tìm thấy sản phẩm với ID: $product_id.";
            }
        } else {
            $error_message = "ID sản phẩm không hợp lệ hoặc không được cung cấp.";
        }
        include "Product/view_product_details.php";
        break;

// Xóa sản phẩm
case "delete_product":
    if (isset($_GET["id"]) && $_GET["id"] > 0) {
        Product::delete($_GET["id"]);
        $message = "Xóa sản phẩm thành công!";
    }
    $products = Product::getAll();
    include "Product/list_product.php";
    break;

// Xóa biến thể
case 'delete_variant':
    // Kiểm tra nếu có id biến thể và id sản phẩm trong URL
    if (isset($_GET['id']) && isset($_GET['product_id'])) {
        $variant_id = $_GET['id'];
        $product_id = $_GET['product_id'];

        // Xóa biến thể khỏi cơ sở dữ liệu
        ProductVariant::delete($variant_id);

        // Thông báo xóa thành công và chuyển hướng về trang chi tiết sản phẩm
        header("Location: index.php?act=view_product_details&id=$product_id");
        exit;
    } else {
        echo "Lỗi: Không có thông tin về biến thể hoặc sản phẩm.";
    }
    break;
    

// Sửa sản phẩm
case "edit_product":
    if (isset($_GET["id"]) && $_GET["id"] > 0) {
        $product = Product::getOne($_GET["id"]);
        if (!$product) {
            $message = "Sản phẩm không tồn tại hoặc đã bị xóa.";
        }
    }
    $categories = Category::getAll(); // Lấy danh sách danh mục để hiển thị trong form
    include "Product/edit_product.php";
    break;

// Cập nhật sản phẩm
case "update_product":
    if (isset($_POST['update']) && $_POST['update']) {
        $id = $_POST["id"];
        $category_id = $_POST["category_id"];
        $name = trim($_POST['name']);
        $price = $_POST['price'];
        $description = $_POST['description'];
        $product_image = $_FILES['product_image']['name'];

        // Upload hình ảnh sản phẩm (nếu có)
        if ($product_image) {
            $target_dir = "uploads/products/";
            $target_file = $target_dir . basename($product_image);
            move_uploaded_file($_FILES['product_image']['tmp_name'], $target_file);
        }

        if (!empty($name)) {
            Product::update($id, $category_id, $name, $price, $description, $product_image);
            $_SESSION['message'] = "Cập nhật sản phẩm thành công!";
        } else {
            $_SESSION['message'] = "Vui lòng nhập tên sản phẩm!";
        }

        // Điều hướng về trang danh sách sản phẩm sau khi cập nhật thành công
        header('Location: index.php?act=list_product');
        exit; // Chấm dứt script để tránh việc tiếp tục thực thi mã sau khi điều hướng
    }
    break;

// Kho lưu trữ sản phẩm (Sản phẩm đã xóa mềm)
case "archive_products":
    // Lấy tất cả sản phẩm đã xóa mềm
    $products = Product::getArchivedProducts();
    include "Product/archive_products.php"; // Hiển thị giao diện kho lưu trữ
    break;

// Khôi phục sản phẩm đã xóa
case "restore_product":
    if (isset($_GET["id"]) && $_GET["id"] > 0) {
        Product::restore($_GET["id"]);
        $message = "Sản phẩm đã được khôi phục!";
    }
    // Sau khi khôi phục, quay lại danh sách tất cả sản phẩm
    $products = Product::getAll();
    include "Product/list_product.php"; // Hiển thị danh sách sản phẩm
    break;

    ////////////////////////////////////////////////////////////////////// Người dùng

    case "list_user":
        $users = User::getAll();
        include "User/list_user.php";
        break;
    
    case "add_user":
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $role_id = $_POST['role_id'];
            $fullname = $_POST['fullname'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $avatar = $_POST['avatar'] ?? null;
    
            User::add($role_id, $fullname, $username, $email, $password, $avatar);
            $message = "Người dùng đã được thêm!";
        }
        include "User/add_user.php";
        break;
    
    case "edit_user":
        $id = $_GET['id'];
        $user = User::getOne($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $role_id = $_POST['role_id'];
            $fullname = $_POST['fullname'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $avatar = $_POST['avatar'];
            $is_active = $_POST['is_active'];
    
            User::update($id, $role_id, $fullname, $username, $email, $avatar, $is_active);
            $message = "Cập nhật thông tin người dùng thành công!";
        }
        include "User/edit_user.php";
        break;
    
    // Xóa người dùng
case "delete_user":
    if (isset($_GET['id']) && $_GET['id'] > 0) {
        try {
            User::softDelete($_GET['id']);
            $message = "Người dùng đã được xóa thành công!";
        } catch (Exception $e) {
            $message = "Không thể xóa người dùng: " . $e->getMessage();
        }
    } else {
        $message = "ID người dùng không hợp lệ!";
    }
    $users = User::getAll();
    include "User/list_user.php";
    break;
    // Kho lưu trữ
    case 'archive_users':
        $archivedUsers = User::getArchived();
        include "User/archive_user.php";
        break;
    // Khôi phục tài khoản
    case 'restore_user':
        if (isset($_GET['id'])) {
            User::restore($_GET['id']);
            $message = "Tài khoản đã được khôi phục!";
        }
        $archivedUsers = User::getArchived();
        include "User/archive_user.php";
        break;

    // Kích hoạt
    case "toggle_active_user":
        if (isset($_GET['id']) && isset($_GET['status'])) {
            $id = $_GET['id'];
            $status = $_GET['status']; // 1: kích hoạt, 0: ngừng kích hoạt
            try {
                User::toggleActive($id, $status);
                $message = $status ? "Tài khoản đã được kích hoạt!" : "Tài khoản đã bị ngừng kích hoạt!";
            } catch (Exception $e) {
                $message = "Lỗi: " . $e->getMessage();
            }
        } else {
            $message = "Thông tin không hợp lệ!";
        }
        $users = User::getAll();
        include "User/list_user.php";
        break;

                   /////////////////////////////////////////////////////////// Bình luận
            case "list_comments":
                $comments = Comment::getAll();
                include "Comment/list_comments.php";
                break;

            case "archive_comment":
                $comments = Comment::getArchived();
                include "Comment/archive_comment.php";
                break;

            case "delete_comment":
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    Comment::softDelete($_GET['id']);
                    $message = "Bình luận đã được chuyển vào kho lưu trữ.";
                }
                $comments = Comment::getAll();
                include "Comment/list_comments.php";
                break;

            case "restore_comment":
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    Comment::restore($_GET['id']);
                    $message = "Bình luận đã được khôi phục.";
                }
                $comments = Comment::getArchived();
                include "Comment/archive_comment.php";
                break;
            ///////////////////////////////////////////////////////////////////// Đơn hàng 
                case "list_order":
                    // Hiển thị danh sách đơn hàng
                    $orders = $order->getAll();
                    include "Order/list_order.php";
                    break;
        
                    case 'edit_order':
                        $id = $_GET['id'] ?? 0;
                        require_once 'Order/edit_order.php';  // Hiển thị giao diện chỉnh sửa đơn hàng
                        break;
                    
                        case 'update_order':
                            $orderId = $_POST['id'] ?? 0;
                            $statusId = $_POST['status_id'] ?? null;
                            $paymentStatus = $_POST['payment_status'] ?? null;
                            $shippingStatus = $_POST['shipping_status'] ?? null;
                            
                            if ($orderModel->updateOrder($orderId, $statusId, $paymentStatus, $shippingStatus)) {
                                $_SESSION['message'] = "Cập nhật đơn hàng thành công!";
                            } else {
                                $_SESSION['message'] = "Cập nhật thất bại!";
                            }
                            
                            header("Location: index.php?act=list_order");
                            break;                             

        ////////////////////////////////////////////////////////////////////////// Danh sách mã giảm giá
        case "list_discount":
            $discount_codes = DiscountCode::getAll();
            include "Discount_code/list_discount.php";
            break;

        // Thêm mới mã giảm giá
        case "add_discount":
            if (isset($_POST['submit'])) {
                $code = $_POST['code'] ?? '';
                $discount_percent = $_POST['discount_percent'] ?? null;
                $start_date = $_POST['start_date'] ?? null;
                $expiry_date = $_POST['expiry_date'] ?? null;
                if (!empty($code) && !is_null($discount_percent) && !is_null($start_date) && !is_null($expiry_date)) {
                    try {
                        DiscountCode::add($code, $discount_percent, $start_date, $expiry_date);
                        $_SESSION['message'] = "Thêm mã giảm giá thành công!";
                        header("Location: index.php?act=list_discount");
                        exit();
                    } catch (Exception $e) {
                        $error = "Có lỗi xảy ra: " . $e->getMessage();
                    }
                } else {
                    $error = "Vui lòng nhập đầy đủ thông tin!";
                }

                DiscountCode::add($code, $discount_percent, $start_date, $expiry_date);
                header("Location: index.php?act=list_discount");
            }
            include "Discount_code/add_discount.php";
            break;

        // Sửa mã giảm giá
        case 'edit_discount':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $id = $_POST['id'];
                $name = $_POST['code'];
                $discount_percent = $_POST['discount_percent'];
                $start_date = $_POST['start_date'];
                $expiry_date = $_POST['expiry_date'];
                $is_active = isset($_POST['is_active']) ? 1 : 0;
        
                DiscountCode::update($id, $name, $discount_percent, $expiry_date, $is_active);
        
                $_SESSION['message'] = "Mã giảm giá đã được cập nhật.";
                header("Location: index.php?act=list_discount");
                exit();
            }
        
            $id = $_GET['id'];
            $discount_code = DiscountCode::getOne($id);
            include 'Discount_code/edit_discount.php';
            break;

            // chuyển trạng thái
            case 'toggle_status':
                $id = $_GET['id'];
                $status = $_GET['status'];
                DiscountCode::toggleStatus($id, $status);
            
                $_SESSION['message'] = "Trạng thái mã giảm giá đã được cập nhật.";
                header("Location: index.php?act=list_discount");
                exit();
        

        // Xóa mềm mã giảm giá
        case "delete_discount":
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                DiscountCode::softDelete($id);
                header("Location: index.php?act=list_discount");
            }
            break;

        // Lưu trữ mã giảm giá
        case "archive_discount":
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                DiscountCode::archive($id);
                header("Location: index.php?act=list_discount");
            }
            include 'Discount_code/archive_discount.php';
            break;

        // Khôi phục mã giảm giá
        case "restore_discount":
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                DiscountCode::restore($id);
                header("Location: index.php?act=list_discount");
            }
            break;
        

        default:
        $orders = $order->getAll();
            include "home.php";
            break;
    }
} else {
    $orders = $order->getAll();
    include "home.php";
}

include "footer.php";
ob_end_flush();
?>