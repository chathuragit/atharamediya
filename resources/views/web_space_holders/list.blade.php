@extends('layouts.atharamediya')

@section('content')
    <section class="content-header">
        <h1>
            Web Space Holders
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Users</a></li>
            <li class="active">Web Space Holders</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                @include('includes.alert')

                <div class="box box-primary">
                    <div class="box-header">
                        <a type="button" href="{{url('/web_space_holders/create')}}" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Web Space Holder</a>

                        <div class="box-tools">
                            {!! Form::open(['url' => '/web_space_holders/filter', 'method' => 'GET']) !!}
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
                                <th width="10%">Actions</th>
                            </tr>
                            @if(count($web_space_holders) > 0)
                                @foreach($web_space_holders as $web_space_holder)
                                    <tr>
                                        <td>{{$web_space_holder->id}}</td>
                                        <td>{{$web_space_holder->name}}</td>
                                        <td>{{$web_space_holder->email}}</td>
                                        <td><input @if($web_space_holder->is_active) checked @endif data-toggle="toggle" data-style="ios" data-size="mini" type="checkbox" class="toggle-event" data-id="{{$web_space_holder->id}}"></td>
                                        <td>
                                            @if(Auth::user()->id != $web_space_holder->id)
                                                <a href="{{url('/web_space_holders')}}/{{$web_space_holder->id}}/" title="view details" class="actions"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                <a href="{{url('/web_space_holders')}}/{{$web_space_holder->id}}/edit" title="edit details" class="actions"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                <a href="#" data-toggle="modal" data-method="delete" class="trash actions" data-id="{{$web_space_holder->id}}" data-target="#modalDelete" title="delete"><i class="fa fa-trash"></i></a>
                                                <a href="{{url('web_space_holders/change_password')}}/{{$web_space_holder->id}}" class="user_change_password_btn actions" title="Change Password"><i class="fa fa-chain-broken" aria-hidden="true"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr><td colspan="5">No Records Found!</td></tr>
                            @endif

                        </table>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer clearfix">
                        {{ $web_space_holders->links() }}
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>

    @include('includes.deleteModal')
@endsection