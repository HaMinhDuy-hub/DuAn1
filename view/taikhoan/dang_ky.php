<!-- Breadcrumb area Start -->
<section class="page-title-area bg-color" data-bg-color="#f4f4f4">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="page-title">Đăng Ký</h1>

            </div>
        </div>
    </div>
</section>
<div class="register-box">
    <h4 class="heading__tertiary mb--30">Đăng ký</h4>
    <form class="form form--login" method="POST">
        <div class="form__group mb--20">
            <label class="form__label" for="email">Email address <span class="required">*</span></label>
            <input type="email" class="form__input" id="email" name="email" required>
        </div>
        <div class="form__group mb--20">
            <label class="form__label" for="username">user <span class="required">*</span></label>
            <input type="text" class="form__input" id="username" name="username" required>
        </div>
        <div class="form__group mb--20">
            <label class="form__label" for="password">Password <span class="required">*</span></label>
            <input type="password" class="form__input" id="password" name="password" required>
        </div>
        <div class="form__group mb--20">
            <label class="form__label" for="password">Password 2 <span class="required">*</span></label>
            <input type="password" class="form__input" name="password2" required>
        </div>
        <div class="form__group">
            <input type="submit" class="btn btn-size-sm" name="dangky" value="Đăng ký">
        </div>
        <div class="singup_link">
            <p>Bạn đã có tài khoản? <a href="index.php?act=dang_nhap">Đăng nhập tại đây</a></p>
        </div>
    </form>
    <?php
            if(isset($thongbao) &&$thongbao!=""){
                echo $thongbao;
            }
        ?>
</div>
</div>