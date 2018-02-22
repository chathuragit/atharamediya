@extends('layouts.app')

@section('page_header')
    <header>
        <div class="container-flid full-banner">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h1 class="text-center seo">All Advertisements</h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
@endsection

@section('content')
    <main>
        <div class="container">
            <div class="row">
                @include('includes.left_bar')

                <section class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text-center mid-section">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <!-- Search -->
                            <form method="GET" action="http://www.atharamediya.lk/ads" accept-charset="UTF-8" id="advanced-search" class="inner-page-advanced-search">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="input-group vgap">
                                            <div class="input-group-btn">
                                                <button type="button" class="btn btn-secondary dropdown-toggle btn-home-category" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Select From Category</button>
                                                <div class="dropdown-menu dropdown-menu-home">
                                                    <a class="dropdown-item" href="#">All Categories</a>
                                                    <div role="separator" class="dropdown-divider"></div>
                                                    <a class="dropdown-item" href="#">Motorbikes &amp; Vehicles</a>
                                                    <div role="separator" class="dropdown-divider"></div>
                                                    <a class="dropdown-item" href="#">Electrical &amp; Electronic</a>
                                                    <div role="separator" class="dropdown-divider"></div>
                                                    <a class="dropdown-item" href="#">Land &amp; Property</a>
                                                    <div role="separator" class="dropdown-divider"></div>
                                                    <a class="dropdown-item" href="#">Hotels &amp; Restaurants</a>
                                                    <div role="separator" class="dropdown-divider"></div>
                                                    <a class="dropdown-item" href="#">Other Items</a>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control home-search-input" aria-label="Text input with dropdown button" placeholder="Search for anything">
                                            <input type="submit" value="" class="home-search-submit">
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- /Search -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <h2 class="vgap item-heading">Sinhgle Item Name<a href="tel:+94772256488" class="contact"><i class="fa fa-phone-square" aria-hidden="true"></i> 077-225-6488<span class="contact-name">Chathura Wijekoon</span></a></h2>
                        </div>
                    </div>
                    <div class="row product-item">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 product-item-wrapper">
                            <div class="btn-back">
                                <a href="#" title="Back"><span>&lt;</span></a>
                            </div>
                            <figure>
                                <img src="images/ads/gal-1/standard-nissan-leaf-1.jpg" alt="Nissan Leaf" class="img-fluid">
                                <figcaption>Front Side View of [Item Name]</figcaption>
                            </figure>
                            <div class="btn-next">
                                <a href="#" title="Next"><span>&gt;</span></a>
                            </div>
                        </div>
                    </div>
                    <div class="row product-gal-items">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <ul>
                                <li>
                                    <a href="images/ads/gal-1/standard-nissan-leaf-1.jpg" data-toggle="lightbox" data-gallery="example-gallery">
                                        <img src="images/ads/gal-1/thumb-nissan-leaf-1.jpg" alt="Nissan Leaf" class="img-fluid">
                                    </a>
                                </li>
                                <li>
                                    <a href="images/ads/gal-1/standard-nissan-leaf-2.jpg" data-toggle="lightbox" data-gallery="example-gallery">
                                        <img src="images/ads/gal-1/thumb-nissan-leaf-2.jpg" alt="Nissan Leaf" class="img-fluid">
                                    </a>
                                </li>
                                <li>
                                    <a href="images/ads/gal-1/standard-nissan-leaf-3.jpg" data-toggle="lightbox" data-gallery="example-gallery">
                                        <img src="images/ads/gal-1/thumb-nissan-leaf-3.jpg" alt="Nissan Leaf" class="img-fluid">
                                    </a>
                                </li>
                                <li>
                                    <a href="images/ads/gal-1/standard-nissan-leaf-4.jpg" data-toggle="lightbox" data-gallery="example-gallery">
                                        <img src="images/ads/gal-1/thumb-nissan-leaf-4.jpg" alt="Nissan Leaf" class="img-fluid">
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
                            <div class="single-product-description">
                                <!-- UI Price Tag -->
                                <div class="ui-price">
                                    <div class="ui-price-tag">
                                        <span class="l1"></span>
                                        <span class="l2"></span>
                                        Rs
                                        <span class="amount">2,856,000</span>
                                        <span class="r1"></span>
                                        <span class="r2"></span>
                                        <span class="r3"></span>
                                    </div>
                                </div>
                                <!-- /UI Price Tag -->
                                <h3 class="heading3 vgap">Prodcut Description:</h3>
                                <p>*ඔබගේ පරණ මෝටර් රථයට ඉහලම මිලක් ලබාගෙන අලුත්ම අළුත් නිසාන් ලීෆ් රථයකට  මාරුවෙන්න.*** *** ආ සැනින් රැගෙන යන්න..... අඩුම ලියකියවිලි, විනාඩි 10න් ලීසින් මූලික ගෙවීම Rs.500000/- Rs. 99585/- X 36 Rs.22940/- X 24 </p>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                            <div class="single-product-details">
                                <h3 class="heading3">Product Details:</h3>
                                <dl>
                                    <dt>Condition:</dt><dd>New</dd>
                                </dl>
                                <dl>
                                    <dt>Brand:</dt><dd>Nissan</dd>
                                </dl>
                                <dl>
                                    <dt>Model year:</dt><dd>2017</dd>
                                </dl>
                                <dl>
                                    <dt>Model:</dt><dd>Leaf Plug-in Maroon</dd>
                                </dl>
                                <dl>
                                    <dt>Engine capacity:</dt><dd>Full Electric</dd>
                                </dl>
                                <dl>
                                    <dt>Mileage:</dt><dd>0 km</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <h3 class="heading3">Similar Adds</h3>
                        </div>
                    </div>
                    <div class="row product-list-item boost">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 img-product-list">
                            <a href="#" title="Sample Ad"><img src="images/ads/ad-0-sample.jpg" alt="Ad Sample" class="img-fluid"><span>Web Space Advertisement of Relevant Category</span></a>
                        </div>
                    </div>
                    <div class="row product-list-item">
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 img-product-list">
                            <a href="#" title="Land Sale in Kalutara"><img src="images/ads/ad-2-land-sale.jpg" alt="Nissan Leaf" class="img-fluid"></a>
                        </div>
                        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                            <p class="item-title"><a href="#" title="Land to be sold in Kalutara">Buy a Land From Kalutara</a></p>
                            <p class="item-meta">20.0 Perches</p>
                            <p class="item-location">Nagas Junction, Kalutara North.</p>
                            <p class="item-info text-right"><span class="item-price">Rs. 2,650,000 /=</span></p>
                        </div>
                    </div>
                    <div class="row product-list-item">
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 img-product-list">
                            <a href="#" title="Computer sale"><img src="images/ads/ad-3-computers.jpg" alt="Selling Computers" class="img-fluid"></a>
                        </div>
                        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                            <p class="item-title"><a href="#" title="Pentium IV and Apple Think Pad">Computers for the Best Price</a></p>
                            <p class="item-meta">Pentium IV and Apple Think Pad</p>
                            <p class="item-location">Digitec Systems, Main Street, Anuradhapura.</p>
                            <p class="item-info text-right"><span class="item-price">Rs. 125,000 /=</span></p>
                        </div>
                    </div>
                    <div class="row product-list-item">
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 img-product-list">
                            <a href="#" title="Land Sale"><img src="images/ads/ad-4-land-buy.jpg" alt="Land sales" class="img-fluid"></a>
                        </div>
                        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                            <p class="item-title"><a href="#" title="Land for sale">Land for Selling Immediately.</a></p>
                            <p class="item-meta">120 Perchase</p>
                            <p class="item-location">Naiwala, Gampaha.</p>
                            <p class="item-info text-right"><span class="item-price">Rs. 4,850,000 /=</span></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <h3 class="heading3 vgap text-right"><a href="http://localhost/atharamedi/listing.php" title="All Ads">All Adds<span class="arrow-right"></span></a></h3>
                        </div>
                    </div>
                </section>

                @include('includes.right_bar')
            </div>
        </div>
    </main>
@endsection