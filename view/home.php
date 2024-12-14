<!-- Main Content Wrapper Start -->
<?php
$html_new_sampham='';
foreach ($dssp_new as $item) {
    extract($item);
    $html_new_sampham.='<div class="col-lg-3 col-md-4 col-sm-6 mb--65 mb-md--50">
                    <div class="payne-product">
                        <div class="product__inner">
                            <div class="product__image">
                            <form action="index.php?act=themgiohang" method="post">
                                <figure class="product__image--holder">
                                <a href="index.php?act=chitietsp&id='.$id.'">
                                <img src="'.$img_path.$product_image.'" alt="Product">
                                </a>
                                     
                                </figure>
                                <a href="index.php?act=chitietsp" class="product-overlay"></a>
                                <div class="product__action">
                                    
                                     <a href="index.php?act=chitietsp&id='.$id.'" class="action-btn">
                                        <i class="fa fa-eye"></i>
                                        <span class="sr-only">Quick view</span>
                                    </a>
                                    <a href="index.php?act=chitietsp&id='.$id.'" class="action-btn">
                                        <i class="fa fa-heart-o"></i>
                                        <span class="sr-only">Add to wishlist</span>
                                    </a>
                                    <a href="index.php?act=chitietsp&id='.$id.'" class="action-btn">
                                        <i class="fa fa-repeat"></i>
                                        <span class="sr-only">Add To Compare</span>
                                    </a>
                                    <a href="index.php?act=giohang" class="action-btn" name="themgiohang">
                                        <i class="fa fa-shopping-cart"></i>
                                        <span class="sr-only">Add To Cart</span>
                                    </a>
                                </div>
                            </div>
                            <div class="product__info">
                                <div class="product__info--left">
                                    <h3 class="product__title">
                                        <a href="index.php?act=chitietsp">'.$name.'</a>
                                    </h3>
                                    <div class="product__price">
                                        <span class="money">'.number_format($price, 0, ',', '.').'</span>
                                        <span class="sign">VNĐ</span>
                                    </div>
                                </div>
                                <div class="product__info--right">
                                    <span class="product__rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </span>
                                </div>
                            </div>
                            <div >
                                <input type="submit" name="themgiohang" value="Mua Hàng" class="btn btn-primary"/>
                            </div>
                            <input type="hidden" name="id" value="'.$id.'"/>
                            <input type="hidden" name="tensp" value="'.$name.'"/>
                            <input type="hidden" name="gia" value="'.$price.'"/>
                            <input type="hidden" name="img" value="'.$product_image.'"/>
                            
                            </form>
                        </div>
                    </div>
                </div>';
}

?>

<main class="main-content-wrapper">
    <!-- Slider area Start -->
    <section class="homepage-slider mb--11pt5">
        <div class="element-carousel slick-right-bottom" data-slick-options='{
                    "slidesToShow": 1, 
                    "dots": true
                }'>
            <div class="item">
                <div class="single-slide height-2 d-flex align-items-center bg-image"
                    data-bg-image="img/slider/slider-bg-02.jpg">
                    <div class="container">
                        <div class="row align-items-center g-0 w-100">
                            <div class="col-lg-6 col-md-8">
                                <div class="slider-content py-0">
                                    <div class="slider-content__text mb--95 md-lg--80 mb-md--40 mb-sm--15">
                                        <h3 class="text-uppercase font-weight-light" data-animation="fadeInUp"
                                            data-duration=".3s" data-delay=".3s">AMAZING PRODUCT!</h3>
                                        <h1 class="heading__primary mb--40 mb-md--20" data-animation="fadeInUp"
                                            data-duration=".3s" data-delay=".3s">BACKPACK</h1>
                                        <p class="font-weight-light" data-animation="fadeInUp" data-duration=".3s"
                                            data-delay=".3s">Neque porro quisquam est, qui
                                            dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed
                                            quia non numquam eius modi
                                            tempora Neque porro quisquam est, qui dolorem ipsum</p>
                                    </div>
                                    <div class="slider-content__btn">
                                        <a href="index.php?act=sanpham" class="btn-link" data-animation="fadeInUp"
                                            data-duration=".3s" data-delay=".6s">Shop Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 offset-lg-1 col-md-4">
                                <figure class="slider-image d-none d-md-block">
                                    <img src="img/slider/slider-image-02.png" alt="Slider Image">
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="single-slide height-2 d-flex align-items-center bg-image"
                    data-bg-image="img/slider/slider-bg-02.jpg">
                    <div class="container">
                        <div class="row align-items-center g-0 w-100">
                            <div class="col-lg-6 col-md-8">
                                <div class="slider-content py-0">
                                    <div class="slider-content__text mb--95 md-lg--80 mb-md--40 mb-sm--15">
                                        <h3 class="text-uppercase font-weight-light" data-animation="fadeInUp"
                                            data-duration=".3s" data-delay=".3s">AMAZING PRODUCT!</h3>
                                        <h1 class="heading__primary mb--40 mb-md--20" data-animation="fadeInUp"
                                            data-duration=".3s" data-delay=".3s">BACKPACK</h1>
                                        <p class="font-weight-light" data-animation="fadeInUp" data-duration=".3s"
                                            data-delay=".3s">Neque porro quisquam est, qui
                                            dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed
                                            quia non numquam eius modi
                                            tempora Neque porro quisquam est, qui dolorem ipsum</p>
                                    </div>
                                    <div class="slider-content__btn">
                                        <a href="shop.html" class="btn-link" data-animation="fadeInUp"
                                            data-duration=".3s" data-delay=".6s">Shop Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 offset-lg-2 col-md-4">
                                <figure class="slider-image d-none d-md-block">
                                    <img src="img/slider/slider-image-01.png" alt="Slider Image">
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Slider area End -->

    <!-- Product Area Start -->
    <section class="product-area mb--50 mb-xl--40 mb-lg--25 mb-md--30 mb-sm--20">
        <div class="container">
            <div class="row mb--42">
                <div class="col-xl-5 col-lg-6 col-sm-10">
                    <h2 class="heading__secondary">SẢN PHẨM MỚI</h2>
                </div>
            </div>
            <div class="row">
                <?=$html_new_sampham?>
            </div>