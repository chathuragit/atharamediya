@extends('layouts.login')

@section('page_header')
    <header>
        <div class="container-flid full-banner">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h1 class="text-center seo">විකුණන්නයි බඩු ගන්නයි අතරමැදියා ලඟටයි එන්නේ ...</h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
@endsection

@include('includes.header')

@section('content')
    <div class="login-logo">
        <a title="Atharamediya"><img src="{{ asset('images/logo-atharamediya.png')}}" alt="Athramediya" class="img-fluid home-logo"></a>
    </div>

<div class="container">
    <div class="row boxer">
        <div class="col-lg-4"></div>
        <div class="col-lg-4 top">
            <p class="text-center login-box-msg">Sign Up to start advertising</p>
        </div>
        <div class="col-lg-4"></div>
        <div class="col-lg-12 bottom" >
            <div class="login-box">
                <div class="login-box-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="control-label">Name</label>

                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                            @if ($errors->has('name'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif

                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="control-label">E-Mail Address</label>


                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif

                        </div>

                        <div class="form-group{{ $errors->has('contact_number') ? ' has-error' : '' }}">
                            <label for="contact_number" class="control-label">Contact Number</label>


                            <input id="contact_number" type="text" class="form-control" name="contact_number" value="{{ old('contact_number') }}" required>

                            @if ($errors->has('contact_number'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('contact_number') }}</strong>
                                    </span>
                            @endif

                        </div>


                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="control-label">Password</label>


                            <input id="password" type="password" class="form-control" name="password" required>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif

                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="control-label">Confirm Password</label>


                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                        </div>

                        <div class="form-group {{ $errors->has('member_type') ? ' has-error' : '' }}">
                            <label for="member_type" class="control-label">Confirm Password</label>


                            <select class="form-control" id="userselector" name="member_type" required>
                                <option value="6" {{ (old('member_type') == 6) ? 'selected' : ''}}>Individual Advertiser</option>
                                <option value="4" {{ (old('member_type') == 4) ? 'selected' : ''}}>Advertising Member</option>
                                <option value="3" {{ (old('member_type') == 3) ? 'selected' : ''}}>Advertisement Collector</option>
                            </select>
                            @if ($errors->has('member_type'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('member_type') }}</strong>
                                    </span>
                            @endif

                        </div>

                        <div id="member"  class="form-group has-feedback users" style="{{ (old('member_type') == 4) ? '' : 'display:none'}}">
                            <p>Members have special Benefits <a href="{{url('/members')}}" title="Members" target="_blank">Read More...</a></p>
                            <div class="col-xs-8">
                                <div class="checkbox icheck">
                                    @php
                                     $Packages = \App\Package::all();
                                    @endphp

                                    @if(is_object($Packages) && (count($Packages) > 0))
                                    @foreach ($Packages as $Package)
                                            <label>
                                                <input type="radio" value="{{$Package->id}}" name="package" {{ (old('package') == 1) ? 'checked' : ''}}>
                                                [{{$Package->package_name}}] - [{{$Package->package_period}} Days] - [{{$Package->package_advertisments}} Advertisments] -  Rs.[{{$Package->package_price}}]/=
                                            </label>
                                    @endforeach
                                    @endif

                                </div>
                            </div>
                            <!-- /.col -->
                        </div>

                        <div class="form-group">

                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>

                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

</div>
@endsection
