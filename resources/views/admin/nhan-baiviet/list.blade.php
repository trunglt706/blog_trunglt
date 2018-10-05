@extends('layouts.admin.main')
@section('content')
<div class="content-wrapper" style="min-height: 916px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            NHẬN BÀI VIẾT
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.index')}}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li class="active">Nhận bài viết</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><i class="fa fa-envelope-open"></i> Danh sách đăng ký nhận bài viết</h3>
                        <div class="box-tools">
                            <div class="input-group input-group-sm" style="width: 60px;">
                                <div class="input-group-btn">
                                    <a class="btn btn-default" href="{{route('admin.nhanbaiviet')}}" style="margin-right: 5px;"><i class="fa fa-refresh"></i> Refresh</a>
                                    <a class="btn btn-success" data-toggle="modal" data-target="#add-model"><i class="fa fa-plus"></i> Add</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        @include('admin.notify')
                        @if(isset($object['list_nhanbv']))
                        <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr class="bg-info">
                                                <th>Email</th>
                                                <th class="text-center" style="width: 120px;">Trạng thái</th>
                                                <th class="text-center" style="width: 120px;">Action</th>
                                            </tr>
                                        </thead>
                                        @foreach($object['list_nhanbv'] as $nhanbv)
                                        <tbody>
                                            <tr>
                                                <td>{{$nhanbv->email}}</td>
                                                <td class="text-center">
                                                    @if($nhanbv->status == 0)
                                                    <div class="label bg-gray">Chưa duyệt</div>
                                                    @else
                                                    <div class="label bg-green">Đã duyệt</div>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <a class="btn btn-danger btn-delete" onclick="deleteData('{{$nhanbv->id}}');" title="Xóa dữ liệu" data-toggle="tooltip" data-placement="top" href="javascript:;"><i class="fa fa-remove"></i></a>&nbsp;
                                                    <a class="btn btn-info" title="Cập nhật dữ liệu" data-toggle="tooltip" data-placement="bottom" href="{{route('admin.nhanbaiviet.chitiet', ['id' => $nhanbv->id])}}"><i class="fa fa-edit"></i></a>
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
                        {{ $object['list_nhanbv']->links() }}
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
            <form role="form" action="{{route('admin.nhanbaiviet.insert')}}" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title"><i class="fa fa-envelope-open"></i> Thêm đăng ký nhận bài viết mới</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Email *</label>
                        <input type="email" required name="email" class="form-control" placeholder="Nhập email ...">
                        @csrf
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
        if(confirm('Bạn có muốn xóa email đăng ký nhận bài viết này?')) {
            var url = "{{route('admin.nhanbaiviet.delete', ':id')}}";
            location.href = url.replace(":id", id);
        }
    }
</script>
@endsection