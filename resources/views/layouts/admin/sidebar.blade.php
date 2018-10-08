<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{(!is_null(auth()->user()->avatar) && (auth()->user()->avatar != "")) ? url(auth()->user()->avatar) : url('images/no-image.jpg')}}" class="img-circle" alt="{{auth()->user()->name}}">
            </div>
            <div class="pull-left info">
                <p style="text-transform: capitalize">{{auth()->user()->name}}</p>
                <a href="javascript:;"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div><br/>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="treeview {{areActiveRoutes(['admin.loaithanhvien', 'admin.danhmuc'])}}">
                <a href="#">
                    <i class="fa fa-th"></i> <span>Danh mục</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{isActiveRoute('admin.loaithanhvien')}}"><a href="{{route('admin.loaithanhvien')}}"><i class="fa fa-circle-o"></i> Loại thành viên</a></li>
                    <li class="{{isActiveRoute('admin.danhmuc')}}"><a href="{{route('admin.danhmuc')}}"><i class="fa fa-circle-o"></i> Danh mục bài viết</a></li>
                </ul>
            </li>
            <li class="treeview {{areActiveRoutes(['admin.baiviet', 'admin.thanhvien', 'admin.quangcao'])}}">
                <a href="#">
                    <i class="fa fa-book"></i>
                    <span>Nội dung</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{isActiveRoute('admin.baiviet')}}"><a href="{{route('admin.baiviet')}}"><i class="fa fa-circle-o"></i> Bài viết</a></li>
                    <li class="{{isActiveRoute('admin.thanhvien')}}"><a href="{{route('admin.thanhvien')}}"><i class="fa fa-circle-o"></i> Thành viên</a></li>
                    <li class="{{isActiveRoute('admin.quangcao')}}"><a href="{{route('admin.quangcao')}}"><i class="fa fa-circle-o"></i> Quảng cáo</a></li>
                </ul>
            </li>
            <li class="treeview {{areActiveRoutes(['admin.gopy', 'admin.hoidap', 'admin.nhanbaiviet'])}}">
                <a href="#">
                    <i class="fa fa-folder"></i>
                    <span>Khác</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{isActiveRoute('admin.gopy')}}"><a href="{{route('admin.gopy')}}"><i class="fa fa-circle-o"></i> Góp ý</a></li>
                    <li class="{{isActiveRoute('admin.hoidap')}}"><a href="{{route('admin.hoidap')}}"><i class="fa fa-circle-o"></i> Hỏi đáp</a></li>
                    <li class="{{isActiveRoute('admin.nhanbaiviet')}}"><a href="{{route('admin.nhanbaiviet')}}"><i class="fa fa-circle-o"></i> Nhận bài viết</a></li>
                </ul>
            </li>
            <li class="{{isActiveRoute('admin.cauhinhchung')}}">
                <a href="{{route('admin.cauhinhchung')}}">
                    <i class="fa fa-cogs"></i> <span>Cấu hình chung</span>
                </a>
            </li>
            <li class="{{isActiveRoute('admin.phantich.dulieu')}}">
                <a href="{{route('admin.phantich.dulieu')}}">
                    <i class="fa fa-pie-chart"></i> <span>Phân tích dữ liệu</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>