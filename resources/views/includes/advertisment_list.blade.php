@if(count($Advertisments) > 0)
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h3 class="vgap heading3">Similar Ads</h3>
        </div>
    </div>

    @php
        $count = 1;
        $web_space = 0;
    @endphp
    @foreach($Advertisments as $Advertisment)

        @if(($count%5 == 1))
            <div class="row product-list-item boost">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 img-product-list">
                    @if((count($listing_web_space_banners) > 0))
                        @if(isset($listing_web_space_banners[$web_space]))
                            {!!  ($listing_web_space_banners[$web_space]->link_url != '') ? '<a href="'.$listing_web_space_banners[$web_space]->link_url.'" target="_blank">' : ''  !!}
                                <img src="{{url('/uploads/'.$listing_web_space_banners[$web_space]->data_url)}}" alt="Ad Sample" class="img-fluid">
                                <span>{{$listing_web_space_banners[$web_space]->title}}</span>
                            {!! ($listing_web_space_banners[$web_space]->link_url != '') ? '</a>' : ''  !!}
                        @endif

                    @endif
                </div>
            </div>
            @php $web_space++; @endphp
        @endif

        <div class="row product-list-item">
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 img-product-list">
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