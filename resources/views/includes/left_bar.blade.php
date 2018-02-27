<article class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <a href="http://localhost/atharamedi" title="Atharamediya Logo"><img src="{{ asset('images/logo-atharamediya.png')}}" alt="Athramediya Logo" class="img-fluid home-logo"></a>
        </div>
    </div>
    <!-- intro -->
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h2>Inner Page Heading</h2>
            <p>Munere eleifend persecuti has cu. Ex debet tollit has, detracto consulatu conclusionemque his ad. Eu quo commune salutandi.</p>
        </div>
    </div>
    <!-- /intro -->
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <!-- Enter Location -->
            <form method="GET" action="http://www.atharamediya.lk/ads" accept-charset="UTF-8" class="advanced-search vgap">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="input-group enter-location">
                            <input type="text" class="form-control home-search-input" aria-label="Text input with dropdown button" placeholder="Enter location">
                            <input type="submit" value="" class="home-search-submit">
                        </div>
                    </div>
                </div>
            </form>
            <!-- /Enter Location -->
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center vgap">
            @if(isset($left_web_space_banners) && (count($left_web_space_banners) > 0))
                @foreach($left_web_space_banners as $left_banner)
                    <figure>
                        {!!  ($left_banner->link_url != '') ? '<a href="'.$left_banner->link_url.'" target="_blank" class="img-fluid">' : ''  !!}
                            <img src="{{ asset('uploads/'.$left_banner->data_url)}}" alt="{{$left_banner->title}}" class="img-fluid">
                            <figcaption class="text-center">{{$left_banner->title}}</figcaption>
                        {!! ($left_banner->link_url != '') ? '</a>' : ''  !!}
                    </figure>
                @endforeach
            @endif
        </div>
    </div>
</article>