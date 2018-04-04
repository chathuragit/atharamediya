@extends('layouts.app')

@section('header_scripts')
@endsection

@section('page_header')
    <header>
        <div class="container-flid full-banner member-banner" @if($Member->corporate_color_forground != null) style="background: #{{$Member->corporate_color_forground}}" @endif>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h1 class="text-center seo member-profile-heading">{{$Member->title}}</h1>
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
                            <a href="{{url('/')}}" title="Atharamediya"><img src="{{ asset('/images/logo-atharamediya.png') }}" alt="Athramediya" class="img-fluid home-logo"></a>
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
                            <h3 class="text-center">{{$Member->title}}</h3>
                            <figure>
                                @php
                                    if(($Member->logo != null) && ($Member->logo != '') && file_exists('uploads/'.$Member->logo)){
                                        $default_image = $Member->logo;
                                    }
                                    else{
                                       $default_image = 'default_image.jpg';
                                    }
                                @endphp

                                <img src="{{url('/uploads/'.$default_image)}}" alt="{{$Member->title}}" class="img-fluid">
                            </figure>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <h3>Contact the Member</h3>
                            @if($Member->contact_number != null)
                            <p class="member-contact">
                                <a href="tel:{{$Member->contact_number}}"><i class="fa fa-phone-square" aria-hidden="true"></i>
                                    <span class="member-tel">{{$Member->contact_number}}</span>
                            </p>
                            @endif
                            @if($Member->contact_email != null)
                            <p class="member-contact">
                                <a href="mailto:{{$Member->contact_email}}"><i class="fa fa-envelope-square" aria-hidden="true"></i>
                                    <span class="contact-email">{{$Member->contact_email}}</span></a>
                            </p>
                            @endif

                            @if($Member->address != null)
                            <hr>
                            <h3>Member's Office:</h3>
                            <p>{{$Member->address}}</p>
                            @endif

                            @if(is_object($ArticlesLeft) && (count($ArticlesLeft) > 0))
                                <div class="row">
                                    @foreach($ArticlesLeft as $ArticleLeft)
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <h3 class="vgap">{!! $ArticleLeft->title !!}</h3>
                                            {!!$ArticleLeft->desc !!}
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                        </div>
                    </div>
                </article>
                <section class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text-center mid-section member-section" @if($Member->corporate_color_background != null) style="background: #{{$Member->corporate_color_background}}" @endif>
                    @php
                        if(($Member->cover_image != null) && ($Member->cover_image != '') && file_exists('uploads/'.$Member->cover_image)){
                            $default_image = $Member->cover_image;
                        }
                        else{
                           $default_image = 'default_cover_image.jpg';
                        }
                    @endphp

                    <div class="row product-list-item">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <a href="{{url('/member/'.$Member->slug)}}" title="{{$Member->title}}">
                                <img src="{{url('/uploads/'.$default_image)}}" alt="{{$Member->title}}" class="img-fluid">
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <h3 class="vgap heading3 nogap-bottom member-ads-heading">All Ads from {{$Member->title}}</h3>
                        </div>
                    </div>

                    @if(count($Advertisments) > 0)
                        @foreach($Advertisments as $Advertisment)
                            <div class="row product-list-item">
                                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 img-product-list">
                                    <span class="member-tag">Member</span>
                                    <a href="{{url('/advertisment/'.$Advertisment->slug)}}" title="{{$Advertisment->title}}">
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
                                    </a>
                                </div>
                                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                                    <p class="item-title"><a href="{{url('/advertisment/'.$Advertisment->slug)}}" title="{{$Advertisment->title}}">{{$Advertisment->title}}</a></p>
                                    <p class="item-meta">{{ (count($Advertisment->advertisment_default_attribute_and_value($Advertisment->id, $Advertisment->sub_category_id)) > 0) ? $Advertisment->advertisment_default_attribute_and_value($Advertisment->id, $Advertisment->sub_category_id)->attribute_value : ''}}</p>
                                    <p class="item-location">{{($Advertisment->location != '') ? $Advertisment->location.', ': ''}}{{(count($Advertisment->advertisment_location) > 0) ? $Advertisment->advertisment_location->district : ''}}</p>
                                    <p class="item-info text-right"><span class="item-price">{{ 'Rs. '.$Advertisment->price.' /=' }}</span></p>
                                </div>
                            </div>
                        @endforeach
                    @endif

                    <div class="row product-list-item pagination-holder">
                        {{$Advertisments->links()}}
                    </div>
                </section>
                <aside class="col-xs-2 col-sm-2 col-md-2 col-lg-2 icon-bar">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="text-right social-icons">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{Request::fullUrl()}}" title="Facebook"><i class="fa fa-facebook-square"></i></a>
                                <a href="https://twitter.com/home?status={{Request::fullUrl()}}" title="Twitter"><i class="fa fa-twitter-square"></i></a>
                                <a href="https://plus.google.com/share?url={{urlencode(Request::fullUrl())}}" title="Google Plus"><i class="fa fa-google-plus-square"></i></a>
                                <h2 class="text-right">Share...</h2>
                            </div>

                            @if(is_object($ArticlesRight) && (count($ArticlesRight) > 0))
                                <div class="row">
                                    @foreach($ArticlesRight as $ArticleRight)
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <h2 class="vgap">{!! $ArticleRight->title !!}</h2>
                                            {!!$ArticleRight->desc !!}
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </main>
@endsection