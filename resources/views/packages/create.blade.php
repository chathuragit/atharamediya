@extends('layouts.atharamediya')

@section('content')
    <section class="content-header">
        <h1>
            Packages
            <small>Create Package</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Packages</a></li>
            <li class="active">Packages</li>
        </ol>
        <hr/>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Create Package</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    {!! Form::open(['url' => 'packages/', 'method' => 'POST']) !!}
                    <div class="box-body">
                        <div class="form-group {{ $errors->has('package_name') ? ' has-error' : '' }}">
                            <label>Package Name</label>
                            <input type="text" class="form-control" placeholder="Enter Package Name" name="package_name" value="{{old('package_name')}}" required>
                            @if ($errors->has('package_name'))
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('package_name') }}</label>
                            @endif
                        </div>

                    </div>


                    <div class="box-body">
                        <div class="form-group {{ $errors->has('package_period') ? ' has-error' : '' }}">
                            <label>Package Period (Days)</label>
                            <input type="text" class="form-control" placeholder="Enter Package Period" name="package_period" value="{{old('package_period')}}" required>
                            @if ($errors->has('package_period'))
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('package_period') }}</label>
                            @endif
                        </div>

                    </div>


                    <div class="box-body">
                        <div class="form-group {{ $errors->has('package_price') ? ' has-error' : '' }}">
                            <label>Package Price</label>
                            <input type="text" class="form-control" placeholder="Enter Package Price" name="package_price" value="{{old('package_price')}}" required>
                            @if ($errors->has('package_price'))
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('package_price') }}</label>
                            @endif
                        </div>

                    </div>


                    <div class="box-body">
                        <div class="form-group {{ $errors->has('package_advertisments') ? ' has-error' : '' }}">
                            <label>Package Advertisments</label>
                            <input type="text" class="form-control" placeholder="Enter Package No of Advertisments" name="package_advertisments" value="{{old('package_advertisments')}}" required>
                            @if ($errors->has('package_advertisments'))
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('package_advertisments') }}</label>
                            @endif
                        </div>

                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <a  href="{{url('/packages')}}" class="btn btn-default pull-left">Close</a>
                        <button type="submit" class="btn btn-success pull-right">Create</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>
@endsection