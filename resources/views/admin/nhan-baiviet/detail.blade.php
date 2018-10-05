@extends('layouts.admin.main')
@section('content')
<div class="content-wrapper" style="min-height: 916px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            CHI TIẾT ĐĂNG KÝ NHẬN BÀI VIẾT
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.index')}}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li><a href="{{route('admin.nhanbaiviet')}}">Danh sách nhận bài viết</a></li>
            <li class="active">{{$object['nhan_bviet']->name}}</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12" style="margin-top: 10px;">@include('admin.notify')</div>
        </div>
        <div class="row">
            <!-- left column -->
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-envelope-open"></i> Thông tin chi tiết</h3>
                        <div class="box-tools">
                            <div class="input-group input-group-sm" style="width: 60px;">
                                <div class="input-group-btn">
                                    <a class="btn btn-default" href="{{route('admin.nhanbaiviet.chitiet', ['id' => $object['nhan_bviet']->id])}}" style="margin-right: 5px;"><i class="fa fa-refresh"></i> Refresh</a>
                                    <a class="btn btn-default" href="{{route('admin.nhanbaiviet')}}"><i class="fa fa-arrow-left"></i> Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" method="post" action="{{route('admin.nhanbaiviet.update', ['id' => $object['nhan_bviet']->id])}}" enctype="multipart/form-data">
                        @csrf
                        <div class="box-body">
                            <div class="form-group col-md-12">
                                <label for="email">Email đăng ký *</label>
                                <input type="email" required="" class="form-control" name="email" value="{{$object['nhan_bviet']->email}}">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="status">Trạng thái *</label>
                                <div class="row" style="margin-top: -10px;">
                                    <div class="col-sm-6">
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="status" value="1" @if($object['nhan_bviet']->status == 1) checked="checked" @endif>
                                                Duyệt
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="status" value="0" @if($object['nhan_bviet']->status == 0) checked="checked" @endif>
                                                Không duyệt
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label>
                                    Thời gian tạo: <span class="badge bg-gray">{{date('H:i:s | d/m/Y', strtotime($object['nhan_bviet']->created_at))}}</span>
                                </label>
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