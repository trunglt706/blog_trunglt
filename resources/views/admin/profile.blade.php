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
                                                <td>{{$bviet->name}}</td>
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
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label for="name" class="col-sm-2 control-label">Họ tên</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" required="" name="name" placeholder="Nhập họ tên ...">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" name="email" required="" class="form-control" placeholder="Nhập email ...">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-danger">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="taikhoans">
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="inputName" placeholder="Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputName" placeholder="Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputExperience" class="col-sm-2 control-label">Experience</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputSkills" class="col-sm-2 control-label">Skills</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-danger">Submit</button>
                                    </div>
                                </div>
                            </form>
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
@endsection