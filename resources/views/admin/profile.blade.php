@extends('layouts.admin.main')
@section('content')
<div class="content-wrapper" style="min-height: 1126px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Profile cá nhân
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.index')}}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li class="active">Profile</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        @include('admin.notify')
        <div class="row">
            <div class="col-md-3">
                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="{{url(auth()->user()->avatar)}}" alt="{{auth()->user()->name}}">
                        <h3 class="profile-username text-center">{{auth()->user()->name}}</h3>
                        <p class="text-muted text-center">Join at: {{date('d/m/Y', strtotime(auth()->user()->created_at))}}</p>
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Số bài viết</b> <a class="pull-right badge"><?= App\baiviets::countBaiVietUser(auth()->user()->username) ?></a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
                <!-- About Me Box -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">About Me</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <strong><i class="fa fa-address-card margin-r-5"></i> Username</strong>
                        <p class="text-muted">
                            {{auth()->user()->username}}
                        </p>
                        <hr>
                        <strong><i class="fa fa-envelope margin-r-5"></i> Email</strong>
                        <p class="text-muted">
                            {{auth()->user()->email}}
                        </p>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#baiviets" data-toggle="tab" aria-expanded="true"><i class="fa fa-newspaper-o"></i> Bài viết</a></li>
                        <li class=""><a href="#thongtins" data-toggle="tab" aria-expanded="false"><i class="fa fa-user-circle-o"></i> Thông tin</a></li>
                        <li class=""><a href="#taikhoans" data-toggle="tab" aria-expanded="false"><i class="fa fa-key"></i> Tài khoản</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="baiviets">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr class="bg-info">
                                                <th class="text-center" style="max-width: 300px;">Tên bài viết</th>
                                                <th class="text-center hidden-xs">Username</th>
                                                <th class="text-center hidden-xs">Hình ảnh</th>
                                                <th class="text-center" style="width: 100px;">Lượt xem</th>
                                                <th class="text-center hidden-xs" style="width: 100px;">Lượt like</th>
                                                <th class="text-center hidden-xs" style="width: 100px;">Trạng thái</th>
                                                <th class="text-center" style="width: 120px;">Action</th>
                                            </tr>
                                        </thead>
                                        @foreach($list_bviet as $bviet)
                                        <tbody>
                                            <tr>
                                                <td><a href="{{route('detail.baiviet', ['slug' => $bviet->slug])}}" target="_blank">{{$bviet->name}}</a></td>
                                                <td class="hidden-xs">{{$bviet->username}}</td>
                                                <td class="hidden-xs text-center">
                                                    <a href="{{route('detail.baiviet', ['slug' => $bviet->slug])}}" target="_blank"><img src="{{url($bviet->thumn)}}" alt="{{$bviet->slug}}" width="100px"/></a>
                                                </td>
                                                <td class="text-center">{{$bviet->view}}</td>
                                                <td class="text-center hidden-xs">{{$bviet->like}}</td>
                                                <td class="text-center hidden-xs">
                                                    @if($bviet->status == 0)
                                                    <div class="label bg-gray">Chưa duyệt</div>
                                                    @elseif($bviet->status == 1)
                                                    <div class="label bg-green">Đã duyệt</div>
                                                    @else
                                                    <div class="label bg-red">Bị khóa</div>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <a class="btn btn-danger btn-delete" onclick="deleteData('{{$bviet->id}}');" title="Xóa dữ liệu" data-toggle="tooltip" data-placement="top" href="javascript:;"><i class="fa fa-remove"></i></a>&nbsp;
                                                    <a class="btn btn-info" title="Cập nhật dữ liệu" data-toggle="tooltip" data-placement="bottom" href="{{route('admin.baiviet.chitiet', ['id' => $bviet->id])}}"><i class="fa fa-edit"></i></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                        @endforeach
                                    </table>
                                </div>
                                <div class="col-md-12">
                                    {{ $list_bviet->links() }}
                                </div>
                            </div>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="thongtins">
                            <div class="row">
                                <div class="col-md-12">
                                    <form role="form" method="post" action="{{route('admin.info.update')}}"enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="name">Họ tên *</label>
                                                <input type="text" class="form-control" required="" value="{{auth()->user()->name}}" name="name" placeholder="Nhập họ tên ...">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="email">Email *</label>
                                                <input type="email" name="email" required="" class="form-control" value="{{auth()->user()->email}}" placeholder="Nhập email ...">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Mô tả *</label>
                                            <textarea name="intro" required="" class="form-control" placeholder="Nhập mô tả ..." rows="3">{{auth()->user()->intro}}</textarea>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="avatar">Avatar</label>
                                                <input type="file" id="AvatarPerson" name="avatar">
                                                <p class="help-block" style="color: red;">Nên sử dụng hình ảnh PNG, JPG kích thước 600 x 337px</p>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <div id="image-holder" style="max-height: 160px;">
                                                    @if(auth()->user()->avatar != "")
                                                    <img class="img-responsive" src="{{url(auth()->user()->avatar)}}" alt="{{auth()->user()->username}}"/>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="background">Ảnh bìa</label>
                                                <input type="file" id="Background" name="background">
                                                <p class="help-block" style="color: red;">Nên sử dụng hình ảnh PNG, JPG kích thước 600 x 337px</p>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <div id="image-holder-background" style="max-height: 160px;">
                                                    @if(auth()->user()->background != "")
                                                    <img class="img-responsive" src="{{url(auth()->user()->background)}}" alt="{{auth()->user()->username}}"/>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-danger"><i class="fa fa-save"></i> Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="taikhoans">
                            <div class="row">
                                <div class="col-md-12">
                                    <form role="form" method="post" action="{{route('admin.account.update')}}"enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="username">Tài khoản *</label>
                                                <input type="text" class="form-control" required="" disabled="" value="{{auth()->user()->username}}" name="username" placeholder="Chưa có tài khoản ...">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="password">Mật khẩu *</label>
                                                <input type="password" name="password" required="" class="form-control" placeholder="Nhập mật khẩu ...">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-danger"><i class="fa fa-save"></i> Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<script>
    function deleteData(id) {
        if(confirm('Bạn có muốn xóa bài viết này?')) {
            var url = "{{route('admin.baiviet.delete', ':id')}}";
            location.href = url.replace(":id", id);
        }
    }
</script>
@endsection