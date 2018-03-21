@extends('layouts.atharamediya')

@section('content')
    <section class="content-header">
        <h1>
            Advertising Members
            <small>Create Advertising Member</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Users</a></li>
            <li class="active">Advertising Members</li>
        </ol>
        <hr/>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Create Advertising Member</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    {!! Form::open(['url' => 'advertising_members/', 'method' => 'POST', 'files'=>true]) !!}
                    <div class="box-body">
                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label>Name</label>
                            <input type="text" class="form-control" placeholder="Enter Name" name="name" value="{{old('name')}}" required>
                            @if ($errors->has('name'))
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('name') }}</label>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                            <label>Email address</label>
                            <input type="email" class="form-control" placeholder="Enter email" name="email" value="{{old('email')}}" required>
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

                        <hr/>

                        <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                            <label>Title</label>
                            <input type="text" class="form-control" placeholder="Enter Title" name="title" value="{{old('title')}}" required>
                            @if ($errors->has('title'))
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('title') }}</label>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('moto') ? ' has-error' : '' }}">
                            <label>Moto</label>
                            <input type="text" class="form-control" placeholder="Enter Moto" name="moto" value="{{old('moto')}}">
                            @if ($errors->has('moto'))
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('moto') }}</label>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                            <label>Description</label>
                            <textarea class="form-control" name="description" >{{old('description')}}</textarea>
                            @if ($errors->has('description'))
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('description') }}</label>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
                            <label>Address</label>
                            <textarea class="form-control" name="address" >{{old('address')}}</textarea>
                            @if ($errors->has('address'))
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('address') }}</label>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('contact_email') ? ' has-error' : '' }}">
                            <label for="contact_email">Contact email:</label>
                            <input id="contact_email" type="text" class="form-control" name="contact_email" value="{{old('contact_email')}}" >

                            @if ($errors->has('contact_email'))
                                <span class="help-block">
                                                    <strong>{{ $errors->first('contact_email') }}</strong>
                                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('contact_number') ? ' has-error' : '' }}">
                            <label for="contact_number">Contact Number:</label>
                            <input id="contact_number" type="text" class="form-control" name="contact_number" value="{{old('contact_number')}}" >

                            @if ($errors->has('contact_number'))
                                <span class="help-block">
                                                        <strong>{{ $errors->first('contact_number') }}</strong>
                                                    </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('corporate_color_forground') ? ' has-error' : '' }}">
                            <label for="corporate_color_forground">Corporate Color Forgroundr:</label>
                            <input id="corporate_color_forground" type="text" class="form-control" name="corporate_color_forground" value="{{old('corporate_color_forground')}}" >

                            @if ($errors->has('corporate_color_forground'))
                                <span class="help-block">
                                                        <strong>{{ $errors->first('corporate_color_forground') }}</strong>
                                                    </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('corporate_color_background') ? ' has-error' : '' }}">
                            <label for="corporate_color_background">Corporate Color Background:</label>
                            <input id="corporate_color_background" type="text" class="form-control" name="corporate_color_background" value="{{old('corporate_color_background')}}" >

                            @if ($errors->has('corporate_color_background'))
                                <span class="help-block">
                                                        <strong>{{ $errors->first('corporate_color_background') }}</strong>
                                                    </span>
                            @endif
                        </div>

                        <hr/>

                        <div class="form-group{{ $errors->has('images') ? ' has-error' : '' }}">
                            <label>Profile Image</label>

                            <div class="input-group">
                                <label class="input-group-btn">
                                        <span class="btn btn-primary btn-browse">
                                            Browse&hellip;
                                            <input type="file" accept="image/*" name="images[]" style="display: none;">
                                            <input type="hidden" name="image_names[]" value="profile_image"/>
                                        </span>
                                </label>
                                <input type="text" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('images') ? ' has-error' : '' }}">
                            <label>Cover Image</label>

                            <div class="input-group">
                                <label class="input-group-btn">
                                        <span class="btn btn-primary btn-browse">
                                            Browse&hellip;
                                            <input type="file" accept="image/*" name="images[]" style="display: none;">
                                            <input type="hidden" name="image_names[]" value="cover_image"/>
                                        </span>
                                </label>
                                <input type="text" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <a  href="{{url('/advertising_members')}}" class="btn btn-default pull-left">Close</a>
                        <button type="submit" class="btn btn-success pull-right">Create</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>
@endsection