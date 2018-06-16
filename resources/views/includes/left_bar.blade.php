<article class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <a href="{{url('/')}}" title="Atharamediya Logo"><img src="{{ asset('images/logo-atharamediya.png')}}" alt="Athramediya Logo" class="img-fluid home-logo"></a>
        </div>
    </div>
    <!-- intro -->

    @if(is_object($ArticlesLeft) && (count($ArticlesLeft) > 0))
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <h2>{!! $ArticlesLeft->title !!}</h2>
                {!! $ArticlesLeft->desc !!}
            </div>
        </div>
    @endif

    <!-- /intro -->
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <!-- Enter Location -->
                {!! Form::open(['url' => 'all-ads/', 'method' => 'GET', 'class' => 'advanced-search vgap']) !!}
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="input-group enter-location">
                            <input type="text" class="form-control home-search-input" name="location" aria-label="Text input with dropdown button" id="location" placeholder="Enter location" value="{{ isset($request->location)? $request->location : '' }}">
                            <input type="submit" value="" class="home-search-submit">
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            <!-- /Enter Location -->
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center vgap " id="left_webBanners">
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

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBTbPWFhqZPQhHCtAcLIhwAMkF1iMS4imQ&libraries=places&callback=initAutocomplete"
        async defer></script>

<script type="text/javascript">
    $(document).ready(function() {
        setInterval(function()
        {
            $.ajax({
                type:"post",
                url:"/web_banners_ajax",
                data: { side : 1, _token: '{{csrf_token()}}' , category : <?php echo $maincategory;?> },
                success:function(data)
                {
                    $('#left_webBanners').html(data);
                }
            });

        }, 10000);
    });

    var placeSearch, autocomplete;
    var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
    };

    function initAutocomplete() {
        var options = {
            types: ['(cities)'],
            componentRestrictions: {country: "lk"}
        };
        var input = document.getElementById('location');
        autocomplete = new google.maps.places.Autocomplete(input, options);
        autocomplete.addListener('place_changed', fillInAddress);
    }

    function fillInAddress() {
        var place = autocomplete.getPlace();
        if(place != undefined && place != null){
            if(place.address_components != undefined && place.address_components != null){
                var type = place.address_components[0].types[0];
                if(type == 'locality'){
                    var addressType = place.address_components[0].types[0];
                    var val = place.address_components[0][componentForm[addressType]];
                    document.getElementById('location').value = val;
                }
            }
        }

        return true;
    }
</script>