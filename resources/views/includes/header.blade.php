<nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <h2><a class="navbar-brand" href="{{url('/')}}">Atharamediya.lk</a></h2>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item {{ Request::segment(1) == '' ? 'active' : ''}}">
                <a class="nav-link" href="{{url('/')}}">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item {{ Request::segment(1) == 'services' ? 'active' : ''}}">
                <a class="nav-link" href="#">Services</a>
            </li>
            <li class="nav-item {{ Request::segment(1) == 'all-ads' ? 'active' : ''}}">
                <a class="nav-link" href="{{url('/all-ads')}}">All Ads </a>
            </li>
            @if(Auth::user() == null)
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/login')}}"><i class="fa fa-user-circle" aria-hidden="true"></i> Login</a>
                </li>
            @else
                <li class="nav-item">
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="nav-link">
                        <i class="fa fa-user-circle" aria-hidden="true"></i> Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            @endif

            <li class="nav-item">
                @if(Auth::user() != null)
                    <a class="nav-link" href="{{url('/create-add')}}">Create Add</a>
                @else
                    <a class="nav-link" href="{{url('/login')}}">Create Add</a>
                @endif
            </li>
        </ul>
    </div>
</nav>