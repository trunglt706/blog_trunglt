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
                            <h3 class="box-title">Danh sách cấu hình chung</h3>
                            <div class="box-tools">
                                <div class="input-group input-group-sm" style="width: 60px;">
                                    <div class="input-group-btn">
                                        <a class="btn btn-default" href="{{route('admin.cauhinhchung')}}" style="margin-right: 5px;"><i class="fa fa-refresh"></i> Refresh</a>
                                        <a class="btn btn-success"><i class="fa fa-plus"></i> Add</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
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
                                                            <a class="btn btn-danger" title="Xóa dữ liệu" data-toggle="tooltip" data-placement="top" href="{{route('admin.cauhinhchung.delete', ['id' => $chinh->id])}}"><i class="fa fa-remove"></i></a>&nbsp;
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
@endsection