@extends('layouts.admin.main')
@section('content')
<div class="content-wrapper" style="min-height: 916px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            CẤU HÌNH CHUNG
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.index')}}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li class="active">Cấu hình chung</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><i class="fa fa-cogs"></i> Danh sách cấu hình chung</h3>
                        <div class="box-tools">
                            <div class="input-group input-group-sm" style="width: 60px;">
                                <div class="input-group-btn">
                                    <a class="btn btn-default" href="{{route('admin.cauhinhchung')}}" style="margin-right: 5px;"><i class="fa fa-refresh fa-spin"></i> Refresh</a>
                                    <a class="btn btn-success" data-toggle="modal" data-target="#add-model"><i class="fa fa-plus"></i> Add</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        @include('admin.notify')
                        @if(isset($object['list_cauhinh']))
                        <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr class="bg-info">
                                                <th class="text-center">Tên</th>
                                                <th class="text-center">Mô tả</th>
                                                <th class="text-center">Giá trị</th>
                                                <th class="text-center" style="width: 120px;">Action</th>
                                            </tr>
                                        </thead>
                                        @foreach($object['list_cauhinh'] as $chinh)
                                        <tbody>
                                            <tr>
                                                <td>{{$chinh->name}}</td>
                                                <td>{{substr($chinh->intro, 0, 200)}}</td>
                                                <td>
                                                    @if($chinh->type != 'text')
                                                    <img src="{{url($chinh->value)}}" alt="{{$chinh->name}}"/>
                                                    @else
                                                    {{$chinh->value}}
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <a class="btn btn-danger btn-delete" onclick="deleteData('{{$chinh->id}}');" title="Xóa dữ liệu" data-toggle="tooltip" data-placement="top" href="javascript:;"><i class="fa fa-remove"></i></a>&nbsp;
                                                    <a class="btn btn-info" title="Cập nhật dữ liệu" data-toggle="tooltip" data-placement="bottom" href="{{route('admin.cauhinhchung.chitiet', ['id' => $chinh->id])}}"><i class="fa fa-edit"></i></a>
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
                        {{ $object['list_cauhinh']->links() }}
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
            <form role="form" action="{{route('admin.cauhinhchung.insert')}}" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title"><i class="fa fa-cogs"></i> Thêm cấu hình mới</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tên cấu hình *</label>
                        <input type="text" required name="name" class="form-control" placeholder="Nhập tên cấu hình ...">
                        @csrf
                    </div>
                    <div class="form-group">
                        <label>Loại cấu hình *</label>
                        <select required="" class="form-control type-cauhinh select2" name="type" onchange="changeTypeCauHinh(this);">
                            <option value="text" selected="">Text</option>
                            <option value="img">Hình ảnh</option>
                        </select>
                    </div>
                    <div class="form-group value-text">
                        <label>Giá trị*</label>
                        <input type="text" name="value_text" id="value-text-input" class="form-control" placeholder="Nhập giá trị ...">
                    </div>
                    <div class="form-group value-img hidden">
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="value">Giá trị *</label>
                                <input type="file" id="AvatarPerson" name="value_img" id="value-img-input">
                                <p class="help-block" style="color: red;">Nên sử dụng hình ảnh PNG, JPG kích thước 600 x 337px</p>
                            </div>
                            <div class="form-group col-sm-6">
                                <div id="image-holder" style="max-height: 160px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Mô tả *</label>
                        <textarea name="intro" required="" class="form-control" placeholder="Nhập mô tả ..." rows="3"></textarea>
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
//    Event delete cauhinh
    function deleteData(id) {
        if(confirm('Bạn có muốn xóa cấu hình này?')) {
            var url = "{{route('admin.cauhinhchung.delete', ':id')}}";
            location.href = url.replace(":id", id);
        }
    }
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