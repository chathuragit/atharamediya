<aside class="col-xs-2 col-sm-2 col-md-2 col-lg-2 icon-bar">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="text-right social-icons">
                <a href="https://www.facebook.com/sharer/sharer.php?u={{Request::fullUrl()}}" title="Facebook"><i class="fa fa-facebook-square"></i></a>
                <a href="https://twitter.com/home?status={{Request::fullUrl()}}" title="Twitter"><i class="fa fa-twitter-square"></i></a>
                <a href="https://plus.google.com/share?url={{urlencode(Request::fullUrl())}}" title="Google Plus"><i class="fa fa-google-plus-square"></i></a>
                <h2 class="text-right">Share...</h2>
            </div>
            <h2>Categories:</h2>
            <div class="category-list">
            @if(count($ParentCategories) > 0)
                @foreach($ParentCategories as $ParentCategory)
                    <p>
                        <i class="fa {{$ParentCategory->fontawesome}}" aria-hidden="true"></i>
                        <a href="{{url('/all-ads')}}/?category={{$ParentCategory->slug}}" title="{{$ParentCategory->category_name}}">
                            {{$ParentCategory->category_name}}
                        </a>

                        @if(($SelectedCategory != null) && ($SubCategories != null) && ($ParentCategory->id == $SelectedCategory->id) && (count($SubCategories) > 0))
                            <ul class="sub_categories">
                            @foreach($SubCategories as $SubCategory)
                                <li>
                                <a href="{{url('/all-ads')}}/?category={{$SubCategory->slug}}" title="{{$ParentCategory->category_name}}">
                                    {{$SubCategory->category_name}}
                                </a>
                                </li>
                            @endforeach
                            </ul>
                        @endif
                    </p>
                @endforeach
            @endif
            </div>
        </div>
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
</aside>