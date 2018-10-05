@extends('layouts.admin.main')
@section('content')
<div class="content-wrapper" style="min-height: 916px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            BÀI VIẾT
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.index')}}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li class="active">Danh sách bài viết</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><i class="fa fa-newspaper-o"></i> Danh sách bài viết</h3>
                        <div class="box-tools">
                            <div class="input-group input-group-sm" style="width: 60px;">
                                <div class="input-group-btn">
                                    <a class="btn btn-default" href="{{route('admin.baiviet')}}" style="margin-right: 5px;"><i class="fa fa-refresh fa-spin"></i> Refresh</a>
                                    <a class="btn btn-success" data-toggle="modal" data-target="#add-model"><i class="fa fa-plus"></i> Add</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        @include('admin.notify')
                        @if(isset($object['listbv']))
                        <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr class="bg-info">
                                                <th class="text-center" style="max-width: 300px;">Tên bài viết</th>
                                                <th class="text-center hidden-xs">Username</th>
                                                <th class="text-center hidden-xs">Hình ảnh</th>
                                                <th class="text-center" style="width: 100px;">Lượt xem</th>
                                                <th class="text-center" style="width: 100px;">Lượt like</th>
                                                <th class="text-center" style="width: 100px;">Trạng thái</th>
                                                <th class="text-center" style="width: 120px;">Action</th>
                                            </tr>
                                        </thead>
                                        @foreach($object['listbv'] as $bviet)
                                        <tbody>
                                            <tr>
                                                <td>{{$bviet->name}}</td>
                                                <td class="hidden-xs">{{$bviet->username}}</td>
                                                <td class="hidden-xs text-center">
                                                    <a href="{{route('detail.baiviet', ['slug' => $bviet->slug])}}" target="_blank"><img src="{{url($bviet->thumn)}}" alt="{{$bviet->slug}}" width="100px"/></a>
                                                </td>
                                                <td class="text-center">{{$bviet->view}}</td>
                                                <td class="text-center">{{$bviet->like}}</td>
                                                <td class="text-center">
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
                            </div>
                        </div>
                        @endif
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        {{ $object['listbv']->links() }}
                    </div>
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!--Add new model-->
<div class="modal" id="add-model">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" action="{{route('admin.baiviet.insert')}}" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title"><i class="fa fa-newspaper-o"></i> Thêm bài viết mới</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tên bài viết *</label>
                        <input type="text" required name="name" class="form-control" placeholder="Nhập tên ...">
                        @csrf
                    </div>
                    <div class="form-group">
                        <label>Danh mục bài viết *</label>
                        <div class="col-12">
                            <select name="id_danhmuc" class="form-control select2" required="">
                                @foreach($object['list_danhmuc'] as $dmuc)
                                <option value="{{$dmuc->id}}">{{$dmuc->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Mô tả ngắn *</label>
                        <textarea name="intro" required="" class="form-control" placeholder="Nhập mô tả ..." rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Nội dung bài viết *</label>
                        <textarea name="content" id="ckeditor" required="" class="form-control ckeditor" placeholder="Nhập nội dung ..." rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Từ khóa <small class="text-danger">(Mỗi từ khóa ngăn cách nhau bởi dấu phẩy)</small></label>
                        <input type="text" name="keyword" class="form-control" placeholder="Nhập từ khóa ...">
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Trạng thái *</label>
                            <div class="col-12">
                                <select name="status" class="form-control select2" required="">
                                    <option value="1" selected="">Duyệt</option>
                                    <option value="0">Không duyệt</option>
                                    <option value="-1">Khóa</option>
                                </select>
                            </div>
                        </div>
                        <div class="checkbox icheck col-md-6">
                            <label>
                                <input type="checkbox" name="important"> Tin quan trọng
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="thumn">Ảnh hiển thị</label>
                                <input type="file" id="AvatarPerson" name="thumn">
                                <p class="help-block" style="color: red;">Nên sử dụng hình ảnh PNG, JPG kích thước 600 x 337px</p>
                            </div>
                            <div class="form-group col-sm-6">
                                <div id="image-holder" style="max-height: 160px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="background">Ảnh bìa</label>
                                <input type="file" id="Background" name="background">
                                <p class="help-block" style="color: red;">Nên sử dụng hình ảnh PNG, JPG kích thước 600 x 337px</p>
                            </div>
                            <div class="form-group col-sm-6">
                                <div id="image-holder-background" style="max-height: 160px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        <i class="fa fa-arrow-left"></i> Close
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i> Save
                    </button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!--End add new model-->
<script>
    function deleteData(id) {
        if(confirm('Bạn có muốn xóa bài viết này?')) {
            var url = "{{route('admin.baiviet.delete', ':id')}}";
            location.href = url.replace(":id", id);
        }
    }
</script>
@endsection