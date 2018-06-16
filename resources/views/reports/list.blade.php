@extends('layouts.atharamediya')

@section('content')
    <section class="content-header">
        <h1>
            Reports
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Reports</a></li>
            <li class="active">Reports</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                @include('includes.alert')

                <div class="box box-primary">
                    <div class="box-header">
                        {!! Form::open(['url' => '/reports/filter', 'method' => 'GET']) !!}
                       <div class="col-md-4">
                           <select class="form-control" name="report_by" required>
                               <option value="0">Select Filter</option>
                               <option value="category" {{ (isset($request) && ($request->report_by == "category")) ? 'selected' : '' }}>Report By Category</option>
                               <option value="administrators" {{ (isset($request) && ($request->report_by == "administrators")) ? 'selected' : '' }}>Approved By Administrators</option>
                               <option value="usertype" {{ (isset($request) && ($request->report_by == "usertype")) ? 'selected' : '' }}>Users By User Type</option>
                               <option value="webspace" {{ (isset($request) && ($request->report_by == "webspace")) ? 'selected' : '' }}>Web Space Banners</option>
                           </select>
                       </div>

                        @if(isset($request) && ($request->report_by == "category"))
                        <div class="col-md-3">
                            <select class="form-control" name="user" required>
                                <option value="0">Select User</option>
                                @if(count($users) > 0)
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}" {{ (isset($request) && ($request->user == $user->id)) ? 'selected' : '' }}>{{$user->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        @endif

                        @if(isset($request) && ($request->report_by == "administrators"))
                            <div class="col-md-3">
                                <select class="form-control" name="category" required>
                                    <option value="0">Select Category</option>
                                    @if(count($categories) > 0)
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}" {{ (isset($request) && ($request->category == $category->id)) ? 'selected' : '' }}>{{$category->category_name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        @endif

                        @if(isset($request) && ($request->report_by == "webspace"))
                            <div class="col-md-3">
                                <select class="form-control" name="webspace" required>
                                    <option value="0">Select Administrator</option>
                                    @if(count($administrators) > 0)
                                        @foreach($administrators as $administrator)
                                            <option value="{{$administrator->id}}" {{ (isset($request) && ($request->webspace == $administrator->id)) ? 'selected' : '' }}>{{$administrator->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        @endif

                        <div class="col-md-3">
                            <select class="form-control" name="period" required>
                                <option value="0">Select Period</option>
                                <option value="Daily" {{ (isset($request) && ($request->period == "Daily")) ? 'selected' : '' }}>Daily</option>
                                <option value="Monthly" {{ (isset($request) && ($request->period == "Monthly")) ? 'selected' : '' }}>Monthly</option>
                                <option value="Annually" {{ (isset($request) && ($request->period == "Annually")) ? 'selected' : '' }}>Annually</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                        {!! Form::close() !!}

                    </div>
                    <!-- /.box-header -->
                    @if(isset($request) && ($request->report_by == "category"))
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Number Of Advertisments</th>
                            </tr>
                            @if(count($categories) > 0)
                                @foreach($categories as $category)
                                    <tr>
                                        <td>{{$category->id}}</td>
                                        <td>{{$category->category_name}}</td>
                                        <td>
                                            {{ $category->assigned_advertisments_for_category($category->id, $request->period, $request->user) }}
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr><td colspan="3">No Records Found!</td></tr>
                            @endif

                        </table>
                    </div>
                    @endif


                    @if(isset($request) && ($request->report_by == "administrators"))
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Number Of Advertisments</th>
                                </tr>
                                @if(count($administrators) > 0)
                                    @foreach($administrators as $administrator)
                                        <tr>
                                            <td>{{$administrator->id}}</td>
                                            <td>{{$administrator->name}}</td>
                                            <td>
                                                {{ $administrator->approved_advertisments_by_administrator($administrator->id, $request->period, $request->category) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr><td colspan="3">No Records Found!</td></tr>
                                @endif

                            </table>
                        </div>
                    @endif


                    @if(isset($request) && ($request->report_by == "usertype"))
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>User Type</th>
                                </tr>
                                @if(count($userTypes) > 0)
                                    @foreach($userTypes as $userType)
                                        <tr>
                                            <td>{{$userType->id}}</td>
                                            <td>{{$userType->role}}</td>
                                            <td>
                                                {{$userType->registered_users_for_role($userType->id, $request->period )}}
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr><td colspan="3">No Records Found!</td></tr>
                                @endif

                            </table>
                        </div>
                    @endif


                    @if(isset($request) && ($request->report_by == "webspace"))
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Number Of Advertisments</th>
                                </tr>
                                @if(count($webspaceusers) > 0)
                                    @foreach($webspaceusers as $webspaceuser)
                                        <tr>
                                            <td>{{$webspaceuser->id}}</td>
                                            <td>{{$webspaceuser->name}}</td>
                                            <td>
                                                {{$webspaceuser->assigned_web_space_banners($request->webspace, $request->period, $webspaceuser->id )}}
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr><td colspan="3">No Records Found!</td></tr>
                                @endif

                            </table>
                        </div>
                    @endif

                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>

    @include('includes.deleteModal')
@endsection