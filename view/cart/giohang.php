<!-- Breadcrumb area Start -->
<section class="page-title-area bg-color" data-bg-color="#f4f4f4">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="page-title">Giỏ Hàng</h1>
                <ul class="breadcrumb">
                    <li><a href="index.php">Trang chủ</a></li>
                    <li class="current"><span>Giỏ Hàng</span></li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb area End -->

<!-- Main Content Wrapper Start -->
<div class="main-content-wrapper">
    <div class="page-content-inner ptb--80 pt-md--40 pb-md--60">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form class="cart-form" action="#">
                        <div class="table-content table-responsive">
                            <table class="table text-center table-striped table-hover" style="border: 1px solid #ddd;">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>STT</th>
                                        <th>Ảnh sản phẩm</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Giá</th>
                                        <th>Số lượng</th>
                                        <th>Thành tiền</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($_SESSION['giohang']) && count($_SESSION['giohang']) > 0) {
                                        $i = 1; // Bắt đầu STT từ 1
                                        $tong = 0;
                                        foreach ($_SESSION['giohang'] as $index => $item) {
                                            // Đảm bảo dữ liệu tồn tại đầy đủ trước khi xử lý
                                            $image = isset($item[2]) ? htmlspecialchars($item[2]) : '';
                                            $name = isset($item[1]) ? htmlspecialchars($item[1]) : 'khong co ten san pham';
                                            $price = isset($item[3]) ? (float)$item[3] : 0;
                                            $quantity = isset($item[4]) ? (int)$item[4] : 0;
                                            $tt = $price * $quantity;
                                            $tong += $tt;
                                            echo '
                                                <tr>
                                                    <td>' . $i . '</td>
                                                    <td><img src="./upload/' . $image . '" alt="' . $name . '" style="width: 80px; height: auto; border-radius: 10px;"></td>
                                                    <td>' . $name . '</td>
                                                    <td>' . number_format($price, 0, ',', '.') . ' VNĐ</td>
                                                    <td>' . $quantity . '</td>
                                                    <td>' . number_format($tt, 0, ',', '.') . ' VNĐ</td>
                                                    <td>
                                                        <a href="index.php?act=xoagiohang&i=' . $index . '" class="btn btn-danger btn-sm" style="border-radius: 20px;">
                                                            <i class="fa fa-trash"></i> Xóa
                                                        </a>
                                                    </td>
                                                </tr>';
                                            $i++;
                                        }
                                        echo '
                                            <tr>
                                                <td colspan="5" class="text-right font-weight-bold" style="font-size: 18px;">Tổng Tiền:</td>
                                                <td colspan="2" class="text-left font-weight-bold text-danger" style="font-size: 18px;">' . number_format($tong, 0, ',', '.') . ' VNĐ</td>
                                            </tr>';
                                    } else {
                                        echo '
                                            <tr>
                                                <td colspan="7" class="text-center text-danger" style="font-size: 18px;">Chưa có gì trong giỏ hàng</td>
                                            </tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <div class=" justify-content-between align-items-center">
                            <a href="index.php" class="btn btn-warning btn-lg" style="border-radius: 20px;">
                                <i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;Tiếp tục mua hàng
                            </a>
                            <a href="index.php?act=xoagiohang" class="btn btn-danger btn-lg"
                                style="border-radius: 20px;">
                                <i class="fa fa-trash" aria-hidden="true"></i>&nbsp;Xóa tất cả
                            </a>
                            <a href="index.php?act=thanhtoan" class="btn btn-primary btn-lg"
                                style="border-radius: 20px;">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;Thanh toán
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Main Content Wrapper End -->