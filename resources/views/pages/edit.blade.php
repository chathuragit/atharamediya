@extends('layouts.atharamediya')

@section('page_CSS')
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Pages
            <small>Edit Page</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Pages</a></li>
            <li class="active">Pages</li>
        </ol>
        <hr/>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Pages</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    {!! Form::open(['url' => 'pages/'.$page->id.'/update/', 'method' => 'POST', 'files'=>true]) !!}
                    <div class="box-body">
                        <div class="form-group {{ $errors->has('page') ? ' has-error' : '' }}">
                            <label>Page Name</label>
                            <input type="text" class="form-control" placeholder="Enter Page Name" name="page" value="{{$page->page}}" required readonly>
                            @if ($errors->has('page'))
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('page') }}</label>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('page_title') ? ' has-error' : '' }}">
                            <label>Page Title</label>
                            <input type="text" class="form-control" placeholder="Enter Page Title" name="page_title" value="{{$page->page_title}}">
                            @if ($errors->has('page_title'))
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('page_title') }}</label>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('page_meta_data') ? ' has-error' : '' }}">
                            <label>Page Meta Data</label>
                            <input type="text" class="form-control" placeholder="Enter Page Meta" name="page_meta_data" value="{{$page->page_meta_data}}">
                            @if ($errors->has('page_meta_data'))
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('page_meta_data') }}</label>
                            @endif
                        </div>

                        <hr/>
                        <div class="form-group{{ $errors->has('images') ? ' has-error' : '' }}">
                            <label>Images *</label>

                            <div class="input-group">
                                <label class="input-group-btn">
                                        <span class="btn btn-primary btn-browse">
                                            Browse&hellip;
                                            <input type="file" accept="image/*" name="images" style="display: none;" >
                                        </span>
                                </label>
                                <input type="text" class="form-control" readonly>
                            </div>

                            @if (($page->cover_image != null) && (file_exists(public_path() . '/uploads/' . $page->cover_image)))
                                <br><br>

                                <div id="sc_{{$page->id}}" class="col-lg-12 screenChotHolder">
                                    <img width="100%" src="{{url('/').'/uploads/'.$page->cover_image}}">
                                </div>
                            @endif


                            <div class="clearfix"></div>
                        </div>

                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <a  href="{{url('/categories')}}" class="btn btn-default pull-left">Close</a>
                        <button type="submit" class="btn btn-success pull-right">Update</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>
@endsection

@section('page_JS')
@endsection