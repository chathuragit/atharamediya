
    {!! Form::open(['url' => 'all-ads/', 'method' => 'GET', 'files'=>true, 'id' => 'advanced-search', 'class' => 'inner-page-advanced-search']) !!}
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <!-- Search -->
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="input-group vgap">
                        <select class="selectpicker" name="category">
                            <option value="">All Categories</option>
                            @if(count($ParentCategories) > 0)
                                @foreach($ParentCategories as $ParentCategory)
                                    <option value="{{$ParentCategory->slug}}" {{ ($ParentCategory->slug == $request->category) ? 'selected' : '' }} >{{$ParentCategory->category_name}}</option>
                                @endforeach
                            @endif
                        </select>

                        <input type="text" name="search" class="form-control home-search-input" aria-label="Text input with dropdown button" placeholder="Search for anything" value="{{$request->search}}">
                        <input type="submit" value="" class="home-search-submit">
                    </div>
                </div>
            </div>
            <!-- /Search -->
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
                    <!-- Sort By Category -->
                    <div class="input-group">
                        <select class="selectpicker" name="sort_by_selling">
                            <option value=""></option>
                            <option value="Retailing">Retailing</option>
                            <option value="Whole_Selling">Whole Selling</option>
                        </select>
                    </div>
                    <!-- /Sort By Category -->
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
                    <!-- Sort By Price -->
                    <div class="input-group">
                        <select class="selectpicker" name="sort_by_price">
                            <option value=""></option>
                            <option value="lowast" {{ (isset($request->sort_by_price) && ($request->sort_by_price == "lowast")) ? "selected" : '' }}>Lowest Price First</option>
                            <option value="highest" {{ (isset($request->sort_by_price) && ($request->sort_by_price == "highest")) ? "selected" : '' }}>Highest Price First</option>
                        </select>
                    </div>
                    <!-- /Sort By Price -->
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
                    <!-- Sort By Time -->
                    <div class="input-group">
                        <select class="selectpicker" name="sort_by_time">
                            <option value="">Sort By Time</option>
                            <option value="oldest" {{ (isset($request->sort_by_time) && ($request->sort_by_time == "oldest")) ? "selected" : '' }}>The Oldest Ad First</option>
                            <option value="latest" {{ (isset($request->sort_by_time) && ($request->sort_by_time == "latest")) ? "selected" : '' }}>The Latest Ad First</option>
                        </select>
                    </div>
                    <!-- /Sort By Time -->
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
                    <!-- Sorting Members and Ad collectors -->
                    <div class="input-group">
                        <select class="selectpicker" name="sort_by_advertisertype">
                            <option value="all">All</option>
                            <option value="members">Members' Ads</option>
                            <option value="ad_collecors">Ad Collectors' Ads</option>
                        </select>
                    </div>
                    <!-- /Sorting Members and Ad collectors -->
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}