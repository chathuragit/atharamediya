@extends('layouts.app')

@section('page_JS')
    <script type="text/javascript" src="{{url('/')}}/js/detail_slider.js"></script>
    <script type="text/javascript">
        $(function(){
            detail_slider('.detail-gallery');
        });
    </script>
@endsection

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
                                            <select class="selectpicker" name="category">
                                                <option value="">All Categories</option>
                                                @if(count($ParentCategories) > 0)
                                                    @foreach($ParentCategories as $ParentCategory)
                                                        <option value="{{$ParentCategory->slug}}" {{ ($ParentCategory->slug == $request->category) ? 'selected' : '' }} >{{$ParentCategory->category_name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <input type="text" name="search" class="form-control home-search-input" aria-label="Text input with dropdown button" placeholder="Search for anything" value="{{$request->search}}">
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
                                <a href="tel:{{$Advertisment->contact_mobile}}" class="contact">

                                    <i class="fa fa-phone-square" aria-hidden="true"></i>
                                    {{$Advertisment->contact_mobile}}

                                    @if(count($Advertisment_user) > 0)
                                        <span class="contact-name">{{$Advertisment_user->name}}</span></a></h2>
                                    @endif
                        </div>
                    </div>
                    <div class="row product-item detail-gallery">
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


                            <div class="detail-gallery-main-image" id="preview_wrapper">
                                <div class="prev"><i class="fa fa-chevron-left" aria-hidden="true"></i></div>
                                <img src="{{$Advertisment->stingImage('uploads/'.$default_image)}}" class="img-responsive" width="100%">
                                <div class="next"><i class="fa fa-chevron-right" aria-hidden="true"></i></div>
                            </div>
                            <div class="detail-gallery-thumbs">
                                <ul>
                                    {{--<li><img src="{{$Advertisment->stingImage('uploads/'.$default_image)}}" class="img-responsive"></li>--}}

                                    @if(is_object($Advertisment->advertisment_media) && !empty($Advertisment->advertisment_media))
                                        @foreach($Advertisment->advertisment_media as $key => $advertisement_image)
                                            @if(File::exists('uploads/'.$advertisement_image->data_url))
                                                <li @if($advertisement_image->default_pic == 1) class="active" @endif><img src="{{$Advertisment->stingImage('uploads/'.$advertisement_image->data_url)}}" class="img-responsive"></li>
                                            @endif
                                        @endforeach
                                    @endif

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

