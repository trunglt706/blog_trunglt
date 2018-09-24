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
                            <h3 class="box-title">Danh sách thành viên</h3>
                            <div class="box-tools">
                                <div class="input-group input-group-sm" style="width: 60px;">
                                    <div class="input-group-btn">
                                        <a class="btn btn-default" href="{{route('admin.thanhvien')}}" style="margin-right: 5px;"><i class="fa fa-refresh"></i> Refresh</a>
                                        <a class="btn btn-success"><i class="fa fa-plus"></i> Add</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
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
                                                            <a class="btn btn-danger" title="Xóa dữ liệu" data-toggle="tooltip" data-placement="top" href="{{route('admin.thanhvien.delete', ['id' => $tvien->id])}}"><i class="fa fa-remove"></i></a>&nbsp;
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
@endsection