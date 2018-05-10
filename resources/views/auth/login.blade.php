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

@section('content')
    @include('includes.header')
    <div class="login-logo">
        <a title="Atharamediya"><img src="{{ asset('images/logo-atharamediya.png')}}" alt="Athramediya" class="img-fluid home-logo"></a>
    </div>


    <div class="container">
        <div class="row boxer">
            <div class="col-lg-4"></div>
            <div class="col-lg-4 top">
                <p class="text-center login-box-msg">Sign In here to start your session</p>
            </div>
            <div class="col-lg-4"></div>
            <div class="col-lg-12 bottom" style="display: block;">
                <div class="login-box">
                    <div class="login-box-body">
                        <form method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}
                            <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                                <input id="email" type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required autofocus>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                            </div>

                            <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
                                <input id="password" type="password" class="form-control" name="password"  placeholder="Password" required>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                            </div>

                            <div class="">
                                <div class="col-xs-8">
                                    <div class="checkbox icheck">
                                        <label>
                                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                        </label>
                                    </div>
                                </div>

                                <div class="col-xs-4">
                                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>


                                    <a type="submit" href="{{url('/register')}}" class="btn btn-success btn-block btn-flat">Sign Up</a>
                                </div>

                            </div>
                        </form>
                    </div>
                    <!-- /.login-box-body -->
                </div>
            </div>
        </div>

    </div>

@endsection
