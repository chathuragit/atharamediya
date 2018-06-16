@extends('layouts.atharamediya')

@section('content')
    <section class="content-header">
        <h1>
            Web Space Banners
            <small>Create Web Space Banner</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Web Space Banners</a></li>
            <li class="active">Web Space Banners</li>
        </ol>
        <hr/>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Create Web Space Banner</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    {!! Form::open(['url' => 'banners/', 'method' => 'POST', 'files'=>true]) !!}
                    <div class="box-body">
                        <div class="form-group {{ $errors->has('advertisment_title') ? ' has-error' : '' }}">
                            <label>Banner Advertisment Title</label>
                            <input type="text" class="form-control" placeholder="Enter Banner Advertisment Title" name="advertisment_title" value="{{old('advertisment_title')}}" required>
                            @if ($errors->has('advertisment_title'))
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('advertisment_title') }}</label>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('category') ? ' has-error' : '' }}">
                            <label>Select Category</label>
                            <select class="form-control" name="category" required>
                                <option value="0">All Categories</option>
                                @if(count($categories) > 0)
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->category_name}}</option>
                                    @endforeach
                                @endif
                            </select>

                            @if ($errors->has('category'))
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('category') }}</label>
                            @endif
                        </div>



                        <div class="form-group {{ $errors->has('link_url') ? ' has-error' : '' }}">
                            <label>Link Url</label>
                            <input type="text" class="form-control" placeholder="Enter Url" name="link_url" value="{{old('link_url')}}">
                            @if ($errors->has('link_url'))
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('link_url') }}</label>
                            @endif
                        </div>


                        <div class="form-group {{ $errors->has('display_period') ? ' has-error' : '' }}">
                            <label>Display Period <small>(Days)</small></label>
                            <input type="text" class="form-control datepickerAtharamediya" placeholder="Enter Display Period" name="display_period" value="{{old('display_period')}}" required>
                            @if ($errors->has('display_period'))
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('display_period') }}</label>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('display_position') ? ' has-error' : '' }}">
                            <label>Display Position</label>
                            <select class="form-control" name="display_position" required>
                                <option value="0">Select Position</option>
                                <option value="1">Left Side Bar</option>
                                <option value="2">Right Side Bar</option>
                                <option value="3">Advertisment Listing Area</option>
                            </select>

                            @if ($errors->has('display_position'))
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('display_position') }}</label>
                            @endif
                        </div>


                        <hr/>

                        <div class="form-group{{ $errors->has('banner_image') ? ' has-error' : '' }}">
                            <label>Banner Image</label>

                            <div class="input-group" style="z-index: 1 !important;">
                                <label class="input-group-btn">
                                        <span class="btn btn-primary btn-browse">
                                            Browse&hellip;
                                            <input type="file" accept="image/*" name="banner_image" style="display: none;">
                                        </span>
                                </label>
                                <input type="text" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <a  href="{{url('/banners')}}" class="btn btn-default pull-left">Close</a>
                        <button type="submit" class="btn btn-success pull-right">Create</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>
@endsection


