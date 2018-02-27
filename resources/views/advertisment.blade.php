@extends('layouts.app')

@section('page_header')
    <header>
        <div class="container-flid full-banner">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h1 class="text-center seo">{{$Advertisment->title}}</h1>
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
                @include('includes.left_bar')

                <section class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text-center mid-section">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <!-- Search -->
                            {!! Form::open(['url' => 'all-ads/', 'method' => 'GET', 'files'=>true, 'id' => 'advanced-search', 'class' => 'inner-page-advanced-search']) !!}
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="input-group vgap">
                                            <div class="input-group-btn">
                                                <button type="button" class="btn btn-secondary dropdown-toggle btn-home-category" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Select From Category</button>
                                                <div class="dropdown-menu dropdown-menu-home">
                                                    <a class="dropdown-item" href="{{url('/all-ads')}}">All Categories</a>
                                                    <div role="separator" class="dropdown-divider"></div>
                                                    @if(count($ParentCategories) > 0)
                                                        @foreach($ParentCategories as $ParentCategory)
                                                            <a class="dropdown-item" href="{{url('/all-ads')}}/?category={{$ParentCategory->slug}}">{{$ParentCategory->category_name}}</a>
                                                            <div role="separator" class="dropdown-divider"></div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                            <input type="text" name="search" class="form-control home-search-input" aria-label="Text input with dropdown button" placeholder="Search for anything">
                                            <input type="submit" value="" class="home-search-submit">
                                        </div>
                                    </div>
                                </div>
                        {!! Form::close() !!}
                            <!-- /Search -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <h2 class="vgap item-heading">{{$Advertisment->title}}
                                <a href="tel:+94772256488" class="contact">
                                    <i class="fa fa-phone-square" aria-hidden="true"></i>
                                    077-225-6488
                                    <span class="contact-name">Chathura Wijekoon</span></a></h2>
                        </div>
                    </div>
                    <div class="row product-item">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 product-item-wrapper">
                            <div class="btn-back">
                                <a href="#" title="Back"><span>&lt;</span></a>
                            </div>
                            <figure>
                                @php
                                    if(count($Advertisment->advertisment_default_image($Advertisment->id)) > 0){
                                        $default_image = $Advertisment->advertisment_default_image($Advertisment->id);
                                        $default_image = $default_image->data_url;
                                    }
                                    elseif(count($Advertisment->advertisment_first_image($Advertisment->id)) > 0){
                                        $default_image = $Advertisment->advertisment_first_image($Advertisment->id);
                                        $default_image = $default_image->data_url;
                                    }
                                    else{
                                       $default_image = 'default_image.jpg';
                                    }
                                @endphp

                                <img src="{{url('/uploads/'.$default_image)}}" alt="{{$Advertisment->title}}" class="img-fluid">
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
                                    <a href="{{ asset('uploads/'.$default_image)}}" data-toggle="lightbox" data-gallery="example-gallery">
                                        <img src="{{ asset('uploads/'.$default_image)}}" alt="{{$Advertisment->title}}" class="img-fluid">
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ asset('images/ads/gal-1/standard-nissan-leaf-2.jpg')}}" data-toggle="lightbox" data-gallery="example-gallery">
                                        <img src="{{ asset('images/ads/gal-1/thumb-nissan-leaf-2.jpg')}}" alt="Nissan Leaf" class="img-fluid">
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ asset('images/ads/gal-1/standard-nissan-leaf-3.jpg')}}" data-toggle="lightbox" data-gallery="example-gallery">
                                        <img src="{{ asset('images/ads/gal-1/thumb-nissan-leaf-3.jpg')}}" alt="Nissan Leaf" class="img-fluid">
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ asset('images/ads/gal-1/standard-nissan-leaf-4.jpg')}}" data-toggle="lightbox" data-gallery="example-gallery">
                                        <img src="{{ asset('images/ads/gal-1/thumb-nissan-leaf-4.jpg')}}" alt="Nissan Leaf" class="img-fluid">
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
                                        <span class="amount">{{$Advertisment->price}}</span>
                                        <span class="r1"></span>
                                        <span class="r2"></span>
                                        <span class="r3"></span>
                                    </div>
                                </div>
                                <!-- /UI Price Tag -->
                                <h3 class="heading3 vgap">Description:</h3>
                                <p>
                                    {{$Advertisment->description}}
                                </p>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                            <div class="single-product-details">
                                <h3 class="heading3">Product Details:</h3>
                                @if(count($AdvertismentAttributes) > 0)
                                    @foreach($AdvertismentAttributes as $AdvertismentAttribute)
                                        <dl>
                                            <dt>{{$AdvertismentAttribute->attribute_name}} : </dt>

                                            @if(!$Advertisment->is_serial($AdvertismentAttribute->attribute_value))
                                                <dd>{{$AdvertismentAttribute->attribute_value}}</dd>
                                            @else
                                                @foreach(unserialize($AdvertismentAttribute->attribute_value) as $value)
                                                    <dd>{{$value}}, </dd>
                                                @endforeach
                                            @endif
                                        </dl>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>

                    @include('includes.advertisment_list')

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <h3 class="heading3 vgap text-right"><a href="{{url('/all-ads')}}" title="All Ads">All Adds<span class="arrow-right"></span></a></h3>
                        </div>
                    </div>
                </section>

                @include('includes.right_bar')
            </div>
        </div>
    </main>
@endsection

@section('page_JS')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.js"></script>
    <script>
        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox();
        });
    </script>
@endsection