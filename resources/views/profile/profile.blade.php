@extends('layouts.atharamediya')

@section('content')
    <section class="content-header">
        <h1>
            Profile
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Profile</a></li>
        </ol>
    </section>

    <section class="content">
        <div class="row">

            <div class="col-xs-12">
                @include('includes.alert')
            </div>

            <div class="col-xs-6 col-xs-offset-3">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><strong>Update Profile Details & Credentials <br><small>({{$User->name}})</small></strong></h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    {!! Form::open(['url' => 'profile/change_credentials/', 'method' => 'POST']) !!}
                    <div class="box-body">
                        <input name="user_id" value="{{$User->id}}" type="hidden">
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

                        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                            <label>Password</label>
                            <input type="password" class="form-control" placeholder="Password" name="password" value="{{old('password')}}" required>

                            @if ($errors->has('password'))
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('password') }}</label>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label>Confirm Password</label>
                            <input type="password" class="form-control" placeholder="Password" name="password_confirmation" required>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        @if(Auth::user()->user_role == 3)
                            <a  href="{{url('/profile')}}" class="btn btn-default pull-left">Close</a>
                        @endif
                        <button type="submit" class="btn btn-success pull-right">Update</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>
@endsection
