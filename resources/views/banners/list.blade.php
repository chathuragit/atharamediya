@extends('layouts.atharamediya')

@section('content')
    <section class="content-header">
        <h1>
            Web Space Banners
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Web Space Banners</a></li>
            <li class="active">Web Space Banners</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                @include('includes.alert')

                <div class="box box-primary">
                    <div class="box-header">
                        <a type="button" href="{{url('/banners/create')}}" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Web Space Banner</a>

                        <div class="box-tools">
                            {!! Form::open(['url' => '/banners/filter', 'method' => 'GET']) !!}
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
                                <th>Title</th>
                                <th>Category</th>
                                @if(Auth::user()->role <= 2)
                                    <th>Active</th>
                                @endif
                                <th>Status</th>
                                <th width="10%">Actions</th>
                            </tr>
                            @if(count($advertisments) > 0)
                                @foreach($advertisments as $advertisment)
                                    <tr>
                                        <td>{{$advertisment->id}}</td>
                                        <td>{{$advertisment->title}}</td>
                                        <td>{{ ($advertisment->category_id != 0) ? $advertisment->assigned_category->category_name : 'All Categories' }}</td>
                                        @if(Auth::user()->role <= 2)
                                            <td><input @if($advertisment->is_active) checked @endif data-toggle="toggle" data-style="ios" data-size="mini" type="checkbox" class="toggle-event" data-id="{{$advertisment->id}}"></td>
                                        @endif
                                        <td>{{ ($advertisment->assigned_status != null) ? $advertisment->assigned_status->status : 'not-assigned' }}</td>
                                        <td>
                                            <a href="{{url('/banners')}}/{{$advertisment->id}}/" title="view details" class="actions"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                            <a href="{{url('/banners')}}/{{$advertisment->id}}/edit" title="edit details" class="actions"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                            <a href="#" data-toggle="modal" data-method="delete" class="trash actions" data-id="{{$advertisment->id}}" data-target="#modalDelete" title="delete"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr><td colspan="6">No Records Found!</td></tr>
                            @endif

                        </table>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer clearfix">
                        {{ $advertisments->links() }}
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>

    @include('includes.deleteModal')
@endsection