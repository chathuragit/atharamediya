@extends('layouts.app')

@section('header_scripts')
    <script type="text/javascript" src="{{ asset('js/ammap.js')}}"></script>
    <script type="text/javascript" src="{{ asset('js/sriLankaLow.js')}}"></script>
    <script type="text/javascript" src="{{ asset('js/ammap-responsive.min.js')}}"></script>

    <script type="text/javascript">
        $(window).bind("load", function() {
            $('path').click(function(e){
                var area = $(this).attr('aria-label');
                if(area != undefined){
                    $('input[name=location]').val($.trim(area));
                    $('#advanced-search').submit();
                }
            });
        });

        AmCharts.makeChart("map",{
            "type": "map",
            "dragMap": false,
            "autoResize": true,
            "pathToImages": "http://www.amcharts.com/lib/3/images/",
            "addClassNames": true,
            "fontSize": 15,
            "color": "#FFFFFF",
            "projection": "mercator",
            "backgroundAlpha": 1,
            "backgroundColor": "rgba(80,80,80,0.01)",
            "zoomOnDoubleClick": false,
            "dataProvider": {
                "map": "sriLankaLow",
                "getAreasFromMap": true
            },
            "responsive": {
                "enabled": true
            },
            "balloon": {
                "horizontalPadding": 15,
                "borderAlpha": 0,
                "borderThickness": 1,
                "verticalPadding": 15
            },
            "areasSettings": {
                "color": "rgba(255,255,255,0.78)",
                "outlineColor": "rgba(80,80,80,0.01)",
                "rollOverOutlineColor": "rgba(80,80,80,0.01)",
                "rollOverBrightness": 20,
                "selectedBrightness": 20,
                "selectable": false,
                "unlistedAreasAlpha": 0,
                "unlistedAreasOutlineAlpha": 0
            },
            "imagesSettings": {
                "alpha": 1,
                "color": "rgba(255,255,255,0.78)",
                "outlineAlpha": 0,
                "rollOverOutlineAlpha": 0,
                "outlineColor": "rgba(80,80,80,0.01)",
                "rollOverBrightness": 20,
                "selectedBrightness": 20,
                "selectable": false
            },
            "linesSettings": {
                "color": "rgba(255,255,255,0.78)",
                "selectable": false,
                "thickness": 1,
                "rollOverBrightness": 20,
                "selectedBrightness": 20
            },
            "zoomControl": {
                "zoomControlEnabled": false,
                "homeButtonEnabled": false,
                "panControlEnabled": false,
                "right": 0,
                "bottom": 0,
                "minZoomLevel": 1,
                "maxZoomLevel": 1,
                "gridHeight": 0,
                "gridAlpha": 0,
                "gridBackgroundAlpha": 0,
                "gridColor": "#FFFFFF",
                "draggerAlpha": 1,
                "buttonCornerRadius": 2
            }
        });
    </script>
@endsection

@section('page_header')
    <header>
        <div class="container-flid full-banner">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h1 class="text-center seo">විකුණන්නයි බඩු ගන්නයි අතරමැදියා ලඟටයි එන්නේ ...</h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
@endsection

@section('content')

    <main>
        <div class="container">
            <div class="row align-items-center">
                <article class="col-sm-7">
                    <div class="row">
                        <div class="col-sm-12">
                            <a href="http://localhost/atharamedi" title="Atharamediya Logo"><img src="images/logo-atharamediya.png" alt="Athramediya Logo" class="img-fluid home-logo"></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- Search -->
                            {!! Form::open(['url' => 'all-ads/', 'method' => 'GET', 'files'=>true, 'id' => 'advanced-search']) !!}
                                <input type="hidden" name="location" value="">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="input-group">

                                            <select class="selectpicker" name="category">
                                                <option value="">All Categories</option>
                                                @if(count($ParentCategories) > 0)
                                                    @foreach($ParentCategories as $ParentCategory)
                                                        <option value="{{$ParentCategory->slug}}" {{ ($ParentCategory->slug == $request->category) ? 'selected' : '' }} >{{$ParentCategory->category_name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>

                                            <input type="text" name="search" class="form-control home-search-input" aria-label="Text input with dropdown button" placeholder="Search for anything">
                                            <input type="submit" value="" class="home-search-submit">
                                        </div>
                                    </div>
                                </div>
                        {!! Form::close() !!}
                            <!-- /Search -->
                        </div>
                    </div>
                    <!-- intro -->
                    <div class="row">
                        <div class="col-sm-12 home-note">
                            <h2>Buy and sell anything within few seconds - for free!</h2>
                            <p>Munere eleifend persecuti has cu. Ex debet tollit has, detracto consulatu conclusionemque his ad. Eu quo commune salutandi.</p>
                        </div>
                    </div>
                    <!-- /intro -->
                </article>
                <section class="map_wrapper col-sm-3 text-center" >
                    <div id="map"></div>

                    {{--<h3 class="text-center heading3"><span>Browse by Area</span></h3>--}}
                </section>
                <aside class="col-sm-2 icon-bar">
                    <div class="text-right social-icons">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{Request::fullUrl()}}" title="Facebook"><i class="fa fa-facebook-square"></i></a>
                        <a href="https://twitter.com/home?status={{Request::fullUrl()}}" title="Twitter"><i class="fa fa-twitter-square"></i></a>
                        <a href="https://plus.google.com/share?url={{urlencode(Request::fullUrl())}}" title="Google Plus"><i class="fa fa-google-plus-square"></i></a>
                        <h2 class="text-right">Share...</h2>
                    </div>
                    <h2>Categories:</h2>
                    @if(count($ParentCategories) > 0)
                        @foreach($ParentCategories as $ParentCategory)
                        <p>
                            <i class="fa {{$ParentCategory->fontawesome}}" aria-hidden="true"></i><a href="{{url('/all-ads')}}/?category={{$ParentCategory->slug}}" title="{{$ParentCategory->category_name}}">{{$ParentCategory->category_name}}</a>
                        </p>
                        @endforeach
                    @endif
                </aside>
            </div>
        </div>
    </main>

@endsection
