<section class="page-title-area bg-color" data-bg-color="#f4f4f4">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="page-title">Đăng nhập</h1>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb area End -->

<!-- Main Content Wrapper Start -->
<div class="main-content-wrapper">
    <div class="page-content-inner pt--75 pb--80">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-sm--50">
                    <div class="login-box">
                        <h3 class="heading__tertiary mb--30">Đăng nhập</h3>
                        <form class="form form--login" method="POST" action="index.php?act=dang_nhap">
                            <div class="form__group mb--20">
                                <label class="form__label" for="username">Username or email address <span
                                        class="required">*</span></label>
                                <input type="text" class="form__input" id="username" name="username">
                            </div>
                            <div class="form__group mb--20">
                                <label class="form__label" for="password">Password <span
                                        class="required">*</span></label>
                                <input type="password" class="form__input" id="password" name="password">
                            </div>
                            <div class="d-flex align-items-center mb--20">
                                <div class="form__group mr--30">
                                    <button type="submit" class="btn btn-size-sm" name="dang_nhap" >Đăng nhập</button>
                                </div>
                                <div class="form__group">
                                    <label class="form__label checkbox-label" for="store_session">
                                        <input type="checkbox" name="store_session" id="store_session">
                                        <span>Remember me</span>
                                    </label>
                                </div>
                                <h2 class="thongbao">
                <?php 
                  if(isset($thongbao) && ($thongbao!="")){
                    echo $thongbao;
                  }         
                ?>
                            </div>
                            <a class="forgot-pass" href="#">Lost your password?</a>
                        </form>
                    </div>
                    <script>
        function validateForm() {
            var passwordInput = document.getElementById("password");
            var passwordValue = passwordInput.value;

            // Kiểm tra độ dài của mật khẩu
            if (passwordValue.length < 6) {
                alert("Mật khẩu chứa ít nhất 6 ký tự.");
                return false;
            }

            // Kiểm tra có ít nhất 1 ký tự viết in hoa
            if (!/[A-Z]/.test(passwordValue)) {
                alert("Mật khẩu chứa ít nhất 1 ký tự viết in hoa.");
                return false;
            }

            // Mật khẩu hợp lệ
            return true;
        }
    </script>
                </div>