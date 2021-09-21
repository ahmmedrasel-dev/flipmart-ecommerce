@extends('frontend.front-master')
@section('content')
    <div class="body-content outer-top-xs" id="top-banner-and-menu">
        <div class="container">
            <div class="row">
                <!-- ============================================== SIDEBAR ============================================== -->
                <div class="col-xs-12 col-sm-12 col-md-3 sidebar">
                    <!-- ================================== TOP NAVIGATION ================================== -->
                    <div class="side-menu animate-dropdown outer-bottom-xs">
                        <div class="head"><i class="icon fa fa-align-justify fa-fw"></i> Categories</div>
                        <nav class="yamm megamenu-horizontal">
                            <ul class="nav">
                                @foreach ($categories as $itemcategory)
                                    <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle"
                                            data-toggle="dropdown"><i class="icon {{ $itemcategory->icon }}"
                                                aria-hidden="true"></i>{{ $itemcategory->name }}</a>
                                        <!-- ================================== MEGAMENU VERTICAL ================================== -->
                                        <ul class="dropdown-menu mega-menu">
                                            <li class="yamm-content">
                                                <div class="row">
                                                    @foreach ($itemcategory->subcategory as $itemsub)
                                                        <div class="col-xs-12 col-sm-12 col-lg-4">
                                                            <h2 class="title">{{ ucwords($itemsub->name) }}</h2>
                                                            @foreach ($itemsub->subsubcategory as $itemchild)
                                                                <ul>
                                                                    <li><a href="#">{{ $itemchild->name }}</a></li>
                                                                </ul>
                                                            @endforeach
                                                        </div>
                                                    @endforeach
                                                    {{-- <div class="dropdown-banner-holder"> <a href="#"><img alt="" src="{{ asset('front-assets/images/banners/banner-side.png') }}" /></a> </div> --}}
                                                </div>
                                                <!-- /.row -->
                                            </li>
                                            <!-- /.yamm-content -->
                                        </ul>
                                        <!-- /.dropdown-menu -->
                                        <!-- ================================== MEGAMENU VERTICAL ================================== -->
                                    </li>
                                    <!-- /.menu-item -->
                                @endforeach
                            </ul>
                            <!-- /.nav -->
                        </nav>
                        <!-- /.megamenu-horizontal -->
                    </div>
                    <!-- /.side-menu -->
                    <!-- ================================== TOP NAVIGATION : END ================================== -->

                    <!-- ============================================== HOT DEALS ============================================== -->
                    <div class="sidebar-widget hot-deals wow fadeInUp outer-bottom-xs">
                        <h3 class="section-title">hot deals</h3>
                        <div class="owl-carousel sidebar-carousel custom-carousel owl-theme outer-top-ss">
                            @foreach ( $hotDealsProducts as $productItem)
                                <div class="item">
                                    <div class="products">
                                        <div class="hot-deal-wrapper">
                                            <div class="image"> <img  src="{{ asset($productItem->thmbnail) }}" alt="">
                                            </div>
                                                @php
                                                    $discount = (($productItem->selling_price - $productItem->descount_price) / $productItem->selling_price) * 100;
                                                @endphp
                                                @if ($productItem->descount_price !== null)
                                                    <div class="sale-offer-tag">
                                                        <span>{{ round($discount) }}%<br>
                                                            off</span>
                                                    </div>
                                                @endif
                                            <div class="timing-wrapper">

                                                <div class="box-wrapper">
                                                    <div class="date box"> <span class="key abmshawon" data-name="counterdownday" data-time="{{ $productItem->offer_exp_date }}"></span> <span
                                                            class="value">DAYS</span> </div>
                                                </div>
                                                <div class="box-wrapper">
                                                    <div class="hour box"> <span class="key abmshawon" data-name="counterdownhour" data-time="{{ $productItem->offer_exp_date }}"></span></span> <span
                                                            class="value">HRS</span> </div>
                                                </div>
                                                <div class="box-wrapper">
                                                    <div class="minutes box"> <span class="key abmshawon" data-name="counterdownmin" data-time="{{ $productItem->offer_exp_date }}"></span> <span
                                                            class="value">MINS</span> </div>
                                                </div>
                                                <div class="box-wrapper hidden-md">
                                                    <div class="seconds box"> <span class="key abmshawon" data-name="counterdownsec" data-time="{{ $productItem->offer_exp_date }}"></span> <span
                                                            class="value">SEC</span> </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.hot-deal-wrapper -->

                                        <div class="product-info text-left m-t-20">
                                            <h3 class="name"><a href="{{ route('product.details', $productItem->product_slug ) }}">{{ $productItem->product_name }}</a></h3>
                                            <div class="rating rateit-small"></div>
                                            <div class="product-price">
                                                @if ($productItem->descount_price == null)
                                                <span class="price"> ${{ $productItem->selling_price }}</span>
                                                @else
                                                <span class="price"> ${{ $productItem->descount_price }}</span>
                                                <span class="price-before-discount"> ${{ $productItem->selling_price }} </span>
                                                @endif
                                            </div>
                                            <!-- /.product-price -->
                                        </div>
                                        <!-- /.product-info -->
                                        <div class="cart clearfix animate-effect">
                                            <div class="action">
                                                <div class="add-cart-button btn-group">
                                                    <button class="btn btn-primary icon" data-toggle="dropdown" type="button">
                                                        <i class="fa fa-shopping-cart"></i> </button>
                                                    <button class="btn btn-primary cart-btn" type="button" data-toggle="modal" data-target="#exampleModal" id="{{ $productItem->id }}">Add to cart</button>
                                                </div>
                                            </div>
                                            <!-- /.action -->
                                        </div>
                                        <!-- /.cart -->
                                    </div>
                                </div>

                            @endforeach
                        </div>
                        <!-- /.sidebar-widget -->
                    </div>
                    <!-- ============================================== HOT DEALS: END ============================================== -->

                    <!-- ============================================== SPECIAL OFFER ============================================== -->

                    <div class="sidebar-widget outer-bottom-small wow fadeInUp">
                        <h3 class="section-title">Special Offer</h3>
                        <div class="sidebar-widget-body outer-top-xs">
                            <div class="owl-carousel sidebar-carousel special-offer custom-carousel owl-theme outer-top-xs">
                                <div class="item">
                                    <div class="products special-product">
                                        <div class="product">
                                            <div class="product-micro">
                                                <div class="row product-micro-row">
                                                    <div class="col col-xs-5">
                                                        <div class="product-image">
                                                            <div class="image"> <a href="#"> <img
                                                                        src="{{ asset('front-assets/images') }}/products/p30.jpg"
                                                                        alt=""> </a>
                                                            </div>
                                                            <!-- /.image -->

                                                        </div>
                                                        <!-- /.product-image -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col col-xs-7">
                                                        <div class="product-info">
                                                            <h3 class="name"><a href="#">Floral Print Shirt</a></h3>
                                                            <div class="rating rateit-small"></div>
                                                            <div class="product-price"> <span class="price"> $450.99 </span>
                                                            </div>
                                                            <!-- /.product-price -->

                                                        </div>
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.product-micro-row -->
                                            </div>
                                            <!-- /.product-micro -->

                                        </div>
                                        <div class="product">
                                            <div class="product-micro">
                                                <div class="row product-micro-row">
                                                    <div class="col col-xs-5">
                                                        <div class="product-image">
                                                            <div class="image"> <a href="#"> <img
                                                                        src="{{ asset('front-assets/images') }}/products/p29.jpg"
                                                                        alt=""> </a>
                                                            </div>
                                                            <!-- /.image -->

                                                        </div>
                                                        <!-- /.product-image -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col col-xs-7">
                                                        <div class="product-info">
                                                            <h3 class="name"><a href="#">Floral Print Shirt</a></h3>
                                                            <div class="rating rateit-small"></div>
                                                            <div class="product-price"> <span class="price"> $450.99 </span>
                                                            </div>
                                                            <!-- /.product-price -->

                                                        </div>
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.product-micro-row -->
                                            </div>
                                            <!-- /.product-micro -->

                                        </div>
                                        <div class="product">
                                            <div class="product-micro">
                                                <div class="row product-micro-row">
                                                    <div class="col col-xs-5">
                                                        <div class="product-image">
                                                            <div class="image"> <a href="#"> <img
                                                                        src="{{ asset('front-assets/images') }}/products/p28.jpg"
                                                                        alt=""> </a>
                                                            </div>
                                                            <!-- /.image -->

                                                        </div>
                                                        <!-- /.product-image -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col col-xs-7">
                                                        <div class="product-info">
                                                            <h3 class="name"><a href="#">Floral Print Shirt</a></h3>
                                                            <div class="rating rateit-small"></div>
                                                            <div class="product-price"> <span class="price"> $450.99 </span>
                                                            </div>
                                                            <!-- /.product-price -->

                                                        </div>
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.product-micro-row -->
                                            </div>
                                            <!-- /.product-micro -->

                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="products special-product">
                                        <div class="product">
                                            <div class="product-micro">
                                                <div class="row product-micro-row">
                                                    <div class="col col-xs-5">
                                                        <div class="product-image">
                                                            <div class="image"> <a href="#"> <img
                                                                        src="{{ asset('front-assets/images') }}/products/p27.jpg"
                                                                        alt=""> </a>
                                                            </div>
                                                            <!-- /.image -->

                                                        </div>
                                                        <!-- /.product-image -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col col-xs-7">
                                                        <div class="product-info">
                                                            <h3 class="name"><a href="#">Floral Print Shirt</a></h3>
                                                            <div class="rating rateit-small"></div>
                                                            <div class="product-price"> <span class="price"> $450.99 </span>
                                                            </div>
                                                            <!-- /.product-price -->

                                                        </div>
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.product-micro-row -->
                                            </div>
                                            <!-- /.product-micro -->

                                        </div>
                                        <div class="product">
                                            <div class="product-micro">
                                                <div class="row product-micro-row">
                                                    <div class="col col-xs-5">
                                                        <div class="product-image">
                                                            <div class="image"> <a href="#"> <img
                                                                        src="{{ asset('front-assets/images') }}/products/p26.jpg"
                                                                        alt=""> </a>
                                                            </div>
                                                            <!-- /.image -->

                                                        </div>
                                                        <!-- /.product-image -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col col-xs-7">
                                                        <div class="product-info">
                                                            <h3 class="name"><a href="#">Floral Print Shirt</a></h3>
                                                            <div class="rating rateit-small"></div>
                                                            <div class="product-price"> <span class="price"> $450.99 </span>
                                                            </div>
                                                            <!-- /.product-price -->

                                                        </div>
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.product-micro-row -->
                                            </div>
                                            <!-- /.product-micro -->

                                        </div>
                                        <div class="product">
                                            <div class="product-micro">
                                                <div class="row product-micro-row">
                                                    <div class="col col-xs-5">
                                                        <div class="product-image">
                                                            <div class="image"> <a href="#"> <img
                                                                        src="{{ asset('front-assets/images') }}/products/p25.jpg"
                                                                        alt=""> </a>
                                                            </div>
                                                            <!-- /.image -->

                                                        </div>
                                                        <!-- /.product-image -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col col-xs-7">
                                                        <div class="product-info">
                                                            <h3 class="name"><a href="#">Floral Print Shirt</a></h3>
                                                            <div class="rating rateit-small"></div>
                                                            <div class="product-price"> <span class="price"> $450.99 </span>
                                                            </div>
                                                            <!-- /.product-price -->

                                                        </div>
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.product-micro-row -->
                                            </div>
                                            <!-- /.product-micro -->

                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="products special-product">
                                        <div class="product">
                                            <div class="product-micro">
                                                <div class="row product-micro-row">
                                                    <div class="col col-xs-5">
                                                        <div class="product-image">
                                                            <div class="image"> <a href="#"> <img
                                                                        src="{{ asset('front-assets/images') }}/products/p24.jpg"
                                                                        alt=""> </a>
                                                            </div>
                                                            <!-- /.image -->

                                                        </div>
                                                        <!-- /.product-image -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col col-xs-7">
                                                        <div class="product-info">
                                                            <h3 class="name"><a href="#">Floral Print Shirt</a></h3>
                                                            <div class="rating rateit-small"></div>
                                                            <div class="product-price"> <span class="price"> $450.99 </span>
                                                            </div>
                                                            <!-- /.product-price -->

                                                        </div>
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.product-micro-row -->
                                            </div>
                                            <!-- /.product-micro -->

                                        </div>
                                        <div class="product">
                                            <div class="product-micro">
                                                <div class="row product-micro-row">
                                                    <div class="col col-xs-5">
                                                        <div class="product-image">
                                                            <div class="image"> <a href="#"> <img
                                                                        src="{{ asset('front-assets/images') }}/products/p23.jpg"
                                                                        alt=""> </a>
                                                            </div>
                                                            <!-- /.image -->

                                                        </div>
                                                        <!-- /.product-image -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col col-xs-7">
                                                        <div class="product-info">
                                                            <h3 class="name"><a href="#">Floral Print Shirt</a></h3>
                                                            <div class="rating rateit-small"></div>
                                                            <div class="product-price"> <span class="price"> $450.99 </span>
                                                            </div>
                                                            <!-- /.product-price -->
                                                        </div>
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.product-micro-row -->
                                            </div>
                                            <!-- /.product-micro -->

                                        </div>
                                        <div class="product">
                                            <div class="product-micro">
                                                <div class="row product-micro-row">
                                                    <div class="col col-xs-5">
                                                        <div class="product-image">
                                                            <div class="image"> <a href="#"> <img
                                                                        src="{{ asset('front-assets/images') }}/products/p22.jpg"
                                                                        alt=""> </a>
                                                            </div>
                                                            <!-- /.image -->

                                                        </div>
                                                        <!-- /.product-image -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col col-xs-7">
                                                        <div class="product-info">
                                                            <h3 class="name"><a href="#">Floral Print Shirt</a></h3>
                                                            <div class="rating rateit-small"></div>
                                                            <div class="product-price"> <span class="price"> $450.99 </span>
                                                            </div>
                                                            <!-- /.product-price -->

                                                        </div>
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.product-micro-row -->
                                            </div>
                                            <!-- /.product-micro -->

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.sidebar-widget-body -->
                    </div>
                    <!-- /.sidebar-widget -->
                    <!-- ============================================== SPECIAL OFFER : END ============================================== -->
                    <!-- ============================================== PRODUCT TAGS ============================================== -->
                    <div class="sidebar-widget product-tag wow fadeInUp">
                        <h3 class="section-title">Product tags</h3>
                        <div class="sidebar-widget-body outer-top-xs">
                            <div class="tag-list"> <a class="item" title="Phone" href="category.html">Phone</a> <a
                                    class="item active" title="Vest" href="category.html">Vest</a> <a class="item"
                                    title="Smartphone" href="category.html">Smartphone</a> <a class="item" title="Furniture"
                                    href="category.html">Furniture</a> <a class="item" title="T-shirt"
                                    href="category.html">T-shirt</a> <a class="item" title="Sweatpants"
                                    href="category.html">Sweatpants</a> <a class="item" title="Sneaker"
                                    href="category.html">Sneaker</a> <a class="item" title="Toys"
                                    href="category.html">Toys</a> <a class="item" title="Rose" href="category.html">Rose</a>
                            </div>
                            <!-- /.tag-list -->
                        </div>
                        <!-- /.sidebar-widget-body -->
                    </div>
                    <!-- /.sidebar-widget -->
                    <!-- ============================================== PRODUCT TAGS : END ============================================== -->
                    <!-- ============================================== SPECIAL DEALS ============================================== -->

                    <div class="sidebar-widget outer-bottom-small wow fadeInUp">
                        <h3 class="section-title">Special Deals</h3>
                        <div class="sidebar-widget-body outer-top-xs">
                            <div class="owl-carousel sidebar-carousel special-offer custom-carousel owl-theme outer-top-xs">
                                <div class="item">
                                    <div class="products special-product">
                                        <div class="product">
                                            <div class="product-micro">
                                                <div class="row product-micro-row">
                                                    <div class="col col-xs-5">
                                                        <div class="product-image">
                                                            <div class="image"> <a href="#"> <img
                                                                        src="{{ asset('front-assets/images') }}/products/p28.jpg"
                                                                        alt=""> </a>
                                                            </div>
                                                            <!-- /.image -->

                                                        </div>
                                                        <!-- /.product-image -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col col-xs-7">
                                                        <div class="product-info">
                                                            <h3 class="name"><a href="#">Floral Print Shirt</a></h3>
                                                            <div class="rating rateit-small"></div>
                                                            <div class="product-price"> <span class="price"> $450.99 </span>
                                                            </div>
                                                            <!-- /.product-price -->

                                                        </div>
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.product-micro-row -->
                                            </div>
                                            <!-- /.product-micro -->

                                        </div>
                                        <div class="product">
                                            <div class="product-micro">
                                                <div class="row product-micro-row">
                                                    <div class="col col-xs-5">
                                                        <div class="product-image">
                                                            <div class="image"> <a href="#"> <img
                                                                        src="{{ asset('front-assets/images') }}/products/p15.jpg"
                                                                        alt=""> </a>
                                                            </div>
                                                            <!-- /.image -->

                                                        </div>
                                                        <!-- /.product-image -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col col-xs-7">
                                                        <div class="product-info">
                                                            <h3 class="name"><a href="#">Floral Print Shirt</a></h3>
                                                            <div class="rating rateit-small"></div>
                                                            <div class="product-price"> <span class="price"> $450.99 </span>
                                                            </div>
                                                            <!-- /.product-price -->

                                                        </div>
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.product-micro-row -->
                                            </div>
                                            <!-- /.product-micro -->

                                        </div>
                                        <div class="product">
                                            <div class="product-micro">
                                                <div class="row product-micro-row">
                                                    <div class="col col-xs-5">
                                                        <div class="product-image">
                                                            <div class="image"> <a href="#"> <img
                                                                        src="{{ asset('front-assets/images') }}/products/p26.jpg"
                                                                        alt="image">
                                                                </a> </div>
                                                            <!-- /.image -->

                                                        </div>
                                                        <!-- /.product-image -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col col-xs-7">
                                                        <div class="product-info">
                                                            <h3 class="name"><a href="#">Floral Print Shirt</a></h3>
                                                            <div class="rating rateit-small"></div>
                                                            <div class="product-price"> <span class="price"> $450.99 </span>
                                                            </div>
                                                            <!-- /.product-price -->

                                                        </div>
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.product-micro-row -->
                                            </div>
                                            <!-- /.product-micro -->

                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="products special-product">
                                        <div class="product">
                                            <div class="product-micro">
                                                <div class="row product-micro-row">
                                                    <div class="col col-xs-5">
                                                        <div class="product-image">
                                                            <div class="image"> <a href="#"> <img
                                                                        src="{{ asset('front-assets/images') }}/products/p18.jpg"
                                                                        alt=""> </a>
                                                            </div>
                                                            <!-- /.image -->

                                                        </div>
                                                        <!-- /.product-image -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col col-xs-7">
                                                        <div class="product-info">
                                                            <h3 class="name"><a href="#">Floral Print Shirt</a></h3>
                                                            <div class="rating rateit-small"></div>
                                                            <div class="product-price"> <span class="price"> $450.99 </span>
                                                            </div>
                                                            <!-- /.product-price -->

                                                        </div>
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.product-micro-row -->
                                            </div>
                                            <!-- /.product-micro -->

                                        </div>
                                        <div class="product">
                                            <div class="product-micro">
                                                <div class="row product-micro-row">
                                                    <div class="col col-xs-5">
                                                        <div class="product-image">
                                                            <div class="image"> <a href="#"> <img
                                                                        src="{{ asset('front-assets/images') }}/products/p17.jpg"
                                                                        alt=""> </a>
                                                            </div>
                                                            <!-- /.image -->

                                                        </div>
                                                        <!-- /.product-image -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col col-xs-7">
                                                        <div class="product-info">
                                                            <h3 class="name"><a href="#">Floral Print Shirt</a></h3>
                                                            <div class="rating rateit-small"></div>
                                                            <div class="product-price"> <span class="price"> $450.99 </span>
                                                            </div>
                                                            <!-- /.product-price -->

                                                        </div>
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.product-micro-row -->
                                            </div>
                                            <!-- /.product-micro -->

                                        </div>
                                        <div class="product">
                                            <div class="product-micro">
                                                <div class="row product-micro-row">
                                                    <div class="col col-xs-5">
                                                        <div class="product-image">
                                                            <div class="image"> <a href="#"> <img
                                                                        src="{{ asset('front-assets/images') }}/products/p16.jpg"
                                                                        alt=""> </a>
                                                            </div>
                                                            <!-- /.image -->

                                                        </div>
                                                        <!-- /.product-image -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col col-xs-7">
                                                        <div class="product-info">
                                                            <h3 class="name"><a href="#">Floral Print Shirt</a></h3>
                                                            <div class="rating rateit-small"></div>
                                                            <div class="product-price"> <span class="price"> $450.99 </span>
                                                            </div>
                                                            <!-- /.product-price -->
                                                        </div>
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.product-micro-row -->
                                            </div>
                                            <!-- /.product-micro -->

                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="products special-product">
                                        <div class="product">
                                            <div class="product-micro">
                                                <div class="row product-micro-row">
                                                    <div class="col col-xs-5">
                                                        <div class="product-image">
                                                            <div class="image"> <a href="#"> <img
                                                                        src="{{ asset('front-assets/images') }}/products/p15.jpg"
                                                                        alt="images">
                                                                    <div class="zoom-overlay"></div>
                                                                </a> </div>
                                                            <!-- /.image -->

                                                        </div>
                                                        <!-- /.product-image -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col col-xs-7">
                                                        <div class="product-info">
                                                            <h3 class="name"><a href="#">Floral Print Shirt</a></h3>
                                                            <div class="rating rateit-small"></div>
                                                            <div class="product-price"> <span class="price"> $450.99 </span>
                                                            </div>
                                                            <!-- /.product-price -->

                                                        </div>
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.product-micro-row -->
                                            </div>
                                            <!-- /.product-micro -->

                                        </div>
                                        <div class="product">
                                            <div class="product-micro">
                                                <div class="row product-micro-row">
                                                    <div class="col col-xs-5">
                                                        <div class="product-image">
                                                            <div class="image"> <a href="#"> <img
                                                                        src="{{ asset('front-assets/images') }}/products/p14.jpg"
                                                                        alt="">
                                                                    <div class="zoom-overlay"></div>
                                                                </a> </div>
                                                            <!-- /.image -->

                                                        </div>
                                                        <!-- /.product-image -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col col-xs-7">
                                                        <div class="product-info">
                                                            <h3 class="name"><a href="#">Floral Print Shirt</a></h3>
                                                            <div class="rating rateit-small"></div>
                                                            <div class="product-price"> <span class="price"> $450.99 </span>
                                                            </div>
                                                            <!-- /.product-price -->

                                                        </div>
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.product-micro-row -->
                                            </div>
                                            <!-- /.product-micro -->

                                        </div>
                                        <div class="product">
                                            <div class="product-micro">
                                                <div class="row product-micro-row">
                                                    <div class="col col-xs-5">
                                                        <div class="product-image">
                                                            <div class="image"> <a href="#"> <img
                                                                        src="{{ asset('front-assets/images') }}/products/p13.jpg"
                                                                        alt="image">
                                                                </a> </div>
                                                            <!-- /.image -->

                                                        </div>
                                                        <!-- /.product-image -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col col-xs-7">
                                                        <div class="product-info">
                                                            <h3 class="name"><a href="#">Floral Print Shirt</a></h3>
                                                            <div class="rating rateit-small"></div>
                                                            <div class="product-price"> <span class="price"> $450.99 </span>
                                                            </div>
                                                            <!-- /.product-price -->

                                                        </div>
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.product-micro-row -->
                                            </div>
                                            <!-- /.product-micro -->

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.sidebar-widget-body -->
                    </div>
                    <!-- /.sidebar-widget -->
                    <!-- ============================================== SPECIAL DEALS : END ============================================== -->
                    <!-- ============================================== NEWSLETTER ============================================== -->
                    <div class="sidebar-widget newsletter wow fadeInUp outer-bottom-small">
                        <h3 class="section-title">Newsletters</h3>
                        <div class="sidebar-widget-body outer-top-xs">
                            <p>Sign Up for Our Newsletter!</p>
                            <form>
                                <div class="form-group">
                                    <label class="sr-only" for="exampleInputEmail1">Email address</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1"
                                        placeholder="Subscribe to our newsletter">
                                </div>
                                <button class="btn btn-primary">Subscribe</button>
                            </form>
                        </div>
                        <!-- /.sidebar-widget-body -->
                    </div>
                    <!-- /.sidebar-widget -->
                    <!-- ============================================== NEWSLETTER: END ============================================== -->

                    <!-- ============================================== Testimonials============================================== -->
                    <div class="sidebar-widget  wow fadeInUp outer-top-vs ">
                        <div id="advertisement" class="advertisement">
                            <div class="item">
                                <div class="avatar"><img
                                        src="{{ asset('front-assets/images') }}/testimonials/member1.png" alt="Image">
                                </div>
                                <div class="testimonials"><em>"</em> Vtae sodales aliq uam morbi non sem lacus port mollis.
                                    Nunc condime tum metus eud molest sed consectetuer.<em>"</em></div>
                                <div class="clients_author">John Doe <span>Abc Company</span> </div>
                                <!-- /.container-fluid -->
                            </div>
                            <!-- /.item -->

                            <div class="item">
                                <div class="avatar"><img
                                        src="{{ asset('front-assets/images') }}/testimonials/member3.png" alt="Image">
                                </div>
                                <div class="testimonials"><em>"</em>Vtae sodales aliq uam morbi non sem lacus port mollis.
                                    Nunc condime tum metus eud molest sed consectetuer.<em>"</em></div>
                                <div class="clients_author">Stephen Doe <span>Xperia Designs</span> </div>
                            </div>
                            <!-- /.item -->

                            <div class="item">
                                <div class="avatar"><img
                                        src="{{ asset('front-assets/images') }}/testimonials/member2.png" alt="Image">
                                </div>
                                <div class="testimonials"><em>"</em> Vtae sodales aliq uam morbi non sem lacus port mollis.
                                    Nunc condime tum metus eud molest sed consectetuer.<em>"</em></div>
                                <div class="clients_author">Saraha Smith <span>Datsun &amp; Co</span> </div>
                                <!-- /.container-fluid -->
                            </div>
                            <!-- /.item -->

                        </div>
                        <!-- /.owl-carousel -->
                    </div>

                    <!-- ============================================== Testimonials: END ============================================== -->

                    <div class="home-banner">
                        <img src="{{ asset('front-assets/images') }}/banners/LHS-banner.jpg" alt="Image">
                    </div>
                </div>
                <!-- /.sidemenu-holder -->
                <!-- ============================================== SIDEBAR : END ============================================== -->

                <!-- ============================================== CONTENT ============================================== -->
                <div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder">
                    <!-- ========================================== SECTION – HERO ========================================= -->
                    <div id="hero">
                        <div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">
                            <div class="item"
                                style="background-image: url({{ asset('front-assets/images') }}/sliders/01.jpg);">
                                <div class="container-fluid">
                                    <div class="caption bg-color vertical-center text-left">
                                        <div class="slider-header fadeInDown-1">Top Brands</div>
                                        <div class="big-text fadeInDown-1"> New Collections </div>
                                        <div class="excerpt fadeInDown-2 hidden-xs"> <span>Lorem ipsum dolor sit amet,
                                                consectetur adipisicing elit.</span> </div>
                                        <div class="button-holder fadeInDown-3"> <a href="index.php?page=single-product"
                                                class="btn-lg btn btn-uppercase btn-primary shop-now-button">Shop Now</a>
                                        </div>
                                    </div>
                                    <!-- /.caption -->
                                </div>
                                <!-- /.container-fluid -->
                            </div>
                            <!-- /.item -->

                            <div class="item"
                                style="background-image: url({{ asset('front-assets/images') }}/sliders/02.jpg);">
                                <div class="container-fluid">
                                    <div class="caption bg-color vertical-center text-left">
                                        <div class="slider-header fadeInDown-1">Spring 2016</div>
                                        <div class="big-text fadeInDown-1"> Women <span class="highlight">Fashion</span>
                                        </div>
                                        <div class="excerpt fadeInDown-2 hidden-xs"> <span>Nemo enim ipsam voluptatem quia
                                                voluptas sit aspernatur aut odit aut fugit</span> </div>
                                        <div class="button-holder fadeInDown-3"> <a href="index.php?page=single-product"
                                                class="btn-lg btn btn-uppercase btn-primary shop-now-button">Shop Now</a>
                                        </div>
                                    </div>
                                    <!-- /.caption -->
                                </div>
                                <!-- /.container-fluid -->
                            </div>
                            <!-- /.item -->

                        </div>
                        <!-- /.owl-carousel -->
                    </div>

                    <!-- ========================================= SECTION – HERO : END ========================================= -->

                    <!-- ============================================== INFO BOXES ============================================== -->
                    <div class="info-boxes wow fadeInUp">
                        <div class="info-boxes-inner">
                            <div class="row">
                                <div class="col-md-6 col-sm-4 col-lg-4">
                                    <div class="info-box">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <h4 class="info-box-heading green">money back</h4>
                                            </div>
                                        </div>
                                        <h6 class="text">30 Days Money Back Guarantee</h6>
                                    </div>
                                </div>
                                <!-- .col -->

                                <div class="hidden-md col-sm-4 col-lg-4">
                                    <div class="info-box">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <h4 class="info-box-heading green">free shipping</h4>
                                            </div>
                                        </div>
                                        <h6 class="text">Shipping on orders over $99</h6>
                                    </div>
                                </div>
                                <!-- .col -->

                                <div class="col-md-6 col-sm-4 col-lg-4">
                                    <div class="info-box">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <h4 class="info-box-heading green">Special Sale</h4>
                                            </div>
                                        </div>
                                        <h6 class="text">Extra $5 off on all items </h6>
                                    </div>
                                </div>
                                <!-- .col -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.info-boxes-inner -->

                    </div>
                    <!-- /.info-boxes -->
                    <!-- ============================================== INFO BOXES : END ============================================== -->

                    <!-- ============================================== SCROLL TABS ============================================== -->
                    <div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
                        <div class="more-info-tab clearfix ">
                            <h3 class="new-product-title pull-left">New Products</h3>
                            <ul class="nav nav-tabs nav-tab-line pull-right" id="new-products-1">
                                <li class="active"><a data-transition-type="backSlide" href="#all" data-toggle="tab">All</a>
                                </li>
                                @foreach ($categories as $itemcategory)
                                    <li><a data-transition-type="backSlide" href="#category{{ $itemcategory->id }}" data-toggle="tab">{{ $itemcategory->name }}</a>
                                @endforeach
                            </ul>
                            <!-- /.nav-tabs -->
                        </div>
                        <div class="tab-content outer-top-xs">
                            <div class="tab-pane in active" id="all">
                                <div class="product-slider">
                                    <div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">
                                        @foreach ($products as $productItem)
                                            <div class="item item-carousel">
                                                <div class="products">
                                                    <div class="product">
                                                        <div class="product-image">
                                                            <div class="image">
                                                                <a href="{{ route('product.details',  $productItem->product_slug ) }}"><img src="{{ asset($productItem->thmbnail) }}" alt=""></a>
                                                            </div>
                                                            <!-- /.image -->

                                                            @php
                                                                $discount = (($productItem->selling_price - $productItem->descount_price) / $productItem->selling_price) * 100;
                                                            @endphp
                                                            @if ($productItem->descount_price == null)
                                                                <div class="tag new"><span>new</span></div>
                                                            @else
                                                                <div class="tag hot"><span>{{ round($discount) }}%</span>
                                                                </div>
                                                            @endif

                                                        </div>
                                                        <!-- /.product-image -->

                                                        <div class="product-info text-left">
                                                            <h3 class="name"><a
                                                                    href="{{ route('product.details',  $productItem->product_slug ) }}">{{ Str::limit($productItem->product_name, 23) }}</a>
                                                            </h3>
                                                            <div class="rating rateit-small"></div>
                                                            <div class="description"></div>
                                                            <div class="product-price"> <span class="price">
                                                                @if ($productItem->descount_price == null)
                                                                    <span class="price">${{ $productItem->selling_price }}</span>
                                                                @else
                                                                    <span class="price">${{ $productItem->descount_price }}</span>
                                                                    <span class="price-before-discount"> ${{ $productItem->selling_price }}</span>
                                                                @endif
                                                            </div>
                                                            <!-- /.product-price -->
                                                        </div>
                                                        <!-- /.product-info -->
                                                        <div class="cart clearfix animate-effect">
                                                            <div class="action">
                                                                <ul class="list-unstyled">
                                                                    <li class="add-cart-button btn-group">
                                                                        <button data-toggle="tooltip"
                                                                            class="btn btn-primary icon" type="button"
                                                                            title="Add Cart"> <i
                                                                                class="fa fa-shopping-cart"></i> </button>
                                                                        <button class="btn btn-primary cart-btn"
                                                                            type="button">Add to cart</button>
                                                                    </li>
                                                                    <li class="lnk wishlist"> <a data-toggle="tooltip"
                                                                            class="add-to-cart" href="detail.html"
                                                                            title="Wishlist"> <i
                                                                                class="icon fa fa-heart"></i>
                                                                        </a> </li>
                                                                    <li class="lnk"> <a data-toggle="tooltip"
                                                                            class="add-to-cart" href="detail.html"
                                                                            title="Compare"> <i class="fa fa-signal"
                                                                                aria-hidden="true"></i> </a> </li>
                                                                </ul>
                                                            </div>
                                                            <!-- /.action -->
                                                        </div>
                                                        <!-- /.cart -->
                                                    </div>
                                                    <!-- /.product -->

                                                </div>
                                                <!-- /.products -->
                                            </div>
                                            <!-- /.item -->
                                        @endforeach
                                    </div>
                                    <!-- /.home-owl-carousel -->
                                </div>
                                <!-- /.product-slider -->
                            </div>
                            <!-- /.tab-pane -->

                            @foreach ($categories as $categoryItem)
                                <div class="tab-pane" id="category{{ $categoryItem->id }}">
                                    {{-- @php
                                        $categoriesProduct = App\Models\Product::where('category_id', $categoryItem->id)->where('status', 1)->get();
                                    @endphp --}}
                                    <div class="product-slider">
                                        <div class="owl-carousel home-owl-carousel custom-carousel owl-theme">
                                            @forelse ($categoryItem->product as $productItem)
                                                <div class="item item-carousel">
                                                    <div class="products">
                                                        <div class="product">
                                                            <div class="product-image">
                                                                <div class="image">
                                                                    <a href="{{ route('product.details',  $productItem->product_slug ) }}"><img  src="{{ asset($productItem->thmbnail) }}" alt=""></a>
                                                                </div>
                                                                <!-- /.image -->
                                                                @php
                                                                    $discount = (($productItem->selling_price - $productItem->descount_price) / $productItem->selling_price) * 100;
                                                                @endphp
                                                                @if ($productItem->descount_price == null)
                                                                    <div class="tag new"><span>new</span></div>
                                                                @else
                                                                    <div class="tag hot">
                                                                        <span>{{ round($discount) }}%</span></div>
                                                                @endif
                                                            </div>
                                                            <!-- /.product-image -->

                                                            <div class="product-info text-left">
                                                                <h3 class="name"><a href="{{ route('product.details',  $productItem->product_slug ) }}">{{ Str::limit($productItem->product_name, 23) }}</a>
                                                                </h3>
                                                                <div class="rating rateit-small"></div>
                                                                <div class="description"></div>
                                                                <div class="product-price">
                                                                    @if ($productItem->descount_price == null)
                                                                        <span class="price">${{ $productItem->selling_price }}</span>
                                                                    @else
                                                                        <span class="price">${{ $productItem->descount_price }}</span>
                                                                        <span class="price-before-discount"> ${{ $productItem->selling_price }}</span>
                                                                    @endif
                                                                    <!-- /.product-price -->
                                                                </div>
                                                                <!-- /.product-info -->
                                                                <div class="cart clearfix animate-effect">
                                                                    <div class="action">
                                                                        <ul class="list-unstyled">
                                                                            <li class="add-cart-button btn-group">
                                                                                <button class="btn btn-primary icon"
                                                                                    data-toggle="dropdown" type="button"> <i
                                                                                        class="fa fa-shopping-cart"></i>
                                                                                </button>
                                                                                <button class="btn btn-primary cart-btn"
                                                                                    type="button">Add to cart</button>
                                                                            </li>
                                                                            <li class="lnk wishlist"> <a class="add-to-cart"
                                                                                    href="detail.html" title="Wishlist"> <i
                                                                                        class="icon fa fa-heart"></i> </a>
                                                                            </li>
                                                                            <li class="lnk"> <a class="add-to-cart"
                                                                                    href="detail.html" title="Compare"> <i
                                                                                        class="fa fa-signal"
                                                                                        aria-hidden="true"></i> </a> </li>
                                                                        </ul>
                                                                    </div>
                                                                    <!-- /.action -->
                                                                </div>
                                                                <!-- /.cart -->
                                                            </div>
                                                            <!-- /.product -->

                                                        </div>
                                                        <!-- /.products -->
                                                    </div>
                                                    <!-- /.item -->
                                                </div>

                                            @empty
                                                <h5 class="text-danger">Products Not Aailable!</h5>
                                            @endforelse
                                        </div>
                                        <!-- /.home-owl-carousel -->
                                    </div>
                                    <!-- /.product-slider -->
                                </div>
                                <!-- /.tab-pane -->
                            @endforeach
                            <!-- /.tab-content -->
                        </div>
                        <!-- /.homebanner-holder -->
                    </div>


                    <!-- /.scroll-tabs -->
                    <!-- ============================================== SCROLL TABS : END ============================================== -->
                    <!-- ============================================== WIDE PRODUCTS ============================================== -->
                    <div class="wide-banners wow fadeInUp outer-bottom-xs">
                        <div class="row">
                            <div class="col-md-7 col-sm-7">
                                <div class="wide-banner cnt-strip">
                                    <div class="image"> <img class="img-responsive"
                                            src="{{ asset('front-assets/images') }}/banners/home-banner1.jpg" alt="">
                                    </div>
                                </div>
                                <!-- /.wide-banner -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-5 col-sm-5">
                                <div class="wide-banner cnt-strip">
                                    <div class="image"> <img class="img-responsive"
                                            src="{{ asset('front-assets/images') }}/banners/home-banner2.jpg" alt="">
                                    </div>
                                </div>
                                <!-- /.wide-banner -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.wide-banners -->

                    <!-- ============================================== WIDE PRODUCTS : END ============================================== -->
                    <!-- ============================================== FEATURED PRODUCTS ============================================== -->
                    <section class="section featured-product wow fadeInUp">
                        <h3 class="section-title">Featured products</h3>
                        <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
                            @foreach ($featureProducts as $fproductItem)
                                <div class="item item-carousel">
                                    <div class="products">
                                        <div class="product">
                                            <div class="product-image">
                                                <div class="image">
                                                    <a href="{{ route('product.details',  $fproductItem->product_slug ) }}"><img src="{{ asset($fproductItem->thmbnail) }}" alt=""></a>
                                                </div>
                                                <!-- /.image -->
                                                @php
                                                    $discount = (($fproductItem->selling_price - $fproductItem->descount_price) / $fproductItem->selling_price) * 100;
                                                @endphp
                                                @if ($fproductItem->descount_price == null)
                                                    <div class="tag new"><span>new</span></div>
                                                @else
                                                    <div class="tag hot"><span>{{ round($discount) }}%</span></div>
                                                @endif
                                            </div>
                                            <!-- /.product-image -->

                                            <div class="product-info text-left">
                                                <h3 class="name">
                                                    <a href="{{ route('product.details',  $fproductItem->product_slug ) }}">{{ Str::limit($fproductItem->product_name, 23) }}</a>
                                                </h3>
                                                <div class="rating rateit-small"></div>
                                                <div class="description"></div>
                                                <div class="product-price">
                                                    @if ($fproductItem->descount_price == null)
                                                    <span class="price"> ${{ $fproductItem->selling_price }}</span>
                                                    @else
                                                    <span class="price"> ${{ $fproductItem->descount_price }}</span>
                                                    <span class="price-before-discount"> ${{ $fproductItem->selling_price }} </span>
                                                    @endif
                                                    <!-- /.product-price -->
                                                </div>
                                                    <!-- /.product-price -->

                                            </div>
                                            <!-- /.product-info -->
                                            <div class="cart clearfix animate-effect">
                                                <div class="action">
                                                    <ul class="list-unstyled">
                                                        <li class="add-cart-button btn-group">
                                                            <button class="btn btn-primary icon" data-toggle="modal" data-target="#exampleModal{{ $fproductItem->id }}"
                                                                type="button"> <i class="fa fa-shopping-cart"></i> </button>
                                                            <button class="btn btn-primary cart-btn" type="button">Add to
                                                                cart</button>
                                                        </li>
                                                        <li class="lnk wishlist"> <a class="add-to-cart" href="detail.html"
                                                                title="Wishlist"> <i class="icon fa fa-heart"></i> </a>
                                                        </li>
                                                        <li class="lnk"> <a class="add-to-cart" href="detail.html"
                                                                title="Compare" > <i class="fa fa-signal"
                                                                    aria-hidden="true"></i>
                                                            </a> </li>
                                                    </ul>
                                                </div>
                                                <!-- /.action -->
                                            </div>
                                            <!-- /.cart -->
                                        </div>
                                        <!-- /.product -->

                                    </div>
                                    <!-- /.products -->
                                </div>
                                <!-- /.item -->

                                <!-- Button trigger modal -->



                            @endforeach


                        </div>
                        <!-- /.home-owl-carousel -->
                    </section>
                    <!-- /.section -->
                    <!-- ============================================== FEATURED PRODUCTS : END ============================================== -->
                      @foreach ($featureProducts as $fproductItem)
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal{{ $fproductItem->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">{{ $fproductItem->product_name }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="card" style="width: 18rem;">
                                                <img src="..." class="card-img-top" alt="..." width="200px" height="200px" id="pthumbnail">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card" style="width: 18rem;">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item">Product Code: <strong >{{ $fproductItem->product_code }}</strong></li>
                                                    <li class="list-group-item">Product Price:  @if ($fproductItem->descount_price == null)
                                                        <strong class="price"> ${{ $fproductItem->selling_price }}</strong>
                                                        @else
                                                        <strong class="price"> ${{ $fproductItem->descount_price }}</strong>
                                                        <del class="price-before-discount"> ${{ $fproductItem->selling_price }} </del>
                                                        @endif</li>
                                                <li class="list-group-item">Stock:@if ( $fproductItem->product_qty  > 0 )
                                                    <strong id="pstock">{{ $fproductItem->product_qty }}</strong>
                                                @else
                                                <strong id="pstock" class="text-danger">{{ 'Stock Out' }}</strong>
                                                @endif</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            @foreach ( $fproductItem->productAttribute as $pattrItem)
                                                <div class="form-group">
                                                    <label><strong  id="attr_name">{{ $pattrItem->attributeSet->attribute_name }}</strong></label>
                                                    <div class="c-inputs-stacked">
                                                        <input name="attr_name" type="checkbox" id="radio_123{{ $pattrItem->id }}" value="1">
                                                        <label for="radio_123{{ $pattrItem->id }}" class="mr-30">{{ $pattrItem->value }}</label>
                                                    </div>
                                                </div>
                                            @endforeach


                                            <div class="form-group">
                                                <label>Quantity:</label>
                                                <input type="number" class="form-control" value="1" min="1">
                                            </div>

                                            <button type="submit" class="btn btn-primary">Add to Cart</button>
                                        </div>
                                    </div>
                                </div>
                                {{-- End Model Body --}}
                            </div>
                            </div>
                        </div>
                    @endforeach
                    <!-- ============================================== SPACIFIC CATEGORY PRODUCTS ============================================== -->
                    <section class="section featured-product wow fadeInUp">
                        <h3 class="section-title">{{ $skipCategory3->name }}</h3>
                        <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
                            @foreach ($categoryProduct as $productItem)
                                <div class="item item-carousel">
                                    <div class="products">
                                        <div class="product">
                                            <div class="product-image">
                                                <div class="image">
                                                    <a href="{{ route('product.details',  $productItem->product_slug ) }}"><img src="{{ asset($productItem->thmbnail) }}" alt=""></a>
                                                </div>
                                                <!-- /.image -->
                                                @php
                                                    $discount = (($productItem->selling_price - $productItem->descount_price) / $productItem->selling_price) * 100;
                                                @endphp
                                                @if ($productItem->descount_price == null)
                                                    <div class="tag new"><span>new</span></div>
                                                @else
                                                    <div class="tag hot"><span>{{ round($discount) }}%</span></div>
                                                @endif
                                            </div>
                                            <!-- /.product-image -->

                                            <div class="product-info text-left">
                                                <h3 class="name">
                                                    <a href="{{ route('product.details',  $productItem->product_slug ) }}">{{ Str::limit($productItem->product_name, 23) }}</a>
                                                </h3>
                                                <div class="rating rateit-small"></div>
                                                <div class="description"></div>
                                                <div class="product-price">
                                                    @if ($productItem->descount_price == null)
                                                    <span class="price"> ${{ $productItem->selling_price }}</span>
                                                    @else
                                                    <span class="price"> ${{ $productItem->descount_price }}</span>
                                                    <span class="price-before-discount"> ${{ $productItem->selling_price }} </span>
                                                    @endif
                                                    <!-- /.product-price -->
                                                </div>
                                                    <!-- /.product-price -->

                                            </div>
                                            <!-- /.product-info -->
                                            <div class="cart clearfix animate-effect">
                                                <div class="action">
                                                    <ul class="list-unstyled">
                                                        <li class="add-cart-button btn-group">
                                                            <button class="btn btn-primary icon" data-toggle="dropdown"
                                                                type="button"> <i class="fa fa-shopping-cart"></i> </button>
                                                            <button class="btn btn-primary cart-btn" type="button">Add to
                                                                cart</button>
                                                        </li>
                                                        <li class="lnk wishlist"> <a class="add-to-cart" href="detail.html"
                                                                title="Wishlist"> <i class="icon fa fa-heart"></i> </a>
                                                        </li>
                                                        <li class="lnk"> <a class="add-to-cart" href="detail.html"
                                                                title="Compare"> <i class="fa fa-signal"
                                                                    aria-hidden="true"></i>
                                                            </a> </li>
                                                    </ul>
                                                </div>
                                                <!-- /.action -->
                                            </div>
                                            <!-- /.cart -->
                                        </div>
                                        <!-- /.product -->

                                    </div>
                                    <!-- /.products -->
                                </div>
                                <!-- /.item -->
                            @endforeach


                        </div>
                        <!-- /.home-owl-carousel -->
                    </section>
                    <!-- /.section -->
                    <!-- ============================================== SPACIFIC CATEGORY PRODUCTS  : END ============================================== -->

                    <!-- ============================================== WIDE PRODUCTS ============================================== -->
                    <div class="wide-banners wow fadeInUp outer-bottom-xs">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="wide-banner cnt-strip">
                                    <div class="image"> <img class="img-responsive"
                                            src="{{ asset('front-assets/images') }}/banners/home-banner.jpg" alt="">
                                    </div>
                                    <div class="strip strip-text">
                                        <div class="strip-inner">
                                            <h2 class="text-right">New Mens Fashion<br>
                                                <span class="shopping-needs">Save up to 40% off</span>
                                            </h2>
                                        </div>
                                    </div>
                                    <div class="new-label">
                                        <div class="text">NEW</div>
                                    </div>
                                    <!-- /.new-label -->
                                </div>
                                <!-- /.wide-banner -->
                            </div>
                            <!-- /.col -->

                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.wide-banners -->
                    <!-- ============================================== WIDE PRODUCTS : END ============================================== -->
                    <!-- ============================================== BEST SELLER ============================================== -->

                    <div class="best-deal wow fadeInUp outer-bottom-xs">
                        <h3 class="section-title">Best seller</h3>
                        <div class="sidebar-widget-body outer-top-xs">
                            <div class="owl-carousel best-seller custom-carousel owl-theme outer-top-xs">
                                <div class="item">
                                    <div class="products best-product">
                                        <div class="product">
                                            <div class="product-micro">
                                                <div class="row product-micro-row">
                                                    <div class="col col-xs-5">
                                                        <div class="product-image">
                                                            <div class="image"> <a href="#"> <img
                                                                        src="{{ asset('front-assets/images') }}/products/p20.jpg"
                                                                        alt=""> </a>
                                                            </div>
                                                            <!-- /.image -->

                                                        </div>
                                                        <!-- /.product-image -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col2 col-xs-7">
                                                        <div class="product-info">
                                                            <h3 class="name"><a href="#">Floral Print Buttoned</a></h3>
                                                            <div class="rating rateit-small"></div>
                                                            <div class="product-price"> <span class="price"> $450.99
                                                                </span>
                                                            </div>
                                                            <!-- /.product-price -->

                                                        </div>
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.product-micro-row -->
                                            </div>
                                            <!-- /.product-micro -->

                                        </div>
                                        <div class="product">
                                            <div class="product-micro">
                                                <div class="row product-micro-row">
                                                    <div class="col col-xs-5">
                                                        <div class="product-image">
                                                            <div class="image"> <a href="#"> <img
                                                                        src="{{ asset('front-assets/images') }}/products/p21.jpg"
                                                                        alt=""> </a>
                                                            </div>
                                                            <!-- /.image -->

                                                        </div>
                                                        <!-- /.product-image -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col2 col-xs-7">
                                                        <div class="product-info">
                                                            <h3 class="name"><a href="#">Floral Print Buttoned</a></h3>
                                                            <div class="rating rateit-small"></div>
                                                            <div class="product-price"> <span class="price"> $450.99
                                                                </span>
                                                            </div>
                                                            <!-- /.product-price -->

                                                        </div>
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.product-micro-row -->
                                            </div>
                                            <!-- /.product-micro -->

                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="products best-product">
                                        <div class="product">
                                            <div class="product-micro">
                                                <div class="row product-micro-row">
                                                    <div class="col col-xs-5">
                                                        <div class="product-image">
                                                            <div class="image"> <a href="#"> <img
                                                                        src="{{ asset('front-assets/images') }}/products/p22.jpg"
                                                                        alt=""> </a>
                                                            </div>
                                                            <!-- /.image -->

                                                        </div>
                                                        <!-- /.product-image -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col2 col-xs-7">
                                                        <div class="product-info">
                                                            <h3 class="name"><a href="#">Floral Print Buttoned</a></h3>
                                                            <div class="rating rateit-small"></div>
                                                            <div class="product-price"> <span class="price"> $450.99
                                                                </span>
                                                            </div>
                                                            <!-- /.product-price -->

                                                        </div>
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.product-micro-row -->
                                            </div>
                                            <!-- /.product-micro -->

                                        </div>
                                        <div class="product">
                                            <div class="product-micro">
                                                <div class="row product-micro-row">
                                                    <div class="col col-xs-5">
                                                        <div class="product-image">
                                                            <div class="image"> <a href="#"> <img
                                                                        src="{{ asset('front-assets/images') }}/products/p23.jpg"
                                                                        alt=""> </a>
                                                            </div>
                                                            <!-- /.image -->

                                                        </div>
                                                        <!-- /.product-image -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col2 col-xs-7">
                                                        <div class="product-info">
                                                            <h3 class="name"><a href="#">Floral Print Buttoned</a></h3>
                                                            <div class="rating rateit-small"></div>
                                                            <div class="product-price"> <span class="price"> $450.99
                                                                </span>
                                                            </div>
                                                            <!-- /.product-price -->

                                                        </div>
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.product-micro-row -->
                                            </div>
                                            <!-- /.product-micro -->

                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="products best-product">
                                        <div class="product">
                                            <div class="product-micro">
                                                <div class="row product-micro-row">
                                                    <div class="col col-xs-5">
                                                        <div class="product-image">
                                                            <div class="image"> <a href="#"> <img
                                                                        src="{{ asset('front-assets/images') }}/products/p24.jpg"
                                                                        alt=""> </a>
                                                            </div>
                                                            <!-- /.image -->

                                                        </div>
                                                        <!-- /.product-image -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col2 col-xs-7">
                                                        <div class="product-info">
                                                            <h3 class="name"><a href="#">Floral Print Buttoned</a></h3>
                                                            <div class="rating rateit-small"></div>
                                                            <div class="product-price"> <span class="price"> $450.99
                                                                </span>
                                                            </div>
                                                            <!-- /.product-price -->

                                                        </div>
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.product-micro-row -->
                                            </div>
                                            <!-- /.product-micro -->

                                        </div>
                                        <div class="product">
                                            <div class="product-micro">
                                                <div class="row product-micro-row">
                                                    <div class="col col-xs-5">
                                                        <div class="product-image">
                                                            <div class="image"> <a href="#"> <img
                                                                        src="{{ asset('front-assets/images') }}/products/p25.jpg"
                                                                        alt=""> </a>
                                                            </div>
                                                            <!-- /.image -->

                                                        </div>
                                                        <!-- /.product-image -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col2 col-xs-7">
                                                        <div class="product-info">
                                                            <h3 class="name"><a href="#">Floral Print Buttoned</a></h3>
                                                            <div class="rating rateit-small"></div>
                                                            <div class="product-price"> <span class="price"> $450.99
                                                                </span>
                                                            </div>
                                                            <!-- /.product-price -->

                                                        </div>
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.product-micro-row -->
                                            </div>
                                            <!-- /.product-micro -->

                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="products best-product">
                                        <div class="product">
                                            <div class="product-micro">
                                                <div class="row product-micro-row">
                                                    <div class="col col-xs-5">
                                                        <div class="product-image">
                                                            <div class="image"> <a href="#"> <img
                                                                        src="{{ asset('front-assets/images') }}/products/p26.jpg"
                                                                        alt=""> </a>
                                                            </div>
                                                            <!-- /.image -->

                                                        </div>
                                                        <!-- /.product-image -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col2 col-xs-7">
                                                        <div class="product-info">
                                                            <h3 class="name"><a href="#">Floral Print Buttoned</a></h3>
                                                            <div class="rating rateit-small"></div>
                                                            <div class="product-price"> <span class="price"> $450.99
                                                                </span>
                                                            </div>
                                                            <!-- /.product-price -->

                                                        </div>
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.product-micro-row -->
                                            </div>
                                            <!-- /.product-micro -->

                                        </div>
                                        <div class="product">
                                            <div class="product-micro">
                                                <div class="row product-micro-row">
                                                    <div class="col col-xs-5">
                                                        <div class="product-image">
                                                            <div class="image"> <a href="#"> <img
                                                                        src="{{ asset('front-assets/images') }}/products/p27.jpg"
                                                                        alt=""> </a>
                                                            </div>
                                                            <!-- /.image -->

                                                        </div>
                                                        <!-- /.product-image -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col2 col-xs-7">
                                                        <div class="product-info">
                                                            <h3 class="name"><a href="#">Floral Print Buttoned</a></h3>
                                                            <div class="rating rateit-small"></div>
                                                            <div class="product-price"> <span class="price"> $450.99
                                                                </span>
                                                            </div>
                                                            <!-- /.product-price -->

                                                        </div>
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.product-micro-row -->
                                            </div>
                                            <!-- /.product-micro -->

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.sidebar-widget-body -->
                    </div>
                    <!-- /.sidebar-widget -->
                    <!-- ============================================== BEST SELLER : END ============================================== -->

                    <!-- ============================================== BLOG SLIDER ============================================== -->
                    <section class="section latest-blog outer-bottom-vs wow fadeInUp">
                        <h3 class="section-title">latest form blog</h3>
                        <div class="blog-slider-container outer-top-xs">
                            <div class="owl-carousel blog-slider custom-carousel">
                                <div class="item">
                                    <div class="blog-post">
                                        <div class="blog-post-image">
                                            <div class="image"> <a href="blog.html"><img
                                                        src="{{ asset('front-assets/images') }}/blog-post/post1.jpg"
                                                        alt=""></a> </div>
                                        </div>
                                        <!-- /.blog-post-image -->

                                        <div class="blog-post-info text-left">
                                            <h3 class="name"><a href="#">Voluptatem accusantium doloremque
                                                    laudantium</a>
                                            </h3>
                                            <span class="info">By Jone Doe &nbsp;|&nbsp; 21 March 2016 </span>
                                            <p class="text">Sed quia non numquam eius modi tempora incidunt ut labore et
                                                dolore magnam aliquam quaerat voluptatem.</p>
                                            <a href="#" class="lnk btn btn-primary">Read more</a>
                                        </div>
                                        <!-- /.blog-post-info -->

                                    </div>
                                    <!-- /.blog-post -->
                                </div>
                                <!-- /.item -->

                                <div class="item">
                                    <div class="blog-post">
                                        <div class="blog-post-image">
                                            <div class="image"> <a href="blog.html"><img
                                                        src="{{ asset('front-assets/images') }}/blog-post/post2.jpg"
                                                        alt=""></a> </div>
                                        </div>
                                        <!-- /.blog-post-image -->

                                        <div class="blog-post-info text-left">
                                            <h3 class="name"><a href="#">Dolorem eum fugiat quo voluptas nulla
                                                    pariatur</a>
                                            </h3>
                                            <span class="info">By Saraha Smith &nbsp;|&nbsp; 21 March 2016 </span>
                                            <p class="text">Sed quia non numquam eius modi tempora incidunt ut labore et
                                                dolore magnam aliquam quaerat voluptatem.</p>
                                            <a href="#" class="lnk btn btn-primary">Read more</a>
                                        </div>
                                        <!-- /.blog-post-info -->

                                    </div>
                                    <!-- /.blog-post -->
                                </div>
                                <!-- /.item -->

                                <!-- /.item -->

                                <div class="item">
                                    <div class="blog-post">
                                        <div class="blog-post-image">
                                            <div class="image"> <a href="blog.html"><img
                                                        src="{{ asset('front-assets/images') }}/blog-post/post1.jpg"
                                                        alt=""></a> </div>
                                        </div>
                                        <!-- /.blog-post-image -->

                                        <div class="blog-post-info text-left">
                                            <h3 class="name"><a href="#">Dolorem eum fugiat quo voluptas nulla
                                                    pariatur</a>
                                            </h3>
                                            <span class="info">By Saraha Smith &nbsp;|&nbsp; 21 March 2016 </span>
                                            <p class="text">Sed ut perspiciatis unde omnis iste natus error sit
                                                voluptatem
                                                accusantium</p>
                                            <a href="#" class="lnk btn btn-primary">Read more</a>
                                        </div>
                                        <!-- /.blog-post-info -->

                                    </div>
                                    <!-- /.blog-post -->
                                </div>
                                <!-- /.item -->

                                <div class="item">
                                    <div class="blog-post">
                                        <div class="blog-post-image">
                                            <div class="image"> <a href="blog.html"><img
                                                        src="{{ asset('front-assets/images') }}/blog-post/post2.jpg"
                                                        alt=""></a> </div>
                                        </div>
                                        <!-- /.blog-post-image -->

                                        <div class="blog-post-info text-left">
                                            <h3 class="name"><a href="#">Dolorem eum fugiat quo voluptas nulla
                                                    pariatur</a>
                                            </h3>
                                            <span class="info">By Saraha Smith &nbsp;|&nbsp; 21 March 2016 </span>
                                            <p class="text">Sed ut perspiciatis unde omnis iste natus error sit
                                                voluptatem
                                                accusantium</p>
                                            <a href="#" class="lnk btn btn-primary">Read more</a>
                                        </div>
                                        <!-- /.blog-post-info -->

                                    </div>
                                    <!-- /.blog-post -->
                                </div>
                                <!-- /.item -->

                                <div class="item">
                                    <div class="blog-post">
                                        <div class="blog-post-image">
                                            <div class="image"> <a href="blog.html"><img
                                                        src="{{ asset('front-assets/images') }}/blog-post/post1.jpg"
                                                        alt=""></a> </div>
                                        </div>
                                        <!-- /.blog-post-image -->

                                        <div class="blog-post-info text-left">
                                            <h3 class="name"><a href="#">Dolorem eum fugiat quo voluptas nulla
                                                    pariatur</a>
                                            </h3>
                                            <span class="info">By Saraha Smith &nbsp;|&nbsp; 21 March 2016 </span>
                                            <p class="text">Sed ut perspiciatis unde omnis iste natus error sit
                                                voluptatem
                                                accusantium</p>
                                            <a href="#" class="lnk btn btn-primary">Read more</a>
                                        </div>
                                        <!-- /.blog-post-info -->

                                    </div>
                                    <!-- /.blog-post -->
                                </div>
                                <!-- /.item -->

                            </div>
                            <!-- /.owl-carousel -->
                        </div>
                        <!-- /.blog-slider-container -->
                    </section>
                    <!-- /.section -->
                    <!-- ============================================== BLOG SLIDER : END ============================================== -->

                    <!-- ============================================== FEATURED PRODUCTS ============================================== -->
                    <section class="section wow fadeInUp new-arriavls">
                        <h3 class="section-title">New Arrivals</h3>
                        <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
                            @foreach ($latestproducts as $productItem)
                                <div class="item item-carousel">
                                    <div class="products">
                                        <div class="product">
                                            <div class="product-image">
                                                <div class="image"> <a href="{{ route('product.details',  $productItem->product_slug ) }}"><img src="{{ asset($productItem->thmbnail) }}" alt=""></a> </div>
                                                <!-- /.image -->

                                                @php
                                                    $discount = (($productItem->selling_price - $productItem->descount_price) / $productItem->selling_price) * 100;
                                                @endphp
                                                @if ($productItem->descount_price == null)
                                                    <div class="tag new"><span>new</span></div>
                                                @else
                                                    <div class="tag hot"><span>{{ round($discount) }}%</span></div>
                                                @endif
                                            </div>
                                            <!-- /.product-image -->

                                            <div class="product-info text-left">
                                                <h3 class="name"><a href="{{ route('product.details',  $productItem->product_slug ) }}">{{ Str::limit($productItem->product_name, 23) }}</a>
                                                </h3>
                                                <div class="rating rateit-small"></div>
                                                <div class="description"></div>
                                                <div class="product-price">
                                                    @if ($productItem->descount_price == null)
                                                    <span class="price"> ${{ $productItem->selling_price }}</span>
                                                    @else
                                                    <span class="price"> ${{ $productItem->descount_price }}</span>
                                                    <span class="price-before-discount"> ${{ $productItem->selling_price }} </span>
                                                    @endif
                                                    <!-- /.product-price -->
                                                </div>
                                                <!-- /.product-info -->
                                                <div class="cart clearfix animate-effect">
                                                    <div class="action">
                                                        <ul class="list-unstyled">
                                                            <li class="add-cart-button btn-group">
                                                                <button class="btn btn-primary icon" data-toggle="dropdown"
                                                                    type="button"> <i class="fa fa-shopping-cart"></i>
                                                                </button>
                                                                <button class="btn btn-primary cart-btn" type="button">Add
                                                                    to cart</button>
                                                            </li>
                                                            <li class="lnk wishlist"> <a class="add-to-cart"
                                                                    href="detail.html" title="Wishlist"> <i
                                                                        class="icon fa fa-heart"></i> </a>
                                                            </li>
                                                            <li class="lnk"> <a class="add-to-cart" href="detail.html"
                                                                    title="Compare"> <i class="fa fa-signal"
                                                                        aria-hidden="true"></i> </a> </li>
                                                        </ul>
                                                    </div>
                                                    <!-- /.action -->
                                                </div>
                                                <!-- /.cart -->
                                            </div>
                                            <!-- /.product -->

                                        </div>
                                        <!-- /.products -->
                                    </div>
                                    <!-- /.item -->
                                </div>
                            @endforeach
                        </div>
                        <!-- /.home-owl-carousel -->
                    </section>
                    <!-- /.section -->
                    <!-- ============================================== FEATURED PRODUCTS : END ============================================== -->
                    <!-- ============================================== CONTENT : END ============================================== -->
                    <!-- /.row -->
                </div>
            <!-- /.container -->
            </div>
        </div>
    </div>
     <!-- /#top-banner-and-menu -->
 @endsection

 @section('footer_js')
 <script src="//plugincave.com/js/script.js"></script>

 @endsection
