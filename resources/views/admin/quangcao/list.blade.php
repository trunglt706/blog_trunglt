@extends('layouts.admin.main')
@section('content')
<div class="content-wrapper" style="min-height: 916px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            QUẢNG CÁO
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.index')}}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li class="active">Quảng cáo</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Danh sách quảng cáo</h3>
                        <div class="box-tools">
                            <div class="input-group input-group-sm" style="width: 60px;">
                                <div class="input-group-btn">
                                    <a class="btn btn-default" href="{{route('admin.quangcao')}}" style="margin-right: 5px;"><i class="fa fa-refresh fa-spin"></i> Refresh</a>
                                    <a class="btn btn-success" data-toggle="modal" data-target="#add-model"><i class="fa fa-plus"></i> Add</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        @include('admin.notify')
                        @if(isset($object['listqc']))
                        <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr class="bg-info">
                                                <th class="text-center">Tên quảng cáo</th>
                                                <th class="text-center hidden-xs" style="width: 160px;">Hình ảnh</th>
                                                <th class="text-center hidden-xs" style="width: 100px;">Thứ tự</th>
                                                <th class="text-center" style="width: 100px;">Trạng thái</th>
                                                <th class="text-center" style="width: 120px;">Action</th>
                                            </tr>
                                        </thead>
                                        @foreach($object['listqc'] as $qcao)
                                        <tbody>
                                            <tr>
                                                <td>{{$qcao->name}}</td>
                                                <td class="hidden-xs text-center">
                                                    <a href="{{$qcao->link}}" target="_blank">
                                                        <img src="{{url($qcao->photo)}}" alt="{{$qcao->name}}" width="150px"/>
                                                    </a>
                                                </td>
                                                <td class="text-center hidden-xs">{{$qcao->order}}</td>
                                                <td class="text-center">
                                                    @if($qcao->status == 0)
                                                    <div class="label bg-gray">Chưa duyệt</div>
                                                    @elseif($qcao->status == 1)
                                                    <div class="label bg-green">Đã duyệt</div>
                                                    @else
                                                    <div class="label bg-red">Bị khóa</div>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <a class="btn btn-danger btn-delete" onclick="deleteData('{{$qcao->id}}');" title="Xóa dữ liệu" data-toggle="tooltip" data-placement="top" href="javascript:;"><i class="fa fa-remove"></i></a>&nbsp;
                                                    <a class="btn btn-info" title="Cập nhật dữ liệu" data-toggle="tooltip" data-placement="bottom" href="{{route('admin.quangcao.chitiet', ['id' => $qcao->id])}}"><i class="fa fa-edit"></i></a>
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
                        {{ $object['listqc']->links() }}
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
            <form role="form" action="{{route('admin.quangcao.insert')}}" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Thêm quảng cáo mới</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tiêu đề *</label>
                        <input type="text" required name="name" class="form-control" placeholder="Nhập tiêu đề ...">
                        @csrf
                    </div>
                    <div class="form-group">
                        <label>Liên kết</label>
                        <input type="text" name="link" class="form-control" placeholder="Nhập url ...">
                    </div>
                    <div class="form-group">
                        <label>Nội dung *</label>
                        <textarea name="intro" required="" class="form-control" placeholder="Nhập nội dung ..." rows="3"></textarea>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Thứ tự</label>
                            <input type="number" name="order" class="form-control" value="1" required="">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Trạng thái *</label>
                            <div class="col-12">
                                <select name="status" class="form-control select2" required="">
                                    <option value="1" selected="">Duyệt</option>
                                    <option value="0">Không duyệt</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="photo">Ảnh hiển thị</label>
                                <input type="file" id="AvatarPerson" name="photo">
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
        if(confirm('Bạn có muốn xóa quảng cáo này?')) {
            var url = "{{route('admin.quangcao.delete', ':id')}}";
            location.href = url.replace(":id", id);
        }
    }
</script>
@endsection