@extends('layouts.user.main')
@section('content')
<div class="content-wrapper" style="min-height: 916px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            CHI TIẾT BÀI VIẾT
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('user.index')}}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li><a href="{{route('user.baiviet')}}">Danh mục bài viết</a></li>
            <li class="active">{{$object['bviet']->name}}</li>
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
                        <h3 class="box-title"><i class="fa fa-newspaper-o"></i> Thông tin chi tiết</h3>
                        <div class="box-tools">
                            <div class="input-group input-group-sm" style="width: 60px;">
                                <div class="input-group-btn">
                                    <a class="btn btn-danger btn-delete" onclick="deleteData('{{$object['bviet']->id}}');" href="javascript:;" style="margin-right: 5px;"><i class="fa fa-remove"></i> Xóa</a>
                                    <a class="btn btn-default" href="{{route('user.baiviet.chitiet', ['id' => $object['bviet']->id])}}" style="margin-right: 5px;"><i class="fa fa-refresh fa-spin"></i> Refresh</a>
                                    <a class="btn btn-default" href="{{route('user.baiviet')}}"><i class="fa fa-arrow-left"></i> Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="col-md-12" style="margin-top: 10px;">@include('user.notify')</div>
                    <!-- form start -->
                    <form role="form" action="{{route('user.baiviet.update', ['id' => $object['bviet']->id])}}" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Tên bài viết *</label>
                                    <input type="text" required name="name" value="{{$object['bviet']->name}}" class="form-control" placeholder="Nhập tên ...">
                                    @csrf
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Đường dẫn * <small class="text-danger">(<a href="{{route('detail.baiviet', ['slug' => $object['bviet']->slug])}}" target="_blank">Xem bài viết</a>)</small></label>
                                    <input type="text" required name="slug" disabled="" value="{{$object['bviet']->slug}}" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Danh mục bài viết *</label>
                                    <div class="col-12">
                                        <select name="id_danhmuc" class="form-control select2" required="">
                                            @foreach($object['list_danhmuc'] as $dmuc)
                                            <option value="{{$dmuc->id}}" @if($object['bviet']->id_danhmuc == $dmuc->id) selected @endif>{{$dmuc->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Từ khóa <small class="text-danger">(Mỗi từ khóa ngăn cách nhau bởi dấu phẩy)</small></label>
                                    <input type="text" name="keyword" value="{{$object['bviet']->keyword}}" class="form-control" placeholder="Nhập từ khóa ...">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label>Mô tả ngắn *</label>
                                    <textarea name="intro" required="" class="form-control" placeholder="Nhập mô tả ..." rows="3">{{$object['bviet']->intro}}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label>Nội dung bài viết *</label>
                                    <textarea name="content" id="ckeditor" required="" class="form-control ckeditor" placeholder="Nhập nội dung ..." rows="3">{{$object['bviet']->content}}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="thumn">Ảnh hiển thị</label>
                                    <input type="file" id="AvatarPerson" name="thumn">
                                    <p class="help-block" style="color: red;">Nên sử dụng hình ảnh PNG, JPG kích thước 600 x 337px</p>
                                </div>
                                <div class="form-group col-md-6">
                                    <div id="image-holder" style="max-height: 160px;">
                                        @if($object['bviet']->thumn != "")
                                        <img class="img-responsive" src="{{url($object['bviet']->thumn)}}" alt="{{$object['bviet']->slug}}"/>
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
                                        @if($object['bviet']->background != "")
                                        <img class="img-responsive" src="{{url($object['bviet']->background)}}" alt="{{$object['bviet']->slug}}"/>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label>
                                        Trạng thái: 
                                        @if($object['bviet']->status == 1)
                                        <span class="badge bg-green">Đã duyệt</span>
                                        @elseif ($object['bviet']->status == 0)
                                        <span class="badge bg-gray">Chưa duyệt</span>
                                        @else
                                        <span class="badge bg-red">Đang khóa</span>
                                        @endif
                                    </label>
                                </div>
                                <div class="form-group col-md-2">
                                    <label>
                                        Rating: 
                                        <span class="badge bg-orange">{{$object['bviet']->rating}}</span>
                                    </label>
                                </div>
                                <div class="col-md-2">
                                    <label>
                                        Lượt xem: <span class="badge bg-blue">{{$object['bviet']->view}}</span>
                                    </label>
                                </div>
                                <div class="col-md-2">
                                    <label>
                                        Lượt thích: <span class="badge bg-orange">{{$object['bviet']->like}}</span>
                                    </label>
                                </div>
                                <div class="col-md-3">
                                    <label>
                                        Thời gian tạo: <span class="badge bg-gray">{{date('H:i:s | d/m/Y', strtotime($object['bviet']->created_at))}}</span>
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
<script>
    function deleteData(id) {
        if(confirm('Bạn có muốn xóa bài viết này?')) {
            var url = "{{route('user.baiviet.delete', ':id')}}";
            location.href = url.replace(":id", id);
        }
    }
</script>
@endsection