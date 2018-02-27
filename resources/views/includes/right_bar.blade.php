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
            <h2>Categories:</h2>
            @if(count($ParentCategories) > 0)
                @foreach($ParentCategories as $ParentCategory)
                    <p>
                        <i class="fa {{$ParentCategory->fontawesome}}" aria-hidden="true"></i>
                        <a href="{{url('/all-ads')}}/?category={{$ParentCategory->slug}}" title="Motorbikes & Vehicles">
                            {{$ParentCategory->category_name}}
                        </a>
                    </p>
                @endforeach
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h2 class="vgap">What is atharamediya.lk?</h2>
            <p>
                Atharamediya.lk is a website where you can buy and sell almost everything. The best deals are often done with people who live in your own city or on your own street, etcetera. The Atharamediya.lk provides an easy way to buy and sell locally. All you have to do is select your region.
            </p>
            <p>
                Atharamediya.lk does not specialize in any specific category - here you can buy and sell items in more than 50 different categories. We also carefully review all ads that are being published, to make sure the quality is up to our standards.
            </p>
            <p>
                If you'd like to get in touch with us, go to Contact us.
            </p>
        </div>
    </div>
</aside>