@extends('layouts.atharamediya')

@section('page_CSS')
    <link rel="stylesheet" href="{{ asset('plugins/iCheck/all.css')}}">
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Advertisments
            <small>Create Advertisment</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Advertisments</a></li>
            <li class="active">Advertisments</li>
        </ol>
        <hr/>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Create Advertisment</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    {!! Form::open(['url' => 'advertisments/', 'method' => 'POST', 'files'=>true]) !!}
                    <div class="box-body">
                        <div class="form-group {{ $errors->has('advertisment_title') ? ' has-error' : '' }}">
                            <label>Advertisment Title</label>
                            <input type="text" class="form-control" placeholder="Enter Advertisment Title" name="advertisment_title" value="{{old('advertisment_title')}}" required>
                            @if ($errors->has('advertisment_title'))
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('advertisment_title') }}</label>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('category') ? ' has-error' : '' }}">
                            <label>Select Category</label>
                            <select class="form-control" name="category" required>
                                <option value="0">Select Category</option>
                                @if(count($categories) > 0)
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->category_name}}</option>
                                    @endforeach
                                @endif
                            </select>

                            @if ($errors->has('category'))
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('category') }}</label>
                            @endif
                        </div>


                        <div class="form-group {{ $errors->has('advertisment_desc') ? ' has-error' : '' }}">
                            <label>Advertisment Description</label>
                            <textarea class="form-control" name="advertisment_desc" required>{{old('advertisment_desc')}}</textarea>
                            @if ($errors->has('advertisment_desc'))
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('advertisment_desc') }}</label>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('advertisment_location') ? ' has-error' : '' }}">
                            <label>Select District</label>
                            <select class="form-control" name="advertisment_location" required>
                                <option value="0">Select District</option>
                                @if(count($districts) > 0)
                                    @foreach($districts as $district)
                                        <option value="{{$district->id}}">{{$district->district}}</option>
                                    @endforeach
                                @endif
                            </select>

                            @if ($errors->has('advertisment_location'))
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('advertisment_location') }}</label>
                            @endif
                        </div>


                        {{--<div class="form-group {{ $errors->has('location') ? ' has-error' : '' }}">
                            <label>Location</label>
                            <input type="text" class="form-control" placeholder="Enter location" name="location" value="{{old('location')}}" required>
                            @if ($errors->has('location'))
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('location') }}</label>
                            @endif
                        </div>--}}

                        <div class="form-group {{ $errors->has('price') ? ' has-error' : '' }}">
                            <label>Price</label>
                            <input type="text" class="form-control" placeholder="Enter Price" name="price" value="{{old('price')}}" required>
                            @if ($errors->has('price'))
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('price') }}</label>
                            @endif
                        </div>

                        <div class="attributes_wrapper"></div>

                        <hr/>

                        <div class="form-group">
                            <label>Negotiable Price :</label><br>
                            <input  type="radio" name="negotiable" id="negotiable_1" value="1" checked="checked">
                            <label for="negotiable_1">Yes</label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <input  type="radio" name="negotiable" id="negotiable_2" value="0">
                            <label for="negotiable_2">No</label>
                        </div>

                        <div class="form-group{{ $errors->has('contact_email') ? ' has-error' : '' }}">
                            <label for="contact_email">Contact email:</label>
                            <input id="contact_email" type="text" class="form-control" name="contact_email" value="{{ (!is_null($profile)) ? $profile->contact_email : '' }}" >

                            @if ($errors->has('contact_email'))
                                <span class="help-block">
                                                    <strong>{{ $errors->first('contact_email') }}</strong>
                                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('contact_number') ? ' has-error' : '' }}">
                            <label for="contact_number">Contact Number:</label>
                            <input id="contact_number" type="text" class="form-control" name="contact_number" value="{{ (!is_null($profile)) ? $profile->contact_number : '' }}" >

                            @if ($errors->has('contact_number'))
                                <span class="help-block">
                                                        <strong>{{ $errors->first('contact_number') }}</strong>
                                                    </span>
                            @endif
                        </div>

                        <hr/>

                        <div class="form-group{{ $errors->has('images') ? ' has-error' : '' }}">
                            <label>Images *</label>

                            <div class="input-group">
                                <label class="input-group-btn">
                                        <span class="btn btn-primary btn-browse">
                                            Browse&hellip;
                                            <input type="file" accept="image/*" name="images[]" style="display: none;" multiple="multiple">
                                        </span>
                                </label>
                                <input type="text" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <a  href="{{url('/advertisments')}}" class="btn btn-default pull-left">Close</a>
                        <button type="submit" class="btn btn-success pull-right">Create</button>
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

            $('select[name=category]').on('change', function() {
                var category = this.value;

                $.ajax({
                    url : "/advertisments/advertisment_attributes",
                    type: 'POST',
                    data : { category : category, '_token': $('meta[name="csrf-token"]').attr('content')},
                    success: function(data)
                    {
                        $('.attributes_wrapper').html(data);
                    },
                    beforeSend : function(){
                    }
                });
            })
        });
    </script>
@endsection