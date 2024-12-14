<?php
require_once '../model/Product.php';
require_once '../model/Category.php';
require_once '../model/Comment.php';
require_once '../model/Order.php';
require_once '../model/User.php';
// Đảm bảo file  được import

// Hiển thị số đếm
$totalCategories = Category::countCategories();
$totalProducts = Product::countProducts();
$totalComments = Comment::countComments();
$totalOrders = Order::countOrders();
$totalUsers = User::countUsers();
?>
<div class="content-wrapper">
<div class="box-header with-border">
            <h2 class="box-title">
                    <!-- Thêm icon vào trước tiêu đề -->
                    <i class="nav-icon fas fa-tachometer-alt"></i> Dashboard</h2>
            </div>
<div class="row">
    <!-- Small boxes -->
    <div class="col-lg-4 col-6">
        <!-- Danh mục -->
        <div class="small-box bg-info">
            <div class="inner">
            <h3><?= isset($totalCategories) ? $totalCategories : '0'; ?></h3>
                <p>Danh Mục</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="index.php?act=list_categories" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-4 col-6">
        <!-- Sản phẩm -->
        <div class="small-box bg-success">
            <div class="inner">
            <h3><?= $totalProducts ?></h3>
                <p>Sản Phẩm</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="index.php?act=list_product" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-4 col-6">
        <!-- Đơn hàng -->
        <div class="small-box bg-warning">
            <div class="inner">
            <h3><?= $totalOrders ?></h3>
                <p>Đơn Hàng</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="index.php?act=list_order" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

<div class="row">
    <!-- 3 ô nhỏ dưới -->
    <div class="col-lg-4 col-6">
        <!-- Người dùng -->
        <div class="small-box bg-danger">
            <div class="inner">
            <h3><?= $totalUsers ?></h3>
                <p>Người Dùng</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="index.php?act=list_user" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-4 col-6">
        <!-- Khuyến mãi -->
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>20</h3>
                <p>Khuyến Mãi</p>
            </div>
            <div class="icon">
                <i class="ion ion-gift"></i>
            </div>
            <a href="index.php?act=list_discount" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-4 col-6">
        <!-- Bình luận -->
        <div class="small-box bg-secondary">
            <div class="inner">
            <h3><?= $totalComments ?></h3>
                <p>Bình luận</p>
            </div>
            <div class="icon">
                <i class="ion ion-chatbox"></i>
            </div>
            <a href="index.php?act=list_comments" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>
<!-- Large box for statistics and revenue -->
<div class="row">
    <div class="col-lg-12">
        <div class="box box-solid">
            <div class="box-header with-border">
            <h2 class="box-title">
                    <!-- Thêm icon vào trước tiêu đề -->
                    <i class="fas fa-chart-bar"></i> Thống Kê và Doanh Thu
                </h2>
            </div>
            <div class="box-body">
                <!-- Thống kê sản phẩm -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="info-box bg-info">
                            <span class="info-box-icon"><i class="ion ion-bag"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Thống Kê Sản Phẩm</span>
                            </div>
                        </div>
                    </div>

                    <!-- Bảng thống kê sản phẩm bán chạy -->
                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên Sản Phẩm</th>
                                    <th>Số Lượng Bán</th>
                                    <th>Số Người Mua</th>
                                    <th>Tổng Tiền Thu Được</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Ví dụ sản phẩm bán chạy, bạn sẽ thay bằng dữ liệu động -->
                                <tr>
                                    <td>1</td>
                                    <td>Sản phẩm A</td>
                                    <td>200</td>
                                    <td>150</td>
                                    <td>5,000,000 VNĐ</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Sản phẩm B</td>
                                    <td>180</td>
                                    <td>120</td>
                                    <td>4,500,000 VNĐ</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Sản phẩm C</td>
                                    <td>150</td>
                                    <td>100</td>
                                    <td>3,750,000 VNĐ</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Thống kê doanh thu -->
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="info-box bg-success">
                            <span class="info-box-icon"><i class="ion ion-social-usd"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Thống Kê Doanh Thu</span>
                            </div>
                        </div>
                    </div>

                    <!-- Bảng thống kê doanh thu -->
                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Tổng Số Lượng Sản Phẩm Đã Bán</th>
                                    <th>Tổng Doanh Thu Tháng Này</th>
                                    <th>Số Đơn Hàng Đã Giao Thành Công</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>530</td>
                                    <td>15,000,000 VNĐ</td>
                                    <td>500</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
