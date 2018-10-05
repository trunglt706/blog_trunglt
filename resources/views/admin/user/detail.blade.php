@extends('layouts.admin.main')
@section('content')
<div class="content-wrapper" style="min-height: 916px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            CHI TIẾT THÀNH VIÊN
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.index')}}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li><a href="{{route('admin.thanhvien')}}">Danh sách thành viên</a></li>
            <li class="active">{{$object['tvien']->name}}</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-9">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-user-circle"></i> Thông tin thành viên</h3>
                        <div class="box-tools">
                            <div class="input-group input-group-sm" style="width: 60px;">
                                <div class="input-group-btn">
                                    <a class="btn btn-default" href="{{route('admin.thanhvien.chitiet', ['id' => $object['tvien']->id])}}" style="margin-right: 5px;"><i class="fa fa-refresh"></i> Refresh</a>
                                    <a class="btn btn-default" href="{{route('admin.thanhvien')}}"><i class="fa fa-arrow-left"></i> Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="col-md-12" style="margin-top: 10px;">@include('admin.notify')</div>
                    <!-- form start -->
                    <form role="form" action="{{route('admin.thanhvien.update.info', ['id' => $object['tvien']->id])}}" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Tên thành viên *</label>
                                    <input type="text" required name="name" value="{{$object['tvien']->name}}" class="form-control" placeholder="Nhập tên ...">
                                    @csrf
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Loại thành viên *</label>
                                    <div class="col-12">
                                        <select name="id_loaithanhvien" class="form-control select2" required="">
                                            @foreach($object['loai_tvien'] as $tvien)
                                            <option value="{{$tvien->id}}" @if($object['tvien']->id_loaithanhvien == $tvien->id) selected @endif>{{$tvien->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label>Mô tả *</label>
                                    <textarea name="intro" required="" class="form-control" placeholder="Nhập mô tả ..." rows="3">{{$object['tvien']->intro}}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="avatar">Avatar</label>
                                    <input type="file" id="AvatarPerson" name="avatar">
                                    <p class="help-block" style="color: red;">Nên sử dụng hình ảnh PNG, JPG kích thước 600 x 337px</p>
                                </div>
                                <div class="form-group col-md-6">
                                    <div id="image-holder" style="max-height: 160px;">
                                        @if($object['tvien']->avatar != "")
                                        <img class="img-responsive" src="{{url($object['tvien']->avatar)}}" alt="{{$object['tvien']->username}}"/>
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
                                        @if($object['tvien']->background != "")
                                        <img class="img-responsive" src="{{url($object['tvien']->background)}}" alt="{{$object['tvien']->username}}"/>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Trạng thái *</label>
                                    <div class="col-12">
                                        <select name="status" class="form-control select2" required="">
                                            <option value="1" @if($object['tvien']->status == 1) selected @endif>Duyệt</option>
                                            <option value="0" @if($object['tvien']->status == 0) selected @endif>Không duyệt</option>
                                            <option value="-1" @if($object['tvien']->status == -1) selected @endif>Khóa</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label>
                                        Thời gian tạo: <span class="badge bg-gray">{{date('H:i:s | d/m/Y', strtotime($object['tvien']->created_at))}}</span>
                                    </label>
                                </div>
                                <div class="checkbox icheck col-md-3">
                                    <label>
                                        <input type="checkbox" name="important" @if($object['tvien']->online == 1) checked @endif> Online
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                        </div>
                    </form>
                </div>
                <!-- /.box -->
            </div>
            <div class="col-md-3">
                <!-- general form elements -->
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-user-secret"></i> Thông tin tài khoản</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="col-md-12" style="margin-top: 10px;">@include('admin.notify')</div>
                    <!-- form start -->
                    <form role="form" action="{{route('admin.thanhvien.update.account', ['id' => $object['tvien']->id])}}" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group col-md-12">
                                <label>Username *</label>
                                <input type="text" required name="username" disabled="" value="{{$object['tvien']->username}}" class="form-control">
                            </div>
                            <div class="form-group col-md-12">
                                <label>Email *</label>
                                <input type="email" name="email" value="{{$object['tvien']->email}}" class="form-control" placeholder="Nhập email ...">
                            </div>
                            <div class="form-group col-md-12">
                                <label>Mật khẩu *</label>
                                <input type="password" name="password" class="form-control" placeholder="Nhập mật khẩu ...">
                            </div>
                        </div>
                        <div class="box-footer text-center">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                        </div>
                    </form>
                </div>
                <!-- /.box -->
            </div>
            <!--/.col (left) -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
@endsection