<header class="header">
    <a href="{{route('admin.home')}}" class="logo">
        <!-- Add the class icon to your logo image or logo icon to add the margining -->
        Việt - Nhật {{date("Y")}}
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>                    
        </a>

        <div class="navbar-right">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="glyphicon glyphicon-user"></i>
                        <span><?= $data['user']->NguoiDungTen ?> <i class="caret"></i></span>
                    </a>
                    <ul class="dropdown-menu" style="width: 150px;">
                        <!-- Menu Footer-->
                        <li class="">
                            <a href="{{route('admin.infor')}}" class="btn btn-default"><i class="fa fa-user"></i> Thông tin chi tiết</a>
                        </li>
                        <li class="">
                            <a href="{{route('logout')}}" class="btn btn-default"><i class="fa fa-sign-out"></i> Đăng xuất</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>