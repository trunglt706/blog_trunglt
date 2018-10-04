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
                                    <a class="btn btn-default" href="{{route('admin.quangcao')}}" style="margin-right: 5px;"><i class="fa fa-refresh"></i> Refresh</a>
                                    <a class="btn btn-success"><i class="fa fa-plus"></i> Add</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        @if(isset($object['listqc']))
                        <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                        <tr class="bg-info">
                                            <th class="text-center">Tên quảng cáo</th>
                                            <th class="text-center hidden-xs" style="width: 160px;">Hình ảnh</th>
                                            <th class="text-center" style="width: 100px;">Thứ tự</th>
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
                                                <td class="text-center">{{$qcao->order}}</td>
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
                                                    <a class="btn btn-danger" title="Xóa dữ liệu" data-toggle="tooltip" data-placement="top" href="{{route('admin.quangcao.delete', ['id' => $qcao->id])}}"><i class="fa fa-remove"></i></a>&nbsp;
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
@endsection