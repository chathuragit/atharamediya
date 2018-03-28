<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- search form -->
        <form action="#" method="GET" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit"  id="search-btn" class="btn btn-flat search_btn"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="{{ Request::segment(1) == 'dashboard' ? 'active' : ''}}">
                <a href="{{url('/dashboard')}}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>

            @if(Auth::user()->role <= 1)
            @php $treeview = array('administrators', 'advertisement_collectors', 'advertising_members', 'web_space_holders', 'individual_advertisers'); @endphp
            <li class="treeview {{ in_array(Request::segment(1), $treeview) ? 'active' : ''}}">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>Users</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ Request::segment(1) == 'administrators' ? 'active' : ''}}"><a href="{{url('/administrators')}}"><i class="fa fa-circle-o text-red"></i> Administrators</a></li>
                    <li class="{{ Request::segment(1) == 'advertisement_collectors' ? 'active' : ''}}"><a href="{{url('/advertisement_collectors')}}"><i class="fa fa-circle-o  text-yellow"></i> Advertisement Collectors</a></li>
                    <li class="{{ Request::segment(1) == 'advertising_members' ? 'active' : ''}}"><a href="{{url('/advertising_members')}}"><i class="fa fa-circle-o text-blue"></i> Advertising Members</a></li>
                    <li class="{{ Request::segment(1) == 'web_space_holders' ? 'active' : ''}}"><a href="{{url('/web_space_holders')}}"><i class="fa fa-circle-o text-light-blue"></i> Web Space Holders</a></li>
                    <li class="{{ Request::segment(1) == 'individual_advertisers' ? 'active' : ''}}"><a href="{{url('/individual_advertisers')}}"><i class="fa fa-circle-o text-green"></i> Individual Advertisers</a></li>
                </ul>
            </li>



            @php $treeview = array('categories', 'attributes'); @endphp
            <li class="treeview {{ in_array(Request::segment(1), $treeview) ? 'active' : ''}}">
                <a href="#">
                    <i class="fa fa-cubes"></i>
                    <span>Categories</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ Request::segment(1) == 'categories' ? 'active' : ''}}"><a href="{{url('/categories')}}"><i class="fa fa-circle-o"></i> Categories</a></li>
                    <li class="{{ Request::segment(1) == 'attributes' ? 'active' : ''}}"><a href="{{url('/attributes')}}"><i class="fa fa-circle-o"></i> Attributes</a></li>
                </ul>
            </li>
            @endif

            @php $treeview = array('advertisments', 'advertisments_active', 'advertisments_pending', 'advertisments_expired', 'advertisments_blocked'); @endphp
            <li class="treeview {{ in_array(Request::segment(1), $treeview) ? 'active' : ''}}">
                <a href="#">
                    <i class="fa fa-newspaper-o"></i>
                    <span>Advertisments</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ Request::segment(1) == 'advertisments' ? 'active' : ''}}"><a href="{{url('/advertisments')}}"><i class="fa fa-circle-o"></i> All Advertisments</a></li>
                    <li class="{{ Request::segment(1) == 'advertisments_active' ? 'active' : ''}}"><a href="{{url('/advertisments_active')}}"><i class="fa fa-circle-o"></i> Active Advertisments</a></li>
                    <li class="{{ Request::segment(1) == 'advertisments_pending' ? 'active' : ''}}"><a href="{{url('/advertisments_pending')}}"><i class="fa fa-circle-o"></i> Pending Advertisments</a></li>
                    <li class="{{ Request::segment(1) == 'advertisments_expired' ? 'active' : ''}}"><a href="{{url('/advertisments_expired')}}"><i class="fa fa-circle-o"></i> Expired Advertisments</a></li>
                    <li class="{{ Request::segment(1) == 'advertisments_blocked' ? 'active' : ''}}"><a href="{{url('/advertisments_blocked')}}"><i class="fa fa-circle-o"></i> Blocked Advertisments</a></li>
                </ul>
            </li>

            @php $treeview = array('banners'); @endphp
            <li class="treeview {{ in_array(Request::segment(1), $treeview) ? 'active' : ''}}">
                <a href="#">
                    <i class="fa fa-ticket"></i>
                    <span>Web Space Banners</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ Request::segment(1) == 'banners' ? 'active' : ''}}"><a href="{{url('/banners')}}"><i class="fa fa-circle-o"></i> Web Space Banners</a></li>
                </ul>
            </li>

            @if(Auth::user()->role <= 1)
                @php $treeview = array('packages'); @endphp
                <li class="treeview {{ in_array(Request::segment(1), $treeview) ? 'active' : ''}}">
                    <a href="#">
                        <i class="fa fa-diamond"></i>
                        <span>Packages</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ Request::segment(1) == 'packages' ? 'active' : ''}}"><a href="{{url('/packages')}}"><i class="fa fa-circle-o"></i> Packages</a></li>
                    </ul>
                </li>

            @php $treeview = array('pages', 'articles'); @endphp
            <li class="treeview {{ in_array(Request::segment(1), $treeview) ? 'active' : ''}}">
                <a href="#">
                    <i class="fa fa-file"></i>
                    <span>Pages</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ Request::segment(1) == 'pages' ? 'active' : ''}}"><a href="{{url('/pages')}}"><i class="fa fa-circle-o"></i> Pages</a></li>
                    <li class="{{ Request::segment(1) == 'articles' ? 'active' : ''}}"><a href="{{url('/articles')}}"><i class="fa fa-circle-o"></i> Articles</a></li>
                </ul>
            </li>


            <li class="{{ Request::segment(1) == 'logs' ? 'active' : ''}}">
                <a href="{{url('/logs')}}">
                    <i class="fa fa-history"></i> <span>Logs</span>
                </a>
            </li>
            @endif

            <li>
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    <i class="fa fa-power-off"></i> <span>Sign out</span>
                </a>
            </li>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>