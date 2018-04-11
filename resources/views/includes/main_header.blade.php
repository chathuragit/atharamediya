<header class="main-header">
    <!-- Logo -->
    <a href="{{url('/')}}" class="logo">
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">Atharamediya.lk</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <li class="nav-item {{ Request::segment(1) == '' ? 'active' : ''}}">
                    <a class="nav-link" href="{{url('/')}}">Home <span class="sr-only">(current)</span></a>
                </li>
                {{--<li class="nav-item {{ Request::segment(1) == 'services' ? 'active' : ''}}">
                    <a class="nav-link" href="#">Services</a>
                </li>--}}

                <li class="nav-item  {{ ((Request::segment(1) == 'adcollectors') || (Request::segment(1) == 'adcollector')) ? 'active' : ''}}">
                    <a class="nav-link" href="{{url('/adcollectors')}}">Ad Collectors</a>
                </li>

                <li class="nav-item {{ ((Request::segment(1) == 'members') || (Request::segment(1) == 'member')) ? 'active' : ''}}">
                    <a class="nav-link" href="{{url('/members')}}">Members</a>
                </li>

                <li class="nav-item {{ Request::segment(1) == 'all-ads' ? 'active' : ''}}">
                    <a class="nav-link" href="{{url('/all-ads')}}">All Ads </a>
                </li>


                <li class="nav-item createad">
                    @if(Auth::user() != null)
                        <a class="nav-link" href="{{url('/advertisments/create')}}">Create Add</a>
                    @else
                        <a class="nav-link" href="{{url('/login')}}">Create Add</a>
                    @endif
                </li>

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-user-circle"></i>
                        <span class="hidden-xs">{{Auth::user()->name}}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{url('/profile')}}" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="btn btn-default btn-flat">
                                    Sign out
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </nav>
</header>