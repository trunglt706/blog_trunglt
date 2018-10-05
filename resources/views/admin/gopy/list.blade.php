@extends('layouts.admin.main')
@section('content')
<div class="content-wrapper" style="min-height: 916px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            GÓP Ý
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.index')}}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li class="active">Góp ý</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><i class="fa fa-comment-o"></i> Danh sách góp ý</h3>
                        <div class="box-tools">
                            <div class="input-group input-group-sm" style="width: 60px;">
                                <div class="input-group-btn">
                                    <a class="btn btn-default" href="{{route('admin.gopy')}}" style="margin-right: 5px;"><i class="fa fa-refresh"></i> Refresh</a>
                                    <a class="btn btn-success" data-toggle="modal" data-target="#add-model"><i class="fa fa-plus"></i> Add</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        @include('admin.notify')
                        @if(isset($object['listgopy']))
                        <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr class="bg-info">
                                                <th style="width: 200px;">Email</th>
                                                <th class="text-center hidden-xs">Nội dung</th>
                                                <th class="text-center" style="width: 200px;">Thời gian</th>
                                                <th class="text-center" style="width: 120px;">Action</th>
                                            </tr>
                                        </thead>
                                        @foreach($object['listgopy'] as $gopy)
                                        <tbody>
                                            <tr>
                                                <td>{{$gopy->email}}</td>
                                                <td class="hidden-xs">{{$gopy->content}}</td>
                                                <td class="text-center">
                                                    {{date('H:i:s d/m/Y', strtotime($gopy->created_at))}}
                                                </td>
                                                <td class="text-center">
                                                    <a class="btn btn-danger btn-delete" onclick="deleteData('{{$gopy->id}}');" title="Xóa dữ liệu" data-toggle="tooltip" data-placement="top" href="javascript:;"><i class="fa fa-remove"></i></a>&nbsp;
                                                    <a class="btn btn-info" title="Cập nhật dữ liệu" data-toggle="tooltip" data-placement="bottom" href="{{route('admin.gopy.chitiet', ['id' => $gopy->id])}}"><i class="fa fa-edit"></i></a>
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
                        {{ $object['listgopy']->links() }}
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
            <form role="form" action="{{route('admin.gopy.insert')}}" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title"><i class="fa fa-comment-o"></i> Thêm góp ý mới</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Email *</label>
                        <input type="email" required name="email" class="form-control" placeholder="Nhập email ...">
                        @csrf
                    </div>
                    <div class="form-group">
                        <label>Nội dung *</label>
                        <textarea name="content" required="" class="form-control" placeholder="Nhập nội dung ..." rows="3"></textarea>
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
        if(confirm('Bạn có muốn xóa góp ý này?')) {
            var url = "{{route('admin.gopy.delete', ':id')}}";
            location.href = url.replace(":id", id);
        }
    }
</script>
@endsection