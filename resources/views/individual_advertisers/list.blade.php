@extends('layouts.atharamediya')

@section('content')
    <section class="content-header">
        <h1>
            Individual Advertisers
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Users</a></li>
            <li class="active">Individual Advertisers</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                @include('includes.alert')

                <div class="box box-primary">
                    <div class="box-header">
                        <a type="button" style="visibility:hidden;" class="btn btn-sm btn-success"> &nbsp;</a>

                        <div class="box-tools">
                            {!! Form::open(['url' => '/individual_advertisers/filter', 'method' => 'GET']) !!}
                            <div class="input-group input-group-sm" style="width: 250px;">
                                <input type="text" name="search" class="form-control pull-right" placeholder="Search" value="{{ (isset($request) && !empty($request)) ? $request->search : '' }}">

                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                            </tr>
                            @if(count($individual_advertisers) > 0)
                                @foreach($individual_advertisers as $individual_advertiser)
                                    <tr>
                                        <td>{{$individual_advertiser->id}}</td>
                                        <td>{{$individual_advertiser->name}}</td>
                                        <td>{{$individual_advertiser->email}}</td>
                                        <td><input @if($individual_advertiser->is_active) checked @endif data-toggle="toggle" data-style="ios" data-size="mini" type="checkbox" class="toggle-event" data-id="{{$individual_advertiser->id}}"></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr><td colspan="5">No Records Found!</td></tr>
                            @endif

                        </table>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer clearfix">
                        {{ $individual_advertisers->links() }}
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>

    @include('includes.deleteModal')
@endsection