@extends('layouts.admin.main')
@section('content')
<div class="content-wrapper" style="min-height: 916px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            CHI TIẾT LOẠI THÀNH VIÊN
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.index')}}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li><a href="{{route('admin.loaithanhvien')}}">Loại thành viên</a></li>
            <li class="active">{{$object['loaitv']->name}}</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-address-card"></i> Thông tin chi tiết</h3>
                        <div class="box-tools">
                            <div class="input-group input-group-sm" style="width: 60px;">
                                <div class="input-group-btn">
                                    <a class="btn btn-default" href="{{route('admin.loaithanhvien.chitiet', ['id' => $object['loaitv']->id])}}" style="margin-right: 5px;"><i class="fa fa-refresh fa-spin"></i> Refresh</a>
                                    <a class="btn btn-default" href="{{route('admin.loaithanhvien')}}"><i class="fa fa-arrow-left"></i> Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="col-md-12" style="margin-top: 10px;">@include('admin.notify')</div>
                    <!-- form start -->
                    <form role="form" method="post" action="{{route('admin.loaithanhvien.update', ['id' => $object['loaitv']->id])}}" enctype="multipart/form-data">
                        @csrf
                        <div class="box-body">
                            <div class="form-group col-md-6">
                                <label for="name">Tên loại thành viên *</label>
                                <input required="" class="form-control" name="name" value="{{$object['loaitv']->name}}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="mark">Số điểm *</label>
                                <input type="number" required="" class="form-control" name="mark" value="{{$object['loaitv']->mark}}">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="intro">Mô tả</label>
                                <textarea name="intro" rows="3" class="form-control">{{$object['loaitv']->intro}}</textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="status">Trạng thái *</label>
                                <div class="row" style="margin-top: -10px;">
                                    <div class="col-sm-2">
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="status" value="1" @if($object['loaitv']->status == 1) checked="checked" @endif>
                                                Duyệt
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="status" value="0" @if($object['loaitv']->status == 0) checked="checked" @endif>
                                                Không duyệt
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="logo">Ảnh đại diện</label>
                                <input type="file" id="AvatarPerson" name="logo">
                                <p class="help-block">Nên sử dụng hình ảnh PNG, JPG kích thước 50x80px</p>
                            </div>
                            <div class="form-group col-md-6">
                                <div id="image-holder" style="max-height: 160px;">
                                    @if($object['loaitv']->logo != null)
                                    <img src="{{url($object['loaitv']->logo)}}" class="img-responsive" alt="" style="max-height: 200px;"/>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
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