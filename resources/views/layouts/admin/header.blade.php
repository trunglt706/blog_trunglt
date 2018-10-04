<header class="main-header">
    <!-- Logo -->
    <a href="{{route('admin.index')}}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>LTT</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b style="text-transform: uppercase">{{auth()->user()->username}}</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Tasks: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{url(auth()->user()->avatar)}}" class="user-image" alt="User Image">
                        <span class="hidden-xs" style="text-transform: capitalize">{{auth()->user()->name}}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="{{url(auth()->user()->avatar)}}" class="img-circle" alt="{{auth()->user()->name}}">
                            <p>
                                {{auth()->user()->email}}
                                <small>{{date('d-m-Y', strtotime(auth()->user()->created_at))}}</small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{route('admin.profile')}}" class="btn btn-default btn-flat">
                                    <i class="fa fa-user"></i> Profile
                                </a>
                            </div>
                            <div class="pull-right">
                                <a href="{{route('admin.logout')}}" class="btn btn-default btn-flat">
                                    <i class="fa fa-sign-out"></i> Sign out
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>