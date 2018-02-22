<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <!-- Search -->
        <form method="GET" action="http://www.atharamediya.lk/ads" accept-charset="UTF-8" id="advanced-search" class="inner-page-advanced-search">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="input-group vgap">
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-secondary dropdown-toggle btn-home-category" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Select From Category</button>
                            <div class="dropdown-menu dropdown-menu-home">
                                <a class="dropdown-item" href="{{url('/all-ads')}}">All Categories</a>
                                <div role="separator" class="dropdown-divider"></div>
                                @if(count($ParentCategories) > 0)
                                    @foreach($ParentCategories as $ParentCategory)
                                        <a class="dropdown-item" href="{{url('/all-ads')}}/?category={{$ParentCategory->slug}}">{{$ParentCategory->category_name}}</a>
                                        <div role="separator" class="dropdown-divider"></div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <input type="text" class="form-control home-search-input" aria-label="Text input with dropdown button" placeholder="Search for anything">
                        <input type="submit" value="" class="home-search-submit">
                    </div>
                </div>
            </div>
        </form>
        <!-- /Search -->
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
        <!-- Sort By Category -->
        <form method="GET" action="http://www.atharamediya.lk/ads" accept-charset="UTF-8" class="advanced-search">
            <div class="input-group">
                <div class="input-group-btn">
                    <button type="button" class="btn btn-secondary dropdown-toggle btn-home-category" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sort Based on Rating</button>
                    <div class="dropdown-menu dropdown-menu-home">
                        <a class="dropdown-item" href="#">Highest Rating First</a>
                        <div role="separator" class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Lowest Rating First</a>
                    </div>
                </div>
            </div>
        </form>
        <!-- /Sort By Category -->
    </div>
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
        <!-- Sort By Price -->
        <form method="GET" action="http://www.atharamediya.lk/ads" accept-charset="UTF-8" class="advanced-search">
            <div class="input-group">
                <div class="input-group-btn">
                    <button type="button" class="btn btn-secondary dropdown-toggle btn-home-category" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sort Based on Price</button>
                    <div class="dropdown-menu dropdown-menu-home">
                        <a class="dropdown-item" href="#">Lowest Price First</a>
                        <div role="separator" class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Highest Price First</a>
                    </div>
                </div>
            </div>
        </form>
        <!-- /Sort By Price -->
    </div>
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
        <!-- Sort By Price -->
        <form method="GET" action="http://www.atharamediya.lk/ads" accept-charset="UTF-8" class="advanced-search">
            <div class="input-group">
                <div class="input-group-btn">
                    <button type="button" class="btn btn-secondary dropdown-toggle btn-home-category" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sort Based on Time</button>
                    <div class="dropdown-menu dropdown-menu-home">
                        <a class="dropdown-item" href="#">The Oldest Ad First</a>
                        <div role="separator" class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">The Latest Ad First</a>
                    </div>
                </div>
            </div>
        </form>
        <!-- /Sort By Price -->
    </div>
</div>