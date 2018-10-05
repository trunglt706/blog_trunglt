@extends('layouts.admin.main')
@section('content')
<div class="content-wrapper" style="min-height: 916px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            THÀNH VIÊN
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.index')}}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li class="active">Thành viên</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><i class="fa fa-user-circle"></i> Danh sách thành viên</h3>
                        <div class="box-tools">
                            <div class="input-group input-group-sm" style="width: 60px;">
                                <div class="input-group-btn">
                                    <a class="btn btn-default" href="{{route('admin.thanhvien')}}" style="margin-right: 5px;"><i class="fa fa-refresh"></i> Refresh</a>
                                    <a class="btn btn-success" data-toggle="modal" data-target="#add-model"><i class="fa fa-plus"></i> Add</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        @include('admin.notify')
                        @if(isset($object['thanhvien']))
                        <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr class="bg-info">
                                                <th class="text-center">Tên thành viên</th>
                                                <th class="text-center hidden-xs">Loại thành viên</th>
                                                <th class="text-center hidden-xs">Avatar</th>
                                                <th class="text-center hidden-xs">Email</th>
                                                <th class="text-center" style="width: 100px;">Online</th>
                                                <th class="text-center" style="width: 100px;">Trạng thái</th>
                                                <th class="text-center" style="width: 120px;">Action</th>
                                            </tr>
                                        </thead>
                                        @foreach($object['thanhvien'] as $tvien)
                                        <tbody>
                                            <tr>
                                                <td>{{$tvien->name}}</td>
                                                <td class="hidden-xs">{{\App\loaithanhviens::find($tvien->id_loaithanhvien)->name}}</td>
                                                <td class="hidden-xs">
                                                    <a href="{{route('admin.thanhvien.chitiet', ['id' => $tvien->id])}}">
                                                        <img src="{{url($tvien->avatar)}}" alt="{{$tvien->username}}" style="width: 100px;"/>
                                                    </a>
                                                </td>
                                                <td class="hidden-xs">{{$tvien->email}}</td>
                                                <td class="text-center">
                                                    @if($tvien->online == 0)
                                                    <div class="label bg-gray">Offline</div>
                                                    @else
                                                    <div class="label bg-green">Online</div>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if($tvien->status == 0)
                                                    <div class="label bg-gray">Chưa duyệt</div>
                                                    @elseif($tvien->status == 1)
                                                    <div class="label bg-green">Đã duyệt</div>
                                                    @else
                                                    <div class="label bg-red">Bị khóa</div>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <a class="btn btn-danger btn-delete" onclick="deleteData('{{$tvien->id}}');" title="Xóa dữ liệu" data-toggle="tooltip" data-placement="top" href="javascript:;"><i class="fa fa-remove"></i></a>&nbsp;
                                                    <a class="btn btn-info" title="Cập nhật dữ liệu" data-toggle="tooltip" data-placement="bottom" href="{{route('admin.thanhvien.chitiet', ['id' => $tvien->id])}}"><i class="fa fa-edit"></i></a>
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
                        {{ $object['thanhvien']->links() }}
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
            <form role="form" action="{{route('admin.thanhvien.insert')}}" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title"><i class="fa fa-user-circle"></i> Thêm thành viên mới</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tên thành viên *</label>
                        <input type="text" required name="name" class="form-control" placeholder="Nhập tên ...">
                        @csrf
                    </div>
                    <div class="form-group">
                        <label>Loại thành viên *</label>
                        <div class="col-12">
                            <select name="id_loaithanhvien" class="form-control select2" required="">
                                @foreach($object['loai_tvien'] as $loai)
                                <option value="{{$loai->id}}">{{$loai->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Email *</label>
                        <input type="email" required name="email" class="form-control" placeholder="Nhập email ...">
                    </div>
                    <div class="form-group">
                        <label>Mật khẩu *</label>
                        <input type="password" required name="password" class="form-control" placeholder="Nhập mật khẩu ...">
                    </div>
                    <div class="form-group">
                        <label>Mô tả *</label>
                        <textarea name="intro" required="" class="form-control" placeholder="Nhập mô tả ..." rows="3"></textarea>
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
                            <label class="pull-right">
                                <input type="checkbox" name="online"> Online
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="avatar">Avatar</label>
                                <input type="file" id="AvatarPerson" name="avatar">
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
        if(confirm('Bạn có muốn xóa thành viên này?')) {
            var url = "{{route('admin.thanhvien.delete', ':id')}}";
            location.href = url.replace(":id", id);
        }
    }
</script>
@endsection