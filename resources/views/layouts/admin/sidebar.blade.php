<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{url(auth()->user()->avatar)}}" class="img-circle" alt="{{auth()->user()->name}}">
            </div>
            <div class="pull-left info">
                <p style="text-transform: capitalize">{{auth()->user()->name}}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="treeview {{areActiveRoutes([])}}">
                <a href="#">
                    <i class="fa fa-th"></i> <span>Danh mục</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{isActiveRoute('')}}"><a href="index.html"><i class="fa fa-circle-o"></i> Loại thành viên</a></li>
                    <li class="{{isActiveRoute('')}}"><a href="index2.html"><i class="fa fa-circle-o"></i> Danh mục bài viết</a></li>
                </ul>
            </li>
            <li class="treeview {{areActiveRoutes([])}}">
                <a href="#">
                    <i class="fa fa-book"></i>
                    <span>Nội dung</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{isActiveRoute('')}}"><a href=""><i class="fa fa-circle-o"></i> Bài viết</a></li>
                    <li class="{{isActiveRoute('')}}"><a href=""><i class="fa fa-circle-o"></i> Thành viên</a></li>
                    <li class="{{isActiveRoute('')}}"><a href=""><i class="fa fa-circle-o"></i> Quảng cáo</a></li>
                </ul>
            </li>
            <li class="treeview {{areActiveRoutes([])}}">
                <a href="#">
                    <i class="fa fa-folder"></i>
                    <span>Khác</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{isActiveRoute('')}}"><a href=""><i class="fa fa-circle-o"></i> Góp ý</a></li>
                    <li class="{{isActiveRoute('')}}"><a href=""><i class="fa fa-circle-o"></i> Hỏi đáp</a></li>
                    <li class="{{isActiveRoute('')}}"><a href=""><i class="fa fa-circle-o"></i> Nhận bài viết</a></li>
                    <li class="{{isActiveRoute('')}}"><a href=""><i class="fa fa-circle-o"></i> Phản hồi</a></li>
                </ul>
            </li>
            <li class="{{isActiveRoute('')}}">
                <a href="pages/widgets.html">
                    <i class="fa fa-cogs"></i> <span>Cấu hình chung</span>
                </a>
            </li>
            <li class="{{isActiveRoute('')}}">
                <a href="pages/widgets.html">
                    <i class="fa fa-pie-chart"></i> <span>Phân tích dữ liệu</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>