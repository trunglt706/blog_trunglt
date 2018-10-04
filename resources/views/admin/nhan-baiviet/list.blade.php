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
                            <h3 class="box-title">Danh sách đăng ký nhận bài viết</h3>
                            <div class="box-tools">
                                <div class="input-group input-group-sm" style="width: 60px;">
                                    <div class="input-group-btn">
                                        <a class="btn btn-default" href="{{route('admin.nhanbaiviet')}}" style="margin-right: 5px;"><i class="fa fa-refresh"></i> Refresh</a>
                                        <a class="btn btn-success"><i class="fa fa-plus"></i> Add</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
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
                                                            <a class="btn btn-danger" title="Xóa dữ liệu" data-toggle="tooltip" data-placement="top" href="{{route('admin.nhanbaiviet.delete', ['id' => $nhanbv->id])}}"><i class="fa fa-remove"></i></a>&nbsp;
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
@endsection