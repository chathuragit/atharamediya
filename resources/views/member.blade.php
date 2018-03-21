@extends('layouts.app')

@section('header_scripts')
@endsection

@section('page_header')
    <header>
        <div class="container-flid full-banner member-banner">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h1 class="text-center seo member-profile-heading">[This Member]</h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
@endsection

@section('content')
    <main>
        <div class="container main-container">
            <div class="row">
                <article class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <a href="http://localhost/atharamedi" title="Atharamediya Logo"><img src="images/logo-atharamediya.png" alt="Athramediya Logo" class="img-fluid home-logo"></a>
                        </div>
                    </div>
                    <!-- intro -->
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <h2 class="text-center">Member Profile of</h2>
                        </div>
                    </div>
                    <!-- /intro -->
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                            <h3 class="text-center">[This Member]</h3>
                            <figure>
                                <img src="images/members/member-profile-photo.jpg" alt="Perera and Sons Profile Image" class="img-fluid">
                                <figcaption class="text-center">Branding of [This Member]</figcaption>
                            </figure>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <h3>Contact the Member</h3>
                            <p class="member-contact"><a href="tel:+94772256488"><i class="fa fa-phone-square" aria-hidden="true"></i> <span class="member-tel">077-225-6488</span><span class="contact-name">Chathura Wijekoon</span></a></p>
                            <p class="member-contact"><a href="mailto:perera@pands.com" title="Back"><i class="fa fa-envelope-square" aria-hidden="true"></i><span class="contact-email">perera@pands.com</span></a></p>
                            <hr>
                            <h3>Member's Office:</h3>
                            <p>No.69/A, Galle Road, Colombo 4.</p>
                            <hr>
                            <h3>News &amp; Events:</h3>
                            <p>A typical list goes like this ...</p>
                            <ul>
                                <li>Lorem ipsum</li>
                                <li>Con dolor</li>
                                <li>aitken dapc</li>
                                <li>Red velthwk</li>
                            </ul>
                            <hr>
                            <h3>Heading 1 goes here</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
                            <hr>
                            <h3>Another Heading goes here</h3>
                            <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                            <p>Lorem ipsum dolor sit amaute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidattur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.
                            <hr>
                            <h3>Another Heading Goes</h3>
                            <p>ehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidattur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim</p>
                            <hr>
                        </div>
                    </div>
                </article>
                <section class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text-center mid-section member-section">
                    <div class="row product-list-item">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <a href="#" title="New Arrival of P and S to Anuradhapura"><img src="images/members/member-cover-page.jpg" alt="Perera and Sons Cover Page" class="img-fluid"></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <h3 class="vgap heading3 nogap-bottom member-ads-heading">All Ads from [This Member]</h3>
                        </div>
                    </div>
                    <div class="row product-list-item">
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 img-product-list">
                            <span class="member-tag">member</span><a href="#" title="Computer sale"><img src="images/ads/ad-3-computers.jpg" alt="Selling Computers" class="img-fluid"></a>
                        </div>
                        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                            <p class="item-title"><a href="#" title="Pentium IV and Apple Think Pad">Computers for the Best Price 2</a></p>
                            <p class="item-meta">Pentium IV and Apple Think Pad</p>
                            <p class="item-location">Digitec Systems, Main Street, Anuradhapura.</p>
                            <p class="item-info text-right"><span class="item-price">Rs. 125,000 /=</span></p>
                        </div>
                    </div>
                    <div class="row product-list-item">
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 img-product-list">
                            <span class="member-tag">member</span><a href="#" title="Land Sale"><img src="images/ads/ad-4-land-buy.jpg" alt="Land sales" class="img-fluid"></a>
                        </div>
                        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                            <p class="item-title"><a href="#" title="Land for sale">Land for Selling Immediately 3</a></p>
                            <p class="item-meta">120 Perchase</p>
                            <p class="item-location">Naiwala, Gampaha.</p>
                            <p class="item-info text-right"><span class="item-price">Rs. 4,850,000 /=</span></p>
                        </div>
                    </div>
                    <div class="row product-list-item">
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 img-product-list">
                            <span class="member-tag">member</span><a href="#" title="Sample Ad"><img src="images/ads/ad-0-sample.jpg" alt="Ad Sample" class="img-fluid"></a>
                        </div>
                        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                            <p class="item-title"><a href="#" title="Nissan Leaf 2017 for sale">Sample Advertisement 4</a></p>
                            <p class="item-meta">Meta details of the item go here.</p>
                            <p class="item-location">Item Location goes here.</p>
                            <p class="item-info text-right"><span class="item-price">Rs 0,000,000 /=</span></p>
                        </div>
                    </div>
                    <div class="row product-list-item">
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 img-product-list">
                            <span class="member-tag">member</span><a href="#" title="Sample Ad"><img src="images/ads/ad-0-sample.jpg" alt="Ad Sample" class="img-fluid"></a>
                        </div>
                        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                            <p class="item-title"><a href="#" title="Nissan Leaf 2017 for sale">Sample Advertisement 5</a></p>
                            <p class="item-meta">Meta details of the item go here.</p>
                            <p class="item-location">Item Location goes here.</p>
                            <p class="item-info text-right"><span class="item-price">Rs 0,000,000 /=</span></p>
                        </div>
                    </div>
                    <div class="row product-list-item">
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 img-product-list">
                            <span class="member-tag">member</span><a href="#" title="Sample Ad"><img src="images/ads/ad-0-sample.jpg" alt="Ad Sample" class="img-fluid"></a>
                        </div>
                        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                            <p class="item-title"><a href="#" title="Nissan Leaf 2017 for sale">Sample Advertisement 6</a></p>
                            <p class="item-meta">Meta details of the item go here.</p>
                            <p class="item-location">Item Location goes here.</p>
                            <p class="item-info text-right"><span class="item-price">Rs 0,000,000 /=</span></p>
                        </div>
                    </div>
                    <div class="row product-list-item">
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 img-product-list">
                            <span class="member-tag">member</span><a href="#" title="Sample Ad"><img src="images/ads/ad-0-sample.jpg" alt="Ad Sample" class="img-fluid"></a>
                        </div>
                        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                            <p class="item-title"><a href="#" title="Nissan Leaf 2017 for sale">Sample Advertisement 7</a></p>
                            <p class="item-meta">Meta details of the item go here.</p>
                            <p class="item-location">Item Location goes here.</p>
                            <p class="item-info text-right"><span class="item-price">Rs 0,000,000 /=</span></p>
                        </div>
                    </div>
                    <div class="row product-list-item">
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 img-product-list">
                            <span class="member-tag">member</span><a href="#" title="Sample Ad"><img src="images/ads/ad-0-sample.jpg" alt="Ad Sample" class="img-fluid"></a>
                        </div>
                        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                            <p class="item-title"><a href="#" title="Nissan Leaf 2017 for sale">Sample Advertisement 8</a></p>
                            <p class="item-meta">Meta details of the item go here.</p>
                            <p class="item-location">Item Location goes here.</p>
                            <p class="item-info text-right"><span class="item-price">Rs 0,000,000 /=</span></p>
                        </div>
                    </div>
                    <div class="row product-list-item">
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 img-product-list">
                            <span class="member-tag">member</span><a href="#" title="Sample Ad"><img src="images/ads/ad-0-sample.jpg" alt="Ad Sample" class="img-fluid"></a>
                        </div>
                        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                            <p class="item-title"><a href="#" title="Nissan Leaf 2017 for sale">Sample Advertisement 9</a></p>
                            <p class="item-meta">Meta details of the item go here.</p>
                            <p class="item-location">Item Location goes here.</p>
                            <p class="item-info text-right"><span class="item-price">Rs 0,000,000 /=</span></p>
                        </div>
                    </div>
                    <div class="row product-list-item">
                        <div class="col-sm-4 img-product-list">
                            <span class="member-tag">member</span><a href="#" title="Sample Ad"><img src="images/ads/ad-0-sample.jpg" alt="Ad Sample" class="img-fluid"></a>
                        </div>
                        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                            <p class="item-title"><a href="#" title="Nissan Leaf 2017 for sale">Sample Advertisement 10</a></p>
                            <p class="item-meta">Meta details of the item go here.</p>
                            <p class="item-location">Item Location goes here.</p>
                            <p class="item-info text-right"><span class="item-price">Rs 0,000,000 /=</span></p>
                        </div>
                    </div>
                    <div class="row product-list-item">
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 img-product-list">
                            <span class="member-tag">member</span><a href="#" title="Sample Ad"><img src="images/ads/ad-0-sample.jpg" alt="Ad Sample" class="img-fluid"></a>
                        </div>
                        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                            <p class="item-title"><a href="#" title="Nissan Leaf 2017 for sale">Sample Advertisement 11</a></p>
                            <p class="item-meta">Meta details of the item go here.</p>
                            <p class="item-location">Item Location goes here.</p>
                            <p class="item-info text-right"><span class="item-price">Rs 0,000,000 /=</span></p>
                        </div>
                    </div>
                    <div class="row product-list-item">
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 img-product-list">
                            <span class="member-tag">member</span><a href="#" title="Sample Ad"><img src="images/ads/ad-0-sample.jpg" alt="Ad Sample" class="img-fluid"></a>
                        </div>
                        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                            <p class="item-title"><a href="#" title="Nissan Leaf 2017 for sale">Sample Advertisement 12</a></p>
                            <p class="item-meta">Meta details of the item go here.</p>
                            <p class="item-location">Item Location goes here.</p>
                            <p class="item-info text-right"><span class="item-price">Rs 0,000,000 /=</span></p>
                        </div>
                    </div>
                    <div class="row product-list-item">
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 img-product-list">
                            <span class="member-tag">member</span><a href="#" title="Sample Ad"><img src="images/ads/ad-0-sample.jpg" alt="Ad Sample" class="img-fluid"></a>
                        </div>
                        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                            <p class="item-title"><a href="#" title="Nissan Leaf 2017 for sale">Sample Advertisement 13</a></p>
                            <p class="item-meta">Meta details of the item go here.</p>
                            <p class="item-location">Item Location goes here.</p>
                            <p class="item-info text-right"><span class="item-price">Rs 0,000,000 /=</span></p>
                        </div>
                    </div>
                    <div class="row product-list-item">
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 img-product-list">
                            <span class="member-tag">member</span><a href="#" title="Sample Ad"><img src="images/ads/ad-0-sample.jpg" alt="Ad Sample" class="img-fluid"></a>
                        </div>
                        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                            <p class="item-title"><a href="#" title="Nissan Leaf 2017 for sale">Sample Advertisement 14</a></p>
                            <p class="item-meta">Meta details of the item go here.</p>
                            <p class="item-location">Item Location goes here.</p>
                            <p class="item-info text-right"><span class="item-price">Rs 0,000,000 /=</span></p>
                        </div>
                    </div>
                    <div class="row product-list-item">
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 img-product-list">
                            <span class="member-tag">member</span><a href="#" title="Sample Ad"><img src="images/ads/ad-0-sample.jpg" alt="Ad Sample" class="img-fluid"></a>
                        </div>
                        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                            <p class="item-title"><a href="#" title="Nissan Leaf 2017 for sale">Sample Advertisement 15</a></p>
                            <p class="item-meta">Meta details of the item go here.</p>
                            <p class="item-location">Item Location goes here.</p>
                            <p class="item-info text-right"><span class="item-price">Rs 0,000,000 /=</span></p>
                        </div>
                    </div>
                    <div class="row product-list-item pagination-holder">
                        <div class="col-xs-2 col-sm-4 col-md-4 col-lg-4 text-right"><a href="#" title="Back">&lt;</a></div>
                        <div class="col-xs-8 col-sm-4 col-md-4 col-lg-4 text-center pagination"><a href="#" title="page">1</a>, <a href="#" title="page">2</a>, <a href="#" title="page">3</a>, ...</div>
                        <div class="col-xs-2 col-sm-4 col-md-4 col-lg-4 text-left"><a href="#" title="Next">&gt;</a></div>
                    </div>
                </section>
                <aside class="col-xs-2 col-sm-2 col-md-2 col-lg-2 icon-bar">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="text-right social-icons">
                                <a href="#" title="Facebook"><i class="fa fa-facebook-square"></i></a>
                                <a href="#" title="Twitter"><i class="fa fa-twitter-square"></i></a>
                                <a href="#" title="Youtube"><i class="fa fa-youtube-square"></i></a>
                                <a href="#" title="Google Plus"><i class="fa fa-google-plus-square"></i></a>
                                <h2 class="text-right">Share...</h2>
                            </div>
                            <h3>Content Heading 1</h3>
                            <p>
                                Atharamediya.lk is a website where you can buy and sell almost everything. The best deals are often done with people who live in your own city or on your own street, etcetera. The Atharamediya.lk provides an easy way to buy and sell locally. All you have to do is select your region.
                            </p>
                            <h3>Content Heading 2</h3>
                            <p>
                                Atharamediya.lk does not specialize in any specific category - here you can buy and sell items in more than 50 different categories. We also carefully review all ads that are being published, to make sure the quality is up to our standards.
                            </p>
                            <h3>Content Heading 3</h3>
                            <p>
                                Atharamediya.lk does not specialize in any specific category - here you can buy and sell items in more than 50 different categories. We also carefully review all ads that are being published, to make sure the quality is up to our standards.
                            </p>
                            <p>
                                If you'd like to get in touch with us, go to Contact us.
                            </p>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </main>
@endsection