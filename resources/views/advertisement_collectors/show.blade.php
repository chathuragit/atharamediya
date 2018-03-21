@extends('layouts.atharamediya')

@section('content')
    <section class="content-header">
        <h1>
            Advertisement Collectors
            <small>View Advertisement Collector</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Users</a></li>
            <li class="active">Advertisement Collectors</li>
        </ol>
        <hr/>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">View Advertisement Collector</h3>
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

                        <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                            <label>Title</label>
                            <input type="text" class="form-control" placeholder="Enter Title" name="title" value="{{($Member->title)}}" readonly>
                            @if ($errors->has('title'))
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('title') }}</label>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('moto') ? ' has-error' : '' }}">
                            <label>Moto</label>
                            <input type="text" class="form-control" placeholder="Enter Moto" name="moto" value="{{$Member->moto}}" readonly>
                            @if ($errors->has('moto'))
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('moto') }}</label>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                            <label>Description</label>
                            <textarea class="form-control" name="description" readonly>{{$Member->description}}</textarea>
                            @if ($errors->has('description'))
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('description') }}</label>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
                            <label>Address</label>
                            <textarea class="form-control" name="address" readonly>{{$Member->address}}</textarea>
                            @if ($errors->has('address'))
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('address') }}</label>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('contact_email') ? ' has-error' : '' }}">
                            <label for="contact_email">Contact email:</label>
                            <input id="contact_email" type="text" class="form-control" name="contact_email" value="{{$Member->contact_email}}" readonly>

                            @if ($errors->has('contact_email'))
                                <span class="help-block">
                                                    <strong>{{ $errors->first('contact_email') }}</strong>
                                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('contact_number') ? ' has-error' : '' }}">
                            <label for="contact_number">Contact Number:</label>
                            <input id="contact_number" type="text" class="form-control" name="contact_number" value="{{$Member->contact_number}}" readonly>

                            @if ($errors->has('contact_number'))
                                <span class="help-block">
                                                        <strong>{{ $errors->first('contact_number') }}</strong>
                                                    </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('corporate_color_forground') ? ' has-error' : '' }}">
                            <label for="corporate_color_forground">Corporate Color Forgroundr:</label>
                            <input id="corporate_color_forground" type="text" class="form-control" name="corporate_color_forground" readonly value="{{$Member->corporate_color_forground}}" >

                            @if ($errors->has('corporate_color_forground'))
                                <span class="help-block">
                                                        <strong>{{ $errors->first('corporate_color_forground') }}</strong>
                                                    </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('corporate_color_background') ? ' has-error' : '' }}">
                            <label for="corporate_color_background">Corporate Color Background:</label>
                            <input id="corporate_color_background" type="text" class="form-control" name="corporate_color_background" readonly value="{{$Member->corporate_color_background}}" >

                            @if ($errors->has('corporate_color_background'))
                                <span class="help-block">
                                                        <strong>{{ $errors->first('corporate_color_background') }}</strong>
                                                    </span>
                            @endif
                        </div>

                        <hr/>

                        <div class="form-group{{ $errors->has('images') ? ' has-error' : '' }}">
                            <label>Profile Image</label>


                            @if($Member->logo != null)
                                <div class="col-md-2">
                                    <img width="100%" src="{{url('/').'/uploads/'.$Member->logo}}">
                                </div>
                                <div class="clearfix"></div>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('images') ? ' has-error' : '' }}">
                            <label>Cover Image</label>


                            @if($Member->cover_image != null)
                                <div class="col-md-2">
                                    <img width="100%" src="{{url('/').'/uploads/'.$Member->cover_image}}">
                                </div>
                                <div class="clearfix"></div>
                            @endif
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <a  href="{{url('/advertisement_collectors')}}" class="btn btn-success pull-right">Close</a>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection