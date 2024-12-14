<section class="page-title-area bg-color" data-bg-color="#f4f4f4">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="page-title">Thanh Toán</h1>
                <ul class="breadcrumb">
                    <li><a href="index.php">Trang chủ</a></li>
                    <li class="current"><span>Thanh toán</span></li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Main Content Wrapper Start -->
<div class="main-content-wrapper">
    <div class="page-content-inner pt--80 pt-md--60 pb--72 pb-md--60">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- User Action Start -->
                    <div class="user-actions user-actions__coupon">
                        <div class="message-box mb--30">
                            <p><i class="fa fa-exclamation-circle"></i> Bạn có phiếu giảm giá không?<a
                                    class="expand-btn" href="#coupon_info"> Nhấp vào đây để nhập mã của bạn.</a></p>
                        </div>
                        <div id="coupon_info" class="user-actions__form hide-in-default">
                            <form action="#" class="form">
                                <p>Nếu bạn có mã giảm giá, vui lòng áp bên dưới.</p>
                                <div class="form__group d-sm-flex">
                                    <input type="text" name="coupon" id="coupon" class="form__input mr--20 mr-xs--0"
                                        placeholder="Coupon Code">
                                    <button type="submit" class="btn btn-size-sm">Áp dụng phiếu giảm giá</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- User Action End -->
                </div>
            </div>
            <div class="row flex-equal">
                <!-- Chi Tiết Thanh Toán -->
                <form action="index.php?act=thanhtoan" method="post" class="row flex-equal">

                    <!-- Đảm bảo giá trị $tong được in đúng -->
                    <div class="col-lg-6 col-xl-6">
                        <div class="checkout-title mt--10">
                            <h2>Chi Tiết Thanh Toán</h2>
                        </div>
                        <div class="checkout-form">
                            <div class="row mb--20">
                                <div class="form__group col-12">
                                    <label for="billing_name" class="form__label">Họ Tên <span
                                            class="required">*</span></label>
                                    <input type="text" name="customer_name" id="customer_name"
                                        class="form__input mb--30" placeholder="Nhập họ tên của bạn" required>
                                </div>
                            </div>
                            <div class="row mb--20">
                                <div class="form__group col-12">
                                    <label for="billing_streetAddress" class="form__label">Địa Chỉ <span
                                            class="required">*</span></label>
                                    <input type="text" name="shipping_address" id="shipping_address"
                                        class="form__input mb--30" placeholder="Nhập địa chỉ của bạn" required>
                                </div>
                            </div>
                            <div class="row mb--20">
                                <div class="form__group col-12">
                                    <label for="billing_phone" class="form__label">Số Điện thoại <span
                                            class="required">*</span></label>
                                    <input type="text" name="customer_phone" id="customer_phone" class="form__input"
                                        placeholder="Nhập số điện thoại của bạn" required>
                                </div>
                            </div>
                            <div class="row mb--20">
                                <div class="form__group col-12">
                                    <label for="customer_email" class="form__label">Email <span
                                            class="required">*</span></label>
                                    <input type="email" name="customer_email" id="customer_email" class="form__input"
                                        placeholder="Nhập email của bạn" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Đơn Hàng của bạn -->
                    <div class="col-lg-6 col-xl-6">
                        <div class="order-details">
                            <div class="checkout-title mt--10">
                                <h2>Đơn Hàng của bạn</h2>
                            </div>
                            <div class="table-content table-responsive mb--30">
                                <table class="table order-table order-table-2">
                                    <?php
                                        if (isset($_SESSION['giohang']) && count($_SESSION['giohang']) > 0) {
                                            $tong = 0;
                                            foreach ($_SESSION['giohang'] as $item) {
                                                $name = isset($item[1]) ? htmlspecialchars($item[1]) : 'không có tên sản phẩm';
                                                $price = isset($item[3]) ? (float)$item[3] : 0;
                                                $quantity = isset($item[4]) ? (int)$item[4] : 0;
                                                
                                                $total = $price * $quantity;
                                                $tong += $total;
                                                echo '
                                                    <tbody>
                                                        <tr>
                                                            <th>' . $name . ' <strong><span>&#10005;</span>' . $quantity . '</strong></th>
                                                            <td class="text-end">' . number_format($total, 0, ',', '.') . ' VNĐ</td>
                                                        </tr>
                                                    </tbody>
                                                ';
                                            }
                                        }
                                    ?>
                                    <tfoot>
                                        <tr class="order-total">
                                            <th>Tổng Đơn Hàng</th>
                                            <td class="text-end"><span
                                                    class="order-total-ammount"><?= number_format($tong, 0, ',', '.') ?>
                                                    VNĐ</span></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="checkout-payment">
                                <div class="payment-group mb--10">
                                    <div class="payment-radio">
                                        <input type="radio" value="momo" name="payment_method" id="momo">
                                        <label class="payment-label" for="momo">Thanh toán qua momo</label>
                                    </div>
                                </div>
                                <div class="payment-group mb--10">
                                    <div class="payment-radio">
                                        <input type="radio" value="cash" name="payment_method" id="cash">
                                        <label class="payment-label" for="cash">Thanh toán khi giao hàng</label>
                                    </div>
                                </div>
                                <div class="payment-group mt--20">
                                    <input type="submit" class="btn btn-size-md btn-fullwidth" value="Đặt Hàng"
                                        name="thanhtoan">
                                </div>
                                <input type="hidden" name="total_price" value="<?= $tong ?>">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Main Content Wrapper End -->