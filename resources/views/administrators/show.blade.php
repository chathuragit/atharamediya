@extends('layouts.atharamediya')

@section('content')
    <section class="content-header">
        <h1>
            Administrators
            <small>View Administrator</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Users</a></li>
            <li class="active">Administrators</li>
        </ol>
        <hr/>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">View Administrator</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->

                    <div class="box-body">
                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label>Name</label>
                            <input type="text" class="form-control" placeholder="Enter Name" name="name" value="{{$User->name}}" required readonly>
                            @if ($errors->has('name'))
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('name') }}</label>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                            <label>Email address</label>
                            <input type="email" class="form-control" placeholder="Enter email" name="email" value="{{$User->email}}" required readonly>
                            @if ($errors->has('email'))
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('email') }}</label>
                            @endif
                        </div>

                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <a  href="{{url('/administrators')}}" class="btn btn-success pull-right">Close</a>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection