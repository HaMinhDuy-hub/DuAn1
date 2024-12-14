<!-- Breadcrumb area Start -->
<section class="page-title-area bg-color" data-bg-color="#f4f4f4">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="page-title">Sản phẩm</h1>
                <ul class="breadcrumb">
                    <li><a href="index.php">Trang chủ</a></li>
                    <li class="current"><span>sản phảm</span></li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb area End -->

<!-- Main Content Wrapper Start -->
<div class="main-content-wrapper">
    <div class="shop-page-wrapper ptb--80">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 col-lg-8 order-lg-2 mb-md--50">
                    <div class="shop-toolbar mb--50">
                        <div class="row align-items-center">
                            <div class="col-md-5 mb-sm--30 mb-xs--10">
                                <div class="shop-toolbar__left">
                                    <div class="product-ordering">
                                        <select class="product-ordering__select nice-select"
                                            onchange="location = this.value;">
                                            <?php 
                                                foreach ($list_danhmuc as $danhmuc) {
                                                    extract($danhmuc);
                                                    echo '<option value="index.php?act=sanpham&category_id='.$id.'">'.$name.'</option>';
                                                }
                                                ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="shop-toolbar__right">
                                    <div class="product-view-mode ml--50 ml-xs--0">
                                        <a class="active" href="#" data-target="grid">
                                            <img src="img/icons/grid.png" alt="Grid">
                                        </a>
                                        <a href="#" data-target="list">
                                            <img src="img/icons/list.png" alt="Grid">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="shop-products">
                        <div class="row">
                            <?php
                            foreach ($list_sp_danhmuc as $sp_danhmuc ) {
                                extract($sp_danhmuc);
                                echo'     <div class="col-xl-3 col-sm-6 mb--50">
                                <div class="payne-product">
                                    <div class="product__inner">
                                        <div class="product__image">
                                            <figure class="product__image--holder">
                                                <a href="index.php?act=chitietsp&id='.$id.'">
                                                    <img src="'.$img_path.$product_image.'" alt="Product">
                                                </a>
                                            </figure>
                                            <a href="index.php?act=chitietsp&id='.$id.'" class="product__overlay"></a>
                                            <div class="product__action">
                                                <a href="index.php?act=chitietsp&id='.$id.'" class="action-btn">
                                                   <i class="fa fa-eye"></i>
                                                    <span class="sr-only">Add to wishlist</span>
                                                </a>
                                                <a href="index.php?act=chitietsp&id='.$id.'" class="action-btn">
                                                    <i class="fa fa-heart-o"></i>
                                                    <span class="sr-only">Add to wishlist</span>
                                                </a>
                                                <a href="index.php?act=chitietsp&id='.$id.'"class="action-btn">
                                                    <i class="fa fa-repeat"></i>
                                                    <span class="sr-only">Add To Compare</span>
                                                </a>
                                                <a href="index.php?act=giohang" class="action-btn" >
                                                    <i class="fa fa-shopping-cart"></i>
                                                    <span class="sr-only">Add To Cart</span>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="product__info">
                                            <div class="product__info--left">
                                                <h3 class="product__title">
                                                    <a href="index.php?act=chitietsp&id='.$id.'">'.$name.'</a>
                                                </h3>
                                                <div class="product__price">
                                                    <span class="money">'. number_format($price, 0, ',', '.') . '</span>
                                                    <span class="sign">VND</span>
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
                                    </div>
                                </div>
                            </div>';
                       }
                       ?>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 order-lg-1">
                    <aside class="shop-sidebar">
                        <div class="shop-widget mb--40">
                            <h3 class="widget-title mb--25">Danh Mục Sản Phẩm</h3>
                            <ul class="widget-list category-list">
                                <?php 
                                foreach ($list_danhmuc as $danhmuc) {
                                    extract($danhmuc);
                                    echo' 
                                    <li>
                                    <a href="index.php?act=sanpham&category_id='.$id.'">
                                        <span class="category-title">'.$name.'</span>
                                        <i class="fa fa-angle-double-right"></i>
                                    </a>
                                    </li>';
                                }
                                ?>
                            </ul>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Main Content Wrapper Start -->