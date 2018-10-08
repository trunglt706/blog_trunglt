@extends('layouts.admin.main')
@section('content')
<div class="content-wrapper" style="min-height: 916px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            LOẠI THÀNH VIÊN
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.index')}}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li class="active">Loại thành viên</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><i class="fa fa-address-card"></i> Danh sách loại thành viên</h3>
                        <div class="box-tools">
                            <div class="input-group input-group-sm" style="width: 60px;">
                                <div class="input-group-btn">
                                    <a class="btn btn-default hidden-xs" href="{{route('admin.loaithanhvien')}}" style="margin-right: 5px;"><i class="fa fa-refresh fa-spin"></i> Refresh</a>
                                    <a class="btn btn-success" data-toggle="modal" data-target="#add-model"><i class="fa fa-plus"></i> Add</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        @include('admin.notify')
                        @if(isset($object['loaitv']))
                        <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                        <tr class="bg-info">
                                            <th class="text-center">Tên loại</th>
                                            <th class="text-center hidden-xs">Đường dẫn</th>
                                            <th class="text-center hidden-xs">Mô tả</th>
                                            <th class="text-center" style="width: 100px;">Số điểm</th>
                                            <th class="text-center hidden-xs" style="width: 100px;">Trạng thái</th>
                                            <th class="text-center" style="width: 120px;">Action</th>
                                        </tr>
                                        </thead>
                                        @foreach($object['loaitv'] as $loaitv)
                                            <tbody>
                                            <tr>
                                                <td>{{$loaitv->name}}</td>
                                                <td class="hidden-xs">{{$loaitv->slug}}</td>
                                                <td class="hidden-xs">{{substr($loaitv->intro, 0, 200)}} ...</td>
                                                <td class="text-center">{{$loaitv->mark}}</td>
                                                <td class="text-center hidden-xs">
                                                    @if($loaitv->status == 0)
                                                        <div class="label bg-gray">Chưa duyệt</div>
                                                    @else
                                                        <div class="label bg-green">Đã duyệt</div>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <a class="btn btn-danger btn-delete" onclick="deleteData('{{$loaitv->id}}');" title="Xóa dữ liệu" data-toggle="tooltip" data-placement="top" href="javascript:;"><i class="fa fa-remove"></i></a>&nbsp;
                                                    <a class="btn btn-info btn-edit" title="Cập nhật dữ liệu" data-toggle="tooltip" data-placement="bottom" href="{{route('admin.loaithanhvien.chitiet', ['id' => $loaitv->id])}}"><i class="fa fa-edit"></i></a>
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
                        {{ $object['loaitv']->links() }}
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
            <form role="form" action="{{route('admin.loaithanhvien.insert')}}" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title"><i class="fa fa-address-card"></i> Thêm loại thành viên mới</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tên loại *</label>
                        <input type="text" required name="name" class="form-control" placeholder="Nhập tên ...">
                        @csrf
                    </div>
                    <div class="form-group">
                        <label>Mô tả</label>
                        <textarea name="intro" class="form-control" placeholder="Nhập mô tả ..." rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Số điểm *</label>
                        <input type="number" required value="0" name="mark" class="form-control" placeholder="Nhập điểm ...">
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-2">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="status" value="1" checked="checked">
                                        Duyệt
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="status" value="0">
                                        Không duyệt
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="logo">Ảnh hiển thị</label>
                                <input type="file" id="AvatarPerson" name="logo">
                                <p class="help-block" style="color: red;">Nên sử dụng hình ảnh PNG, JPG kích thước 600 x 337px</p>
                            </div>
                            <div class="form-group col-sm-6">
                                <div id="image-holder" style="max-height: 160px;"></div>
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
        if(confirm('Bạn có muốn xóa loại thành viên này?')) {
            var url = "{{route('admin.loaithanhvien.delete', ':id')}}";
            location.href = url.replace(":id", id);
        }
    }
</script>
@endsection