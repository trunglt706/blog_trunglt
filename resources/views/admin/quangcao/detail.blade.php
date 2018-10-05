@extends('layouts.admin.main')
@section('content')
<div class="content-wrapper" style="min-height: 916px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            CHI TIẾT QUẢNG CÁO
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.index')}}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li><a href="{{route('admin.quangcao')}}">Danh sách quảng cáo</a></li>
            <li class="active">{{$object['qcao']->name}}</li>
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
                        <h3 class="box-title">Thông tin chi tiết</h3>
                        <div class="box-tools">
                            <div class="input-group input-group-sm" style="width: 60px;">
                                <div class="input-group-btn">
                                    <a class="btn btn-default" href="{{route('admin.quangcao.chitiet', ['id' => $object['qcao']->id])}}" style="margin-right: 5px;"><i class="fa fa-refresh"></i> Refresh</a>
                                    <a class="btn btn-default" href="{{route('admin.quangcao')}}"><i class="fa fa-arrow-left"></i> Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="col-md-12" style="margin-top: 10px;">@include('admin.notify')</div>
                    <!-- form start -->
                    <form role="form" action="{{route('admin.quangcao.update', ['id' => $object['qcao']->id])}}" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Tiêu đề quảng cáo *</label>
                                    <input type="text" required name="name" value="{{$object['qcao']->name}}" class="form-control" placeholder="Nhập tiêu đề ...">
                                    @csrf
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Đường dẫn * <small class="text-danger">(<a href="{{$object['qcao']->link}}" target="_blank">Xem quảng cáo</a>)</small></label>
                                    <input type="text" required name="slug" disabled="" value="{{$object['qcao']->slug}}" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label>Nội dung *</label>
                                    <textarea name="intro" required="" class="form-control" placeholder="Nhập nội dung ..." rows="3">{{$object['qcao']->intro}}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="photo">Ảnh hiển thị</label>
                                    <input type="file" id="AvatarPerson" name="photo">
                                    <p class="help-block" style="color: red;">Nên sử dụng hình ảnh PNG, JPG kích thước 600 x 337px</p>
                                </div>
                                <div class="form-group col-md-6">
                                    <div id="image-holder" style="max-height: 160px;">
                                        @if($object['qcao']->photo != "")
                                        <img class="img-responsive" src="{{url($object['qcao']->photo)}}" alt="{{$object['qcao']->slug}}"/>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label>Liên kết</label>
                                    <input type="text" name="link" value="{{$object['qcao']->link}}" class="form-control" placeholder="Nhập url ...">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Thứ tự *</label>
                                    <input type="number" name="order" value="{{$object['qcao']->order}}" class="form-control" placeholder="Nhập thứ tự ...">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Trạng thái *</label>
                                    <div class="col-12">
                                        <select name="status" class="form-control select2" required="">
                                            <option value="1" @if($object['qcao']->status == 1) selected @endif>Duyệt</option>
                                            <option value="0" @if($object['qcao']->status == 0) selected @endif>Không duyệt</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label>
                                        Thời gian tạo: <span class="badge bg-gray">{{date('H:i:s | d/m/Y', strtotime($object['qcao']->created_at))}}</span>
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
            <!--/.col (left) -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
@endsection