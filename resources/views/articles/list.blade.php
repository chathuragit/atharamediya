@extends('layouts.atharamediya')

@section('content')
    <section class="content-header">
        <h1>
            Articles
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Articles</a></li>
            <li class="active">Articles</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                @include('includes.alert')

                <div class="box box-primary">
                    <div class="box-header">
                        <a type="button" href="{{url('/articles/create')}}" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Article</a>

                        <div class="box-tools">
                            {!! Form::open(['url' => '/articles/filter', 'method' => 'GET']) !!}
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
                                <th>Status</th>
                                <th width="10%">Actions</th>
                            </tr>
                            @if(count($articles) > 0)
                                @foreach($articles as $article)
                                    <tr>
                                        <td>{{$article->id}}</td>
                                        <td>{{$article->title}}</td>
                                        <td><input @if($article->is_active) checked @endif data-toggle="toggle" data-style="ios" data-size="mini" type="checkbox" class="toggle-event" data-id="{{$article->id}}"></td>
                                        <td>
                                            <a href="{{url('/articles')}}/{{$article->id}}/" title="view details" class="actions"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                            <a href="{{url('/articles')}}/{{$article->id}}/edit" title="edit details" class="actions"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                            <a href="#" data-toggle="modal" data-method="delete" class="trash actions" data-id="{{$article->id}}" data-target="#modalDelete" title="delete"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr><td colspan="4">No Records Found!</td></tr>
                            @endif

                        </table>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer clearfix">
                        {{ $articles->links() }}
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>

    @include('includes.deleteModal')
@endsection