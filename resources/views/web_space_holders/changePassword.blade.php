@extends('layouts.atharamediya')

@section('content')
    <section class="content-header">
        <h1>
            Web Space Holders
            <small>Change Web Space Holder Password</small>
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
                        <h3 class="box-title"><strong>Change Web Space Holder User's Password <small>({{$User->name}})</small></strong></h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    {!! Form::open(['url' => 'web_space_holders/change_password/', 'method' => 'POST']) !!}
                    <div class="box-body">
                        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                            <input name="user_id" value="{{$User->id}}" type="hidden">
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
                        <a  href="{{url('/web_space_holders')}}" class="btn btn-default pull-left">Close</a>
                        <button type="submit" class="btn btn-success pull-right">Change Password</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>
@endsection
