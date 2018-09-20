<aside class="left-side sidebar-offcanvas">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel" style="background: #428bca;">
            <div class="image text-center">
                @if($data['user']->NguoiDungAvatar != "")
                <img src="{{url( $data['user']->NguoiDungAvatar)}}" class="img-circle" alt="<?= $data['user']->NguoiDungTen ?>" />
                @else
                <img src="{{url( 'images/no-img.jpg' )}}" class="img-circle" alt="<?= $data['user']->NguoiDungTen ?>" />
                @endif
            </div>
            <div class="info text-center">
                <p>Hello, <?= $data['user']->NguoiDungTen ?></p>
                <i class="fa fa-circle text-success"></i> Online
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="" id="trangchu">
                <a href="{{route('admin.home')}}">
                    <i class="fa fa-home"></i> <span>Trang chủ</span>
                </a>
            </li>
            <li class="treeview" id="qldanhmuc">
                <a href="javascript:;">
                    <i class="fa fa-bars"></i>
                    <span>Danh mục</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li id="qlloaigianhang"><a href="{{route('admin.loaigianhang.list')}}"><i class="fa fa-angle-double-right"></i> Loại gian hàng</a></li>
                    <li id="qlloaitaitro"><a href="{{route('admin.loaitaitro.list')}}"><i class="fa fa-angle-double-right"></i> Loại tài trợ</a></li>
                </ul>
            </li>
            <li class="treeview" id="qlchung">
                <a href="javascript:;">
                    <i class="fa fa-indent"></i>
                    <span>Quản lý chung</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li id="qlnguoidung"><a href="{{route('admin.user.list')}}"><i class="fa fa-angle-double-right"></i> Quản lý người dùng</a></li>
                    <li id="qltaitro"><a href="{{route('admin.sponsor.list')}}"><i class="fa fa-angle-double-right"></i> Quản lý tài trợ</a></li>
                    <li id="qlgianhang"><a href="{{route('admin.gianhang.list')}}"><i class="fa fa-angle-double-right"></i> Quản lý gian hàng</a></li>
                </ul>
            </li>
            <li class="treeview" id="noidung">
                <a href="javascript:;">
                    <i class="fa fa-file-text-o"></i>
                    <span>Nội dung</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li id="qltintuc"><a href="{{route('admin.news.list')}}"><i class="fa fa-angle-double-right"></i> Quản lý tin tức</a></li>
                    <li id="qllienhe"><a href="{{route('admin.lienhe.list')}}"><i class="fa fa-angle-double-right"></i> Quản lý liên hệ</a></li>
                    <li id="qlgopy"><a href="{{route('admin.gopy.list')}}"><i class="fa fa-angle-double-right"></i> Quản lý góp ý</a></li>
                    <li id="qlnhanbaiviet"><a href="{{route('admin.nhanbaiviet.list')}}"><i class="fa fa-angle-double-right"></i> Quản lý nhận bài viết</a></li>
                </ul>
            </li>
            <li class="treeview" id="thongkechung">
                <a href="javascript:;">
                    <i class="fa fa-bar-chart-o"></i>
                    <span>Thống kê</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li id="tktaitro"><a href="{{route('admin.thongke', ['key' => 'tai-tro'])}}"><i class="fa fa-angle-double-right"></i> Thống kê tài trợ</a></li>
                    <li id="tkgianhang"><a href="{{route('admin.thongke', ['key' => 'gian-hang'])}}"><i class="fa fa-angle-double-right"></i> Thống kê gian hàng</a></li>
                    <li id="tktintuc"><a href="{{route('admin.thongke', ['key' => 'tin-tuc'])}}"><i class="fa fa-angle-double-right"></i> Thống kê tin tức</a></li>
                </ul>
            </li>
            <li id="new-letter">
                <a href="{{route('admin.newletter.list')}}">
                    <i class="fa fa-envelope"></i> Newsletters
                    <small class="label pull-right bg-yellow">{{count($data['dsnewletter'])}}</small>
                </a>
            </li>
            <li id="cauhinhhethong">
                <a href="{{route('admin.system.config')}}">
                    <i class="fa fa-cog"></i> Cấu hình hệ thống
                </a>
            </li>
<!--            <li id="language">
                <a href="/changeLang/@lang('index.flag')" class="flag">
                    <i class="fa fa-flag-o"></i> Ngôn ngữ: <img src="/images/@lang('index.flag').png" alt="flag"/>
                </a>
            </li>-->
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>