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
            <li class="{{isActiveRoute('user.profile')}}">
                <a href="{{route('user.profile')}}">
                    <i class="fa fa-user-circle-o"></i> <span>Thông tin cá nhân</span>
                </a>
            </li>
            <li class="{{isActiveRoute('user.baiviet')}}">
                <a href="{{route('user.baiviet')}}">
                    <i class="fa fa-newspaper-o"></i> <span>Bài viết</span>
                </a>
            </li>
            <li class="{{isActiveRoute('user.phantich.dulieu')}}">
                <a href="{{route('user.phantich.dulieu')}}">
                    <i class="fa fa-pie-chart"></i> <span>Phân tích dữ liệu</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>