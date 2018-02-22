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
                    @include('includes.advanced_search')

                    @if(count($Advertisments) > 0)
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <h3 class="vgap heading3">All Ads</h3>
                            </div>
                        </div>

                        @php $count = 1; @endphp
                        @foreach($Advertisments as $Advertisment)

                           @if(($count%4 == 1))
                                <div class="row product-list-item boost">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 img-product-list">
                                        <a href="#" title="Sample Ad"><img src="images/ads/ad-0-sample.jpg" alt="Ad Sample" class="img-fluid"><span>Web Space Advertisement</span></a>
                                    </div>
                                </div>
                           @endif

                               <div class="row product-list-item">
                                   <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 img-product-list">
                                       <a href="#" title="Land Sale in Kalutara">

                                           @php
                                                if(count($Advertisment->advertisment_default_image) > 0){
                                                    $default_image = $Advertisment->advertisment_default_image;
                                                }
                                                elseif(count($Advertisment->advertisment_first_image($Advertisment->id)) > 0){
                                                    $default_image = $Advertisment->advertisment_first_image($Advertisment->id);
                                                }
                                                else{
                                                   $default_image = 'default_image.jpg';
                                                }
                                           @endphp

                                           <img src="{{url('/uploads/'.$default_image->data_url)}}" alt="Nissan Leaf" class="img-fluid">
                                       </a>
                                   </div>
                                   <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                                       <p class="item-title"><a href="{{url('/advertisment/'.$Advertisment->slug)}}" title="Land to be sold in Kalutara">{{$Advertisment->title}}</a></p>
                                       <p class="item-meta">20.0 Perches</p>
                                       <p class="item-location">{{(count($Advertisment->advertisment_location) > 0) ? $Advertisment->advertisment_location->district : ''}}</p>
                                       <p class="item-info text-right"><span class="item-price">{{ 'Rs. '.$Advertisment->price.' /=' }}</span></p>
                                   </div>
                               </div>

                           @php $count++; @endphp
                        @endforeach
                    @else
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <h3 class="vgap heading3">No Advertisements Found!</h3>
                            </div>
                        </div>
                    @endif


                    <div class="row product-list-item pagination-holder">
                        {{$Advertisments->links()}}
                    </div>
                </section>

                @include('includes.right_bar')
            </div>
        </div>
    </main>
@endsection