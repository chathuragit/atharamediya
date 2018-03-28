@extends('layouts.atharamediya')

@section('page_CSS')
    <link rel="stylesheet" href="{{ asset('plugins/iCheck/all.css')}}">
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Articles
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Articles</a></li>
            <li class="active">Articles</li>
        </ol>
        <hr/>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">View Article</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->

                    <div class="box-body">
                        <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                            <label>Title</label>
                            <input type="text" class="form-control" placeholder="Enter Title" name="title" value="{{$Article->title}}" readonly>
                            @if ($errors->has('title'))
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('title') }}</label>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('display_in') ? ' has-error' : '' }}">
                            <label>Show In</label>
                            <select class="form-control" name="display_in" readonly="readonly">
                                <option value="0">Select Parent Category</option>
                                <option value="1" {{ ($Article->show_in == 1) ? 'selected' : ''}}>Main Content Area</option>
                                <option value="2" {{ ($Article->show_in == 2) ? 'selected' : ''}}>Left Side Content Area</option>
                                <option value="3" {{ ($Article->show_in == 3) ? 'selected' : ''}}>Right Side Content Area</option>
                            </select>

                            @if ($errors->has('display_in'))
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('display_in') }}</label>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                            <label>Description</label>
                            <textarea name="description" class="form-control" readonly>{{$Article->desc}}</textarea>
                            @if ($errors->has('description'))
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('description') }}</label>
                            @endif
                        </div>

                        <hr/>
                        @if(count($pages) > 0)
                            @foreach($pages as $page)
                                <div class="form-group">
                                    <label>
                                        <input type="checkbox" readonly class="minimal" name="pages[]" {{ (is_array($SelectedPages) && (in_array($page->id, $SelectedPages))) ? 'checked' : '' }} value="{{$page->id}}">
                                        {{$page->page}}
                                    </label>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <a  href="{{url('/articles')}}" class="btn btn-default pull-right">Close</a>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection


@section('page_JS')
    <script src="{{ asset('plugins/iCheck/icheck.min.js')}}"></script>
    <script>
        $(function () {
            $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass   : 'iradio_minimal-blue'
            })
            //Red color scheme for iCheck
            $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
                checkboxClass: 'icheckbox_minimal-red',
                radioClass   : 'iradio_minimal-red'
            })
            //Flat red color scheme for iCheck
            $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass   : 'iradio_flat-green'
            })
        });
    </script>
@endsection