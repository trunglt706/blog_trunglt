<div class="rows main-menu rst-top-main-menu-full header-sticky border-line pull-leff">
    <form class="search-form" action="" method="get">
        <div class="ub-search">
            <input type="text" placeholder="Tìm kiếm ..." name="key">
            <button type="submit" value="Tìm kiếm" class="sb"></button>
            <input class="sb" type="submit" value="Search">
        </div><!--End-search-->
    </form>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div>
        <div class="logo-fixed">
            <a href="{{route('home')}}">
                {{$data['title']->value}}
            </a>
        </div>
        <ul id="menu-main-menu-1" class="rst-nav-menu clearfix">
            <li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-firstmenu-item-1536 menu_1">
                <a href="{{route('home')}}">Trang chủ
            </li>
            <li class="menu-item menu-item-type-custom menu-item-1050 lien-he">
                <a href="{{route('introduce')}}">Giới thiệu chung
                </a>
            </li>
            <li class="dropdown menu-item menu-item-type-custom menu-item-1050">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Danh mục bài viết</a>
                @if(!is_null($data['danhmuc']))
                <ul class="dropdown-menu animated" style="display: none;">
                    @foreach($data['danhmuc'] as $dmuc)
                    <li><a href="{{route('danhmuc.baiviet', ['slug' => $dmuc->slug])}}">{{$dmuc->name}}</a></li>
                    @endforeach
                </ul>
                @endif
            </li>
            <li class="menu-item menu-item-type-custom menu-item-1050">
                <a href="{{route('contact')}}">Liên hệ
                </a>
            </li>
            <li class="menu-item menu-item-type-custom menu-item-1050">
                <a href="{{route('hoidap')}}">Hỏi đáp
                </a>
            </li>
        </ul>
    </div>

    <div class="rst-top-search pull-right">
        <a href="javascript:void(0)"><i class="fa fa-search"></i></a>
    </div>
</div>