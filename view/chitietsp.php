<!-- Breadcrumb area Start -->
<section class="page-title-area bg-color" data-bg-color="#f4f4f4">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="page-title">Chi tiết sản phẩm</h1>
                <ul class="breadcrumb">
                    <li><a href="index.php">Trang chủ</a></li>
                    <li class="current"><span>Chi tiết sản phẩm</span></li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb area End -->

<!-- Main Content Wrapper Start -->
<div class="main-content-wrapper">
    <div class="page-content-inner pt--80 pt-md--60">
        <div class="container">
            <div class="row g-0 mb--80 mb-md--57">
                <div class="col-lg-7 product-main-image">
                    <div class="product-image">
                        <div class="product-gallery vertical-slide-nav">
                            <div class="product-gallery__large-image mb-sm--30">
                                <div class="product-gallery__wrapper">
                                    <div class="element-carousel main-slider image-popup" data-slick-options='{
                                                "slidesToShow": 1,
                                                "slidesToScroll": 1,
                                                "infinite": true,
                                                "arrows": false, 
                                                "asNavFor": ".nav-slider"
                                            }'>
                                        <div class="item">
                                            <figure class="product-gallery__image ">
                                                <img src=<?=$img_path.$product_image?> alt="Product">
                                                <span class="product-badge sale">Sale</span>
                                            </figure>
                                        </div>
                                        <div class="item">
                                            <figure class="product-gallery__image zoom">
                                                <img src=<?=$img_path.$product_image?> alt="Product">
                                                <span class="product-badge sale">Sale</span>
                                            </figure>
                                        </div>
                                        <div class="item">
                                            <figure class="product-gallery__image zoom">
                                                <img src="<?=$img_path.$product_image?>" alt="Product">
                                                <span class="product-badge sale">Sale</span>
                                            </figure>
                                        </div>
                                        <div class="item">
                                            <figure class="product-gallery__image zoom">
                                                <img src="<?=$img_path.$product_image?>" alt="Product">
                                                <span class="product-badge sale">Sale</span>
                                            </figure>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-gallery__nav-image">
                                <div class="element-carousel nav-slider product-slide-nav slick-center-bottom"
                                    data-slick-options='{
                                            "spaceBetween": 10,
                                            "slidesToShow": 3,
                                            "slidesToScroll": 1,
                                            "vertical": true,
                                            "swipe": true,
                                            "verticalSwiping": true,
                                            "infinite": true,
                                            "focusOnSelect": true,
                                            "asNavFor": ".main-slider",
                                            "arrows": true, 
                                            "prevArrow": {"buttonClass": "slick-btn slick-prev", "iconClass": "fa fa-angle-up" },
                                            "nextArrow": {"buttonClass": "slick-btn slick-next", "iconClass": "fa fa-angle-down" }
                                        }' data-slick-responsive='[
                                            {
                                                "breakpoint":1200, 
                                                "settings": {
                                                    "slidesToShow": 2
                                                } 
                                            },
                                            {
                                                "breakpoint":992, 
                                                "settings": {
                                                    "slidesToShow": 3
                                                } 
                                            },
                                            {
                                                "breakpoint":767, 
                                                "settings": {
                                                    "slidesToShow": 4,
                                                    "vertical": false
                                                } 
                                            },
                                            {
                                                "breakpoint":575, 
                                                "settings": {
                                                    "slidesToShow": 3,
                                                    "vertical": false
                                                } 
                                            },
                                            {
                                                "breakpoint":480, 
                                                "settings": {
                                                    "slidesToShow": 2,
                                                    "vertical": false
                                                } 
                                            }
                                        ]'>
                                    <div class="item">
                                        <figure class="product-gallery__nav-image--single">
                                            <img src="<?=$img_path.$product_image?>" alt="Products">
                                        </figure>
                                    </div>
                                    <div class="item">
                                        <figure class="product-gallery__nav-image--single">
                                            <img src="<?=$img_path.$product_image?>" alt="Products">
                                        </figure>
                                    </div>
                                    <div class="item">
                                        <figure class="product-gallery__nav-image--single">
                                            <img src="<?=$img_path.$product_image?>" alt="Products">
                                        </figure>
                                    </div>
                                    <div class="item">
                                        <figure class="product-gallery__nav-image--single">
                                            <img src="<?=$img_path.$product_image?>" alt="Products">
                                        </figure>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 offset-xl-1 col-lg-5 product-main-details mt-md--50">
                    <div class="product-summary pl-lg--30 pl-md--0">
                        <form action="index.php?act=themgiohang" method="post" class="variation-form mb--20">
                            <h3 class="product-title mb--20"><?=htmlentities($name)?></h3>
                            <p class="product-short-description mb--20">
                                <?php echo htmlspecialchars($description); ?>
                            </p>
                            <div class="product-price-wrapper mb--25">
                                <span class="money"><?=number_format($price,0, ',', '.')?> VNĐ</span>
                            </div>
                            <div class="product-size-variations d-flex align-items-center mb-3">
                                <p class="variation-label me-3 mb-0">Size:</p>
                                <div class="product-size-variation variation-wrapper d-flex gap-2 flex-wrap">
                                    <?php foreach ($load__size as $size): ?>
                                    <?php extract($size); ?>
                                    <label
                                        class="btn btn-outline-primary btn-sm size-label <?php echo $namesize === 'S' ? 'active' : ''; ?>">
                                        <input type="radio" name="size"
                                            value="<?php echo htmlspecialchars($namesize); ?>" class="d-none"
                                            <?php echo $namesize === 'S' ? 'checked' : ''; ?> />
                                        <?php echo htmlspecialchars($namesize); ?>
                                    </label>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div
                                class="product-action d-flex flex-sm-row align-items-sm-center flex-column align-items-start mb--30">
                                <div class="quantity-wrapper d-flex align-items-center mr--30 mr-xs--0 mb-xs--30">
                                    <label class="quantity-label" for="pro-qty">Số Lượng:</label>
                                    <div class="quantity">
                                        <input type="number" class="quantity-input" name="sl" id="pro-qty" value="1"
                                            min="1">
                                    </div>
                                </div>
                                <input type="submit" name="themgiohang" value="Mua Hàng" class="btn btn-primary" />
                                <input type="hidden" name="id" value="<?=$category_id?>" />
                                <input type="hidden" name="tensp" value="<?=$name?>" />
                                <input type="hidden" name="gia" value="<?=$price?>" />
                                <input type="hidden" name="img" value="<?=$product_image?>" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="nav nav-tabs mb-4" id="product-tab" role="tablist">
                <button type="button" class="nav-link active" id="nav-description-tab" data-bs-toggle="tab"
                    data-bs-target="#nav-description" role="tab" aria-selected="true">
                    <span>Sản Phẩm Liên Quan</span>
                </button>
            </div>
            <div class="row">
                <?php
            foreach ($load__sp__cungloai as $cungloai) {
                extract($cungloai);
                $productLink = "index.php?act=chitietsp&id=" . htmlspecialchars($id);
                echo '
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="payne-product card h-100">
                        <div class="product__inner">
                            <div class="product__image">
                                <figure class="product__image--holder">
                                    <a href="' . $productLink . '">
                                        <img src="' . $img_path . $product_image . '" alt="Product" class="card-img-top">
                                    </a>
                                </figure>
                                <div class="product__action justify-content-center mt-2">
                                    <a href="' . $productLink . '" class="btn btn-outline-secondary btn-sm me-1" title="Xem nhanh">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="' . $productLink . '" class="btn btn-outline-secondary btn-sm me-1" title="Thêm vào yêu thích">
                                        <i class="fa fa-heart-o"></i>
                                    </a>
                                    <a href="' . $productLink . '" class="btn btn-outline-secondary btn-sm me-1" title="So sánh">
                                        <i class="fa fa-repeat"></i>
                                    </a>
                                    <a href="index.php?act=giohang" class="btn btn-outline-primary btn-sm" title="Mua ngay">
                                        <i class="fa fa-shopping-cart"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="product__info p-3">
                                <h5 class="product__title mb-2">
                                    <a href="' . $productLink . '" class="text-decoration-none text-dark">' . $name . '</a>
                                </h5>
                                <div class="product__price mb-2">
                                    <span class="fw-bold text-danger">' . number_format($price, 0, ',', '.') . '</span> <span class="text-muted">VND</span>
                                </div>
                                <div class="product__rating text-warning">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
            }
        ?>
            </div>
        </div>

    </div>


</div>