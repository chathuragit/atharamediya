@extends('layouts.atharamediya')

@section('content')
    <section class="content-header">
        <h1>
            Attributes
            <small>Create Attribute</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Categories</a></li>
            <li class="active">Attributes</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Create Attribute</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    {!! Form::open(['url' => 'attributes/', 'method' => 'POST']) !!}
                    <div class="box-body">
                        <div class="form-group {{ $errors->has('attribute_name') ? ' has-error' : '' }}">
                            <label>Attribute Name</label>
                            <input type="text" class="form-control" placeholder="Enter Attribute Name" name="attribute_name" value="{{old('attribute_name')}}" required>
                            @if ($errors->has('attribute_name'))
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('attribute_name') }}</label>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('attribute_values') ? ' has-error' : '' }}">
                            <label>Attribute Values <small>(use | for seperate multiple values)</small></label>
                            <input type="text" class="form-control" placeholder="Enter Attribute Values" name="attribute_values" value="{{old('attribute_values')}}">
                            @if ($errors->has('attribute_values'))
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('attribute_values') }}</label>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('attribute_type') ? ' has-error' : '' }}">
                            <label>Attribute Type</label>
                            <select class="form-control" name="attribute_type" required>
                                <option value="1">Text</option>
                                <option value="2">Text Area</option>
                                <option value="3">Select List</option>
                                <option value="4">Radio List</option>
                                <option value="5">Checkbox List</option>
                            </select>

                            @if ($errors->has('attribute_type'))
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('attribute_type') }}</label>
                            @endif
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <a  href="{{url('/attributes')}}" class="btn btn-default pull-left">Close</a>
                        <button type="submit" class="btn btn-success pull-right">Create</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>
@endsection