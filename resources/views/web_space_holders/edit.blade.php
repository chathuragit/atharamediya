@extends('layouts.atharamediya')

@section('content')
    <section class="content-header">
        <h1>
            Web Space Holders
            <small>Edit Web Space Holder</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Users</a></li>
            <li class="active">Web Space Holders</li>
        </ol>
        <hr/>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Web Space Holder</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    {{ Form::model($User, array('route' => array('web_space_holders.update', $User->id), 'method' => 'PUT')) }}
                    <div class="box-body">
                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label>Name</label>
                            <input type="text" class="form-control" placeholder="Enter Name" name="name" value="{{$User->name}}" required>
                            @if ($errors->has('name'))
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('name') }}</label>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                            <label>Email address</label>
                            <input type="email" class="form-control" placeholder="Enter email" name="email" value="{{$User->email}}" required>
                            @if ($errors->has('email'))
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('email') }}</label>
                            @endif
                        </div>

                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <a  href="{{url('/web_space_holders')}}" class="btn btn-default pull-left">Close</a>
                        <button type="submit" class="btn btn-success pull-right">Update</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>
@endsection