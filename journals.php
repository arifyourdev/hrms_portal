<?php
require_once "admin/private/initialize.php";
?>
<!doctype html>
<html class="no-js" lang="zxx">
 <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Journals  | Madhubunbooks</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicons -->
       <?php include 'includes/head.php' ?>
 
</head>

<body>
 
<!-- Main wrapper -->
<div class="wrapper" id="wrapper">

    <!-- Header -->
       <?php include 'includes/header.php' ?>
    <!-- //Header -->
    <!-- Start Search Popup -->
    <div class="box-search-content search_active block-bg close__top">
        <form id="search_mini_form" class="minisearch" action="#">
            <div class="field__search">
                <input type="text" placeholder="Search entire store here...">
                <div class="action">
                    <a href="#"><i class="zmdi zmdi-search"></i></a>
                </div>
            </div>
        </form>
        <div class="close__wrap">
            <span>close</span>
        </div>
    </div>
    <!-- End Search Popup -->
    
    <!-- Start Shop Page -->
    <div class="page-shop-sidebar left--sidebar bg--white section-padding--lg">
        <div class="container">
            <div class="row">
                 <div class="col-lg-12 col-12 order-1 order-lg-2">
                    <div class="row">
                        <div class="col-lg-12 pages-mb">
                             <h5 class="pages-t">Journals</h5>
                             <div style="border-bottom:3px solid #a32c4c;width:8%;"></div>
                        </div>
                    </div>
                    <div class="tab__container tab-content">
                        <div class="shop-grid tab-pane fade show active" id="nav-grid" role="tabpanel">
                            <div class="row">
                                <!-- Start -->
                                <?php $magazine_sql = BookMagazine::find_by_order();
                                foreach($magazine_sql as $magazine){
                                ?>
                                <div class="product product__style--3 col-lg-3 col-md-4 col-sm-6 col-12">
                                  <div class="product__style--detail">
                                    <div class="product__thumb product__thumb__ ">
                                        <a class="first__imgs" href="admin/images/magazine_images/<?php echo $magazine->magazine_pdf?>" download>
                                              <img src="admin/<?php echo $magazine->picture_path()?>">
                                        <div class="hot__box">
                                            <?php if($magazine->magazine_as_new == 1){?>
                                            <span class="hot-label">New</span>
                                            <?php } else { ?>
                                            <span class="hot-label"></span>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="product__contents">
                                        <h4><a href=""><?php echo $magazine->magazine_title?></a></h4>
                                     </div>
                                     
                                     <div class="pages-veiw-btn text-center">
                                        <a href="admin/images/magazine_images/<?php echo $magazine->magazine_pdf?>" class="view-button download_m" target="blank" download>Download <i class="fa fa-file" aria-hidden="true"></i></a>
                                        <a href="admin/images/magazine_images/<?php echo $magazine->magazine_pdf?>" target="blank_" class="view-button download_m">View <i class="fa fa-file" aria-hidden="true"></i></a>
                                      </div>
                                  </div>
                                </div>
                                <?php } ?>
                                
                                 
                                 
                            </div>
                             
                        </div>
                         
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Shop Page -->

    <!-- Footer Area -->
     <?php include 'includes/footer.php' ?>
    <!-- //Footer Area -->
    <!-- QUICKVIEW PRODUCT -->
    <div id="quickview-wrapper">
        <!-- Modal -->
        <div class="modal fade" id="productmodal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal__container" role="document">
                <div class="modal-content">
                    <div class="modal-header modal__header">
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-product">
                            <!-- Start product images -->
                            <div class="product-images">
                                <div class="main-image images">
                                    <img alt="big images" src="images/product/big-img/1.jpg">
                                </div>
                            </div>
                            <!-- end product images -->
                            <div class="product-info">
                                <h1>Simple Fabric Bags</h1>
                                <div class="rating__and__review">
                                    <ul class="rating">
                                        <li><span class="ti-star"></span></li>
                                        <li><span class="ti-star"></span></li>
                                        <li><span class="ti-star"></span></li>
                                        <li><span class="ti-star"></span></li>
                                        <li><span class="ti-star"></span></li>
                                    </ul>
                                    <div class="review">
                                        <a href="#">4 customer reviews</a>
                                    </div>
                                </div>
                                <div class="price-box-3">
                                    <div class="s-price-box">
                                        <span class="new-price">$17.20</span>
                                        <span class="old-price">$45.00</span>
                                    </div>
                                </div>
                                <div class="quick-desc">
                                    Designed for simplicity and made from high quality materials. Its sleek geometry
                                    and material combinations creates a modern look.
                                </div>
                                <div class="select__color">
                                    <h2>Select color</h2>
                                    <ul class="color__list">
                                        <li class="red"><a title="Red" href="#">Red</a></li>
                                        <li class="gold"><a title="Gold" href="#">Gold</a></li>
                                        <li class="orange"><a title="Orange" href="#">Orange</a></li>
                                        <li class="orange"><a title="Orange" href="#">Orange</a></li>
                                    </ul>
                                </div>
                                <div class="select__size">
                                    <h2>Select size</h2>
                                    <ul class="color__list">
                                        <li class="l__size"><a title="L" href="#">L</a></li>
                                        <li class="m__size"><a title="M" href="#">M</a></li>
                                        <li class="s__size"><a title="S" href="#">S</a></li>
                                        <li class="xl__size"><a title="XL" href="#">XL</a></li>
                                        <li class="xxl__size"><a title="XXL" href="#">XXL</a></li>
                                    </ul>
                                </div>
                                <div class="social-sharing">
                                    <div class="widget widget_socialsharing_widget">
                                        <h3 class="widget-title-modal">Share this product</h3>
                                        <ul class="social__net social__net--2 d-flex justify-content-start">
                                            <li class="facebook"><a href="#" class="rss social-icon"><i
                                                    class="zmdi zmdi-rss"></i></a></li>
                                            <li class="linkedin"><a href="#" class="linkedin social-icon"><i
                                                    class="zmdi zmdi-linkedin"></i></a></li>
                                            <li class="pinterest"><a href="#" class="pinterest social-icon"><i
                                                    class="zmdi zmdi-pinterest"></i></a></li>
                                            <li class="tumblr"><a href="#" class="tumblr social-icon"><i
                                                    class="zmdi zmdi-tumblr"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="addtocart-btn">
                                    <a href="#">Add to cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END QUICKVIEW PRODUCT -->

</div>
<!-- //Main wrapper -->

  <?php include 'includes/foot.php' ?>

</body>
 </html>