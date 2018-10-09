@extends('layouts.user.main')
@section('content')
<div class="content-wrapper" style="min-height: 1126px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Profile cá nhân
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('user.index')}}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li class="active">Profile</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        @include('user.notify')
        <div class="row">
            <div class="col-md-3">
                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="{{(!is_null(auth()->user()->avatar) && (auth()->user()->avatar != "")) ? url(auth()->user()->avatar) : url('images/no-image.jgp')}}" alt="{{auth()->user()->name}}">
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
                        <li class="active"><a href="#thongtins" data-toggle="tab" aria-expanded="true"><i class="fa fa-user-circle-o"></i> Thông tin</a></li>
                        <li class=""><a href="#taikhoans" data-toggle="tab" aria-expanded="false"><i class="fa fa-key"></i> Tài khoản</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="thongtins">
                            <div class="row">
                                <div class="col-md-12">
                                    <form role="form" method="post" action="{{route('user.info.update')}}"enctype="multipart/form-data">
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
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="taikhoans">
                            <div class="row">
                                <div class="col-md-12">
                                    <form role="form" method="post" action="{{route('user.account.update')}}"enctype="multipart/form-data">
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
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
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
@endsection