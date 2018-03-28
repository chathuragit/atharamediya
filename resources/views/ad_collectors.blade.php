@extends('layouts.app')

@section('header_scripts')
@endsection

@section('page_header')
    <header>
        <div class="container-flid full-banner">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h1 class="text-center seo">Ad Collectors of Atharamediya</h1>
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
                            <h2 class="text-center">Ad Collectors</h2>
                        </div>
                    </div>
                    <!-- /intro -->
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
                </article>
                <section class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text-center mid-section member-section">
                    @if (isset($Page) && ($Page->cover_image != null) && (file_exists(public_path() . '/uploads/' . $Page->cover_image)))
                    <div class="row product-list-item">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <img src="{{url('/').'/uploads/'.$Page->cover_image}}" alt="{{$Page->page_title}}" class="img-fluid">
                        </div>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <h3 class="vgap heading3 nogap-bottom member-ads-heading">All Ad Collectors</h3>
                        </div>
                    </div>

                    @if(count($Members) > 0)
                        @foreach($Members as $Member)
                            <div class="row product-list-item">
                                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 img-product-list">
                                    <span class="member-tag">Ad Collector</span>
                                    @php
                                        if(($Member->logo != null) && ($Member->logo != '') && file_exists('uploads/'.$Member->logo)){
                                            $default_image = $Member->logo;
                                        }
                                        else{
                                           $default_image = 'default_image.jpg';
                                        }
                                    @endphp

                                    <a href="{{url('/adcollector/'.$Member->slug)}}" title="{{$Member->title}}">
                                        <img src="{{url('/uploads/'.$default_image)}}" alt="{{$Member->title}}" class="img-fluid">
                                    </a>
                                </div>
                                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                                    <p class="item-title"><a href="{{url('/adcollector/'.$Member->slug)}}" title="{{$Member->title}}">{{$Member->title}}</a></p>
                                    <p class="item-meta">
                                        {{ ($Member->contact_number != '') ? $Member->contact_number : '' }}
                                        {{ (($Member->contact_number != '') && ($Member->contact_email != '')) ? '&' : '' }}
                                        {{ ($Member->contact_email != '') ? $Member->contact_email : '' }}
                                    </p>
                                    @if($Member->address != null)
                                        <p class="item-location">{{$Member->address}}</p>
                                    @endif
                                    <p class="item-info text-right"><span class="item-price">More Info</span></p>
                                </div>
                            </div>
                        @endforeach
                    @endif

                    <div class="row product-list-item pagination-holder">
                        {{$Members->links()}}
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