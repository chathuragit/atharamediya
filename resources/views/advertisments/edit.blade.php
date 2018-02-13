@extends('layouts.atharamediya')

@section('page_CSS')
    <link rel="stylesheet" href="{{ asset('plugins/iCheck/all.css')}}">
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Advertisments
            <small>Edit Advertisment</small>
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
                        <h3 class="box-title">Edit Advertisment</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    {{ Form::model($Advertisment, array('route' => array('advertisments.update', $Advertisment->id), 'method' => 'PUT', 'files'=>true)) }}
                    <div class="box-body">
                        <div class="form-group {{ $errors->has('advertisment_title') ? ' has-error' : '' }}">
                            <label>Advertisment Title</label>
                            <input type="text" class="form-control" placeholder="Enter Advertisment Title" name="advertisment_title" value="{{$Advertisment->title}}" required>
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
                                        <option value="{{$category->id}}" {{ ($Advertisment->category_id == $category->id) ? 'selected' : '' }}>{{$category->category_name}}</option>
                                    @endforeach
                                @endif
                            </select>

                            @if ($errors->has('category'))
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('category') }}</label>
                            @endif
                        </div>


                        <div class="form-group {{ $errors->has('advertisment_desc') ? ' has-error' : '' }}">
                            <label>Advertisment Description</label>
                            <textarea class="form-control" name="advertisment_desc" required>{{$Advertisment->description}}</textarea>
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
                                        <option value="{{$district->id}}" {{ ($Advertisment->location_id == $district->id) ? 'selected' : '' }}>{{$district->district}}</option>
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
                            <input type="text" class="form-control" placeholder="Enter Price" name="price" value="{{$Advertisment->price}}" required>
                            @if ($errors->has('price'))
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('price') }}</label>
                            @endif
                        </div>

                        <div class="attributes_wrapper">
                            @if(count($Advertisment->advertisment_attributes) > 0)
                                @foreach($Advertisment->advertisment_attributes as $attribute)
                                    <div class="form-group">
                                        @php $Attribute = $Advertisment->advertisment_attribute_byid($attribute->attribute_id); @endphp
                                        <label>{{ $Attribute->attribute_name }}</label>

                                        @if($Attribute->attribute_type == 1)
                                            <input type="text"  class="form-control"  value="{{$attribute->attribute_value}}" name="advertisment_attribute[{{$Attribute->id}}]"/>
                                        @endif

                                        @if($Attribute->attribute_type == 2)
                                            <textarea name="{{$Attribute->id}}" class="form-control">{{$attribute->attribute_value}}</textarea>
                                        @endif

                                        @if($Attribute->attribute_type == 3)
                                            @php $Values = explode('|', $Attribute->attribute_values) @endphp

                                            @if(count($Values) > 0)
                                                <select class="form-control" name="advertisment_attribute[{{$Attribute->id}}]">
                                                    <option>Select {{$Attribute->attribute_name}}</option>
                                                    @foreach($Values as $Value)
                                                        <option value="{{trim($Value)}}" {{ ($attribute->attribute_value == trim($Value)) ? 'selected' : '' }}>{{ trim($Value)}}</option>
                                                    @endforeach
                                                </select>
                                            @endif
                                        @endif

                                        @if($Attribute->attribute_type == 4)
                                            @php $Values = explode('|', $Attribute->attribute_values) @endphp

                                            @if(count($Values) > 0)
                                                @foreach($Values as $Value)
                                                    <div class="form-group">
                                                        <label>
                                                            <input type="radio" class="minimal" name="advertisment_attribute[{{$Attribute->id}}]" value="{{trim($Value)}}" {{ ($attribute->attribute_value == trim($Value)) ? 'checked' : '' }}>
                                                            {{trim($Value)}}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            @endif
                                        @endif

                                        @if($Attribute->attribute_type == 5)
                                            @php
                                                $Values = explode('|', $Attribute->attribute_values);
                                                $Checked = unserialize($attribute->attribute_value);
                                            @endphp

                                            @if(count($Values) > 0)
                                                @foreach($Values as $Value)
                                                    <div class="form-group">
                                                        <label>
                                                            <input type="checkbox" class="minimal" name="advertisment_attribute[{{$Attribute->id}}][]" value="{{trim($Value)}}" {{ (in_array(trim($Value), $Checked)) ? 'checked' : '' }}>
                                                            {{trim($Value)}}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            @endif
                                        @endif

                                    </div>
                                @endforeach
                            @endif
                        </div>

                        <hr/>

                        <div class="form-group">
                            <label>Negotiable Price :</label><br>
                            <input  type="radio" name="negotiable" id="negotiable_1" value="1" {{ ($Advertisment->is_negotiable == 1) ? 'checked="checked"' : '' }}>
                            <label for="negotiable_1">Yes</label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <input  type="radio" name="negotiable" id="negotiable_2" value="0" {{ ($Advertisment->is_negotiable == 0) ? 'checked="checked"' : '' }}>
                            <label for="negotiable_2">No</label>
                        </div>

                        <div class="form-group{{ $errors->has('contact_email') ? ' has-error' : '' }}">
                            <label for="contact_email">Contact email:</label>
                            <input id="contact_email" type="text" class="form-control" name="contact_email" value="{{$Advertisment->contact_email}}" >

                            @if ($errors->has('contact_email'))
                                <span class="help-block">
                                                    <strong>{{ $errors->first('contact_email') }}</strong>
                                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('contact_number') ? ' has-error' : '' }}">
                            <label for="contact_number">Contact Number:</label>
                            <input id="contact_number" type="text" class="form-control" name="contact_number" value="{{$Advertisment->contact_mobile}}" >

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

                            <br><br>

                            @foreach($Advertisment->advertisment_media as $key=>$Advertisement_image)
                                <div id="sc_{{$Advertisement_image->id}}" class="col-lg-2 screenChotHolder">
                                    <div class="closeBtn">
                                        <a data-id="{{$Advertisement_image->id}}" class="Cdanger" data-toggle="modal" role="button" href="#myModal"><i class="fa fa-trash-o"></i></a></div>
                                    <img width="100%" src="{{url('/').'/uploads/'.$Advertisement_image->data_url}}">
                                    <input type="hidden" value="{{$Advertisement_image->data_url}}" name="oldImages[]" class="oldImages">
                                    <input name="default_pic" value="{{$Advertisement_image->data_url}}" id="ad_{{$Advertisement_image->id}}" type="radio"  @if($Advertisement_image->default_pic == 1) checked="checked" @endif>
                                    <label for="ad_{{$Advertisement_image->id}}">Default</label>
                                </div>
                            @endforeach
                            <div class="clearfix"></div>
                        </div>

                        @if(Auth::user()->role <= 2)
                            <hr>
                            <div class="form-group {{ $errors->has('advertisment_status') ? ' has-error' : '' }}">
                                <label>Select Status</label>
                                <select class="form-control" name="advertisment_status" >
                                    @if(count($AdvertismentStatus) > 0)
                                        @foreach($AdvertismentStatus as $status)
                                            <option value="{{$status->id}}" {{ ($Advertisment->status == $status->id) ? 'selected' : '' }} {{ (in_array($status->id, [1,5])) ? 'disabled' : '' }}>{{$status->status}}</option>
                                        @endforeach
                                    @endif
                                </select>

                                @if ($errors->has('advertisment_status'))
                                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('advertisment_status') }}</label>
                                @endif
                            </div>
                        @endif

                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <a  href="{{url('/advertisments')}}" class="btn btn-default pull-left">Close</a>
                        <button type="submit" class="btn btn-success pull-right">Update</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>

    @include('includes.delete_confirmation')
@endsection


@section('page_JS')
    <script src="{{ asset('plugins/iCheck/icheck.min.js')}}"></script>
    <script>
        $(function () {
            $('.closeBtn .Cdanger').click(function(e){
                var id = $(this).attr('data-id');
                var filename = $(this).parents('.screenChotHolder').find('.oldImages').val();
                $('.proceed-delete').click(function(e){
                    $.ajax({
                        url : '/remove_advertisment_image',
                        type : 'GET',
                        data : {filename : filename, id : id},
                        success : function(data){
                            $('#sc_' + id).remove();

                            $('#myModal').modal('toggle');
                        }
                    });
                });
            });

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