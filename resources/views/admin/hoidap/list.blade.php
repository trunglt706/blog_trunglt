@extends('layouts.admin.main')
@section('content')
<div class="content-wrapper" style="min-height: 916px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            HỎI ĐÁP
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.index')}}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li class="active">Hỏi đáp</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><i class="fa fa-question-circle-o"></i> Danh sách hỏi đáp</h3>
                        <div class="box-tools">
                            <div class="input-group input-group-sm" style="width: 60px;">
                                <div class="input-group-btn">
                                    <a class="btn btn-default" href="{{route('admin.hoidap')}}" style="margin-right: 5px;"><i class="fa fa-refresh"></i> Refresh</a>
                                    <a class="btn btn-success" data-toggle="modal" data-target="#add-model"><i class="fa fa-plus"></i> Add</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        @include('admin.notify')
                        @if(isset($object['list_hoidap']))
                        <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr class="bg-info">
                                                <th style="width: 200px;">Tiêu đề</th>
                                                <th class="text-center hidden-xs">Nội dung</th>
                                                <th class="text-center" style="width: 100px;">Thứ tự</th>
                                                <th class="text-center" style="width: 120px;">Trạng thái</th>
                                                <th class="text-center" style="width: 120px;">Action</th>
                                            </tr>
                                        </thead>
                                        @foreach($object['list_hoidap'] as $hdap)
                                        <tbody>
                                            <tr>
                                                <td>{{$hdap->name}}</td>
                                                <td class="hidden-xs">{{substr($hdap->intro, 0, 300)}} ...</td>
                                                <td class="text-center">
                                                    {{$hdap->order}}
                                                </td>
                                                <td class="text-center">
                                                    @if($hdap->status == 0)
                                                    <div class="label bg-gray">Chưa duyệt</div>
                                                    @else
                                                    <div class="label bg-green">Đã duyệt</div>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <a class="btn btn-danger btn-delete" onclick="deleteData('{{$hdap->id}}');" title="Xóa dữ liệu" data-toggle="tooltip" data-placement="top" href="javascript:;"><i class="fa fa-remove"></i></a>&nbsp;
                                                    <a class="btn btn-info" title="Cập nhật dữ liệu" data-toggle="tooltip" data-placement="bottom" href="{{route('admin.hoidap.chitiet', ['id' => $hdap->id])}}"><i class="fa fa-edit"></i></a>
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
                        {{ $object['list_hoidap']->links() }}
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
            <form role="form" action="{{route('admin.hoidap.insert')}}" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title"><i class="fa fa-question-circle-o"></i> Thêm hỏi đáp mới</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tiêu đề *</label>
                        <input type="text" required name="name" class="form-control" placeholder="Nhập tiêu đề ...">
                        @csrf
                    </div>
                    <div class="form-group">
                        <label>Nội dung *</label>
                        <textarea name="intro" class="form-control" placeholder="Nhập nội dung ..." rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Thứ tự *</label>
                        <input type="number" required value="1" name="order" class="form-control" placeholder="Nhập thứ tự ...">
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
        if(confirm('Bạn có muốn xóa hỏi đáp này?')) {
            var url = "{{route('admin.hoidap.delete', ':id')}}";
            location.href = url.replace(":id", id);
        }
    }
</script>
@endsection