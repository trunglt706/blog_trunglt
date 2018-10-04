@extends('layouts.admin.main')
@section('content')
<div class="content-wrapper" style="min-height: 916px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            CHI TIẾT BÀI VIẾT
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.index')}}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li><a href="{{route('admin.baiviet')}}">Danh mục bài viết</a></li>
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
                        <h3 class="box-title">Thông tin chi tiết</h3>
                        <div class="box-tools">
                            <div class="input-group input-group-sm" style="width: 60px;">
                                <div class="input-group-btn">
                                    <a class="btn btn-default" href="{{route('admin.baiviet.chitiet', ['id' => $object['bviet']->id])}}" style="margin-right: 5px;"><i class="fa fa-refresh"></i> Refresh</a>
                                    <a class="btn btn-default" href="{{route('admin.baiviet')}}"><i class="fa fa-arrow-left"></i> Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="col-md-12" style="margin-top: 10px;">@include('admin.notify')</div>
                    <!-- form start -->
                    <form role="form" action="{{route('admin.baiviet.update', ['id' => $object['bviet']->id])}}" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Tên bài viết *</label>
                                    <input type="text" required name="name" value="{{$object['bviet']->name}}" class="form-control" placeholder="Nhập tên ...">
                                    @csrf
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Đường dẫn * <small class="text-danger">(<a href="{{route('detail.baiviet', ['slug' => $object['bviet']->slug])}}" target="_blank">Xem bài viết</a>)</small></label>
                                    <input type="text" required name="slug" disabled="" value="{{$object['bviet']->slug}}" class="form-control" placeholder="Nhập tên ...">
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
                                <div class="form-group col-md-6">
                                    <label>Trạng thái *</label>
                                    <div class="col-12">
                                        <select name="status" class="form-control select2" required="">
                                            <option value="1" @if($object['bviet']->status == 1) selected @endif>Duyệt</option>
                                            <option value="0" @if($object['bviet']->status == 0) selected @endif>Không duyệt</option>
                                            <option value="-1" @if($object['bviet']->status == -1) selected @endif>Khóa</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Rating *</label>
                                    <input type="number" name="rating" value="{{$object['bviet']->rating}}" class="form-control" placeholder="Nhập rating ...">
                                </div>
                            </div>
                            <div class="row">
                                <div class="checkbox icheck col-md-2">
                                    <label>
                                        <input type="checkbox" name="important" @if($object['bviet']->important == 1) checked @endif> Tin quan trọng
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
                                <div class="col-md-3">
                                    <label>
                                        Người tạo: 
                                        <span class="badge bg-aqua">
                                            @php $bv_admin = App\admins::where('username', $object['bviet']->username)->first(); @endphp
                                            @if(!is_null($bv_admin))
                                            Admin - {{$bv_admin->name}}
                                            @else
                                            @php $bv_user = App\users::where('username', $object['bviet']->username)->first(); @endphp
                                            <a href="{{route('admin.thanhvien.chitiet', ['id' => $bv_user->id])}}" target="_blank">User - {{$bv_user->name}}</a>
                                            @endif
                                        </span>
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