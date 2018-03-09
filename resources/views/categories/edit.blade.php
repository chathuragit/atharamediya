@extends('layouts.atharamediya')

@section('page_CSS')
    <link rel="stylesheet" href="{{ asset('plugins/iCheck/all.css')}}">
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Categories
            <small>Edit Category</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Categories</a></li>
            <li class="active">Categories</li>
        </ol>
        <hr/>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Category</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    {{ Form::model($Category, array('route' => array('categories.update', $Category->id), 'method' => 'PUT')) }}
                    <div class="box-body">
                        <div class="form-group {{ $errors->has('category_name') ? ' has-error' : '' }}">
                            <label>Category Name</label>
                            <input type="text" class="form-control" placeholder="Enter Category Name" name="category_name" value="{{$Category->category_name}}" required>
                            @if ($errors->has('category_name'))
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('category_name') }}</label>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('category_icon') ? ' has-error' : '' }}">
                            <label>Category Icon</label>
                            <input type="text" class="form-control" placeholder="Enter Category Icon" name="category_icon" value="{{$Category->fontawesome}}" required>
                            @if ($errors->has('category_icon'))
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('category_icon') }}</label>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('parent_category') ? ' has-error' : '' }}">
                            <label>Select Parent Category</label>
                            <select class="form-control" name="parent_category">
                                <option value="0">Select Parent Category</option>
                                @if(count($categories) > 0)
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}" {{ ($Category->parent_category_id == $category->id) ? 'selected' : '' }}>{{$category->category_name}}</option>
                                    @endforeach
                                @endif
                            </select>

                            @if ($errors->has('parent_category'))
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('parent_category') }}</label>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('default_attribute') ? ' has-error' : '' }}">
                            <label>Select Default Attribute</label>
                            <select class="form-control" name="default_attribute" required>
                                <option value="0">Select Default Attribute</option>
                                @if(count($attributes) > 0)
                                    @foreach($attributes as $attribute)
                                        <option value="{{$attribute->id}}" {{ ((count($default_attribute) > 0) && ($default_attribute->attribute_id == $attribute->id)) ? 'selected' : '' }}>{{$attribute->attribute_name}}</option>
                                    @endforeach
                                @endif
                            </select>

                            @if ($errors->has('default_attribute'))
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('default_attribute') }}</label>
                            @endif
                        </div>
                        <hr/>
                        @if(count($attributes) > 0)
                            @foreach($attributes as $attribute)
                                <div class="form-group">
                                    <label>
                                        <input type="checkbox" class="minimal" name="category_attributes[]" value="{{$attribute->id}}" {{ (count($Category->CategoryAttributeByID($Category->id, $attribute->id)) > 0) ? 'checked' : '' }}>
                                        {{$attribute->attribute_name}}
                                    </label>
                                </div>
                            @endforeach
                        @endif
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