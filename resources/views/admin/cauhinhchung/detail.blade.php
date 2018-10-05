@extends('layouts.admin.main')
@section('content')
<div class="content-wrapper" style="min-height: 916px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            CHI TIẾT CẤU HÌNH CHUNG
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.index')}}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li><a href="{{route('admin.cauhinhchung')}}">Loại thành viên</a></li>
            <li class="active">{{$object['chinh']->name}}</li>
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
                        <h3 class="box-title"><i class="fa fa-cogs"></i> Thông tin chi tiết</h3>
                        <div class="box-tools">
                            <div class="input-group input-group-sm" style="width: 60px;">
                                <div class="input-group-btn">
                                    <a class="btn btn-default" href="{{route('admin.cauhinhchung.chitiet', ['id' => $object['chinh']->id])}}" style="margin-right: 5px;"><i class="fa fa-refresh"></i> Refresh</a>
                                    <a class="btn btn-default" href="{{route('admin.cauhinhchung')}}"><i class="fa fa-arrow-left"></i> Back</a>
                                </div>
                            </div>
                        </div>
                    </div>`
                    <!-- /.box-header -->
                    <div class="col-md-12" style="margin-top: 10px;">@include('admin.notify')</div>
                    <!-- form start -->
                    <form role="form" method="post" action="{{route('admin.cauhinhchung.update', ['id' => $object['chinh']->id])}}" enctype="multipart/form-data">
                        @csrf
                        <div class="box-body">
                            <div class="form-group col-md-6">
                                <label for="name">Tên cấu hình *</label>
                                <input required="" class="form-control" name="name" value="{{$object['chinh']->name}}">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Loại cấu hình *</label>
                                <select required="" class="form-control type-cauhinh select2" name="type" onchange="changeTypeCauHinh(this);">
                                    <option value="text" @if($object['chinh']->type == "text") selected @endif>Text</option>
                                    <option value="img" @if($object['chinh']->type == "img") selected @endif>Hình ảnh</option>
                                </select>
                            </div>
                            <div class="form-group col-md-12 value-text @if($object['chinh']->type == 'img') hidden @endif">
                                <label>Giá trị*</label>
                                <input type="text" name="value_text" value="{{$object['chinh']->value}}" id="value-text-input" class="form-control" placeholder="Nhập giá trị ...">
                            </div>
                            <div class="form-group col-md-12 value-img @if($object['chinh']->type == 'text') hidden @endif">
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label for="value">Giá trị *</label>
                                        <input type="file" id="AvatarPerson" name="value_img" id="value-img-input">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <div id="image-holder" style="max-height: 160px;">
                                            @if($object['chinh']->value != '')
                                            <img class="img-responsive" src="{{url($object['chinh']->value)}}" alt="{{$object['chinh']->slug}}"/>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="intro">Mô tả</label>
                                <textarea name="intro" rows="3" class="form-control">{{$object['chinh']->intro}}</textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <label>
                                    Thời gian tạo: <span class="badge bg-gray">{{date('H:i:s | d/m/Y', strtotime($object['chinh']->created_at))}}</span>
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
<script>
//    Event change selete type cauhinh
    function changeTypeCauHinh(value) {
        var type = $(value).val();
        if(type === "img") {
            $(".value-text").addClass('hidden');
            $("#value-img-input").attr('required');
            $(".value-img").removeClass('hidden');
            $("#value-text-input").removeAttr('required');
        } else {
            $(".value-img").addClass('hidden');
            $("#value-text-input").attr('required');
            $(".value-text").removeClass('hidden');
            $("#value-img-input").removeAttr('required');
        }
    }
</script>
@endsection