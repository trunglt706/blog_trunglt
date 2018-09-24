@extends('layouts.admin.main')
@section('content')
    <div class="content-wrapper" style="min-height: 916px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                DANH MỤC BÀI VIẾT
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{route('admin.index')}}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
                <li class="active">Danh mục bài viết</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Danh sách danh mục bài viết</h3>
                            <div class="box-tools">
                                <div class="input-group input-group-sm" style="width: 60px;">
                                    <div class="input-group-btn">
                                        <a class="btn btn-default" href="{{route('admin.danhmuc')}}" style="margin-right: 5px;"><i class="fa fa-refresh"></i> Refresh</a>
                                        <a class="btn btn-success"><i class="fa fa-plus"></i> Add</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            @if(isset($object['danhmuc']))
                                <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-bordered table-hover">
                                                <thead>
                                                <tr class="bg-info">
                                                    <th class="text-center">Tên danh mục</th>
                                                    <th class="text-center hidden-xs">Đường dẫn</th>
                                                    <th class="text-center hidden-xs">Mô tả</th>
                                                    <th class="text-center" style="width: 100px;">Trạng thái</th>
                                                    <th class="text-center" style="width: 120px;">Action</th>
                                                </tr>
                                                </thead>
                                                @foreach($object['danhmuc'] as $loaidm)
                                                    <tbody>
                                                    <tr>
                                                        <td>{{$loaidm->name}}</td>
                                                        <td class="hidden-xs">{{$loaidm->slug}}</td>
                                                        <td class="hidden-xs">{{substr($loaidm->intro, 0, 200)}} ...</td>
                                                        <td class="text-center">
                                                            @if($loaidm->status == 0)
                                                                <div class="label bg-gray">Chưa duyệt</div>
                                                            @else
                                                                <div class="label bg-green">Đã duyệt</div>
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            <a class="btn btn-danger" title="Xóa dữ liệu" data-toggle="tooltip" data-placement="top" href="{{route('admin.danhmuc.delete', ['id' => $loaidm->id])}}"><i class="fa fa-remove"></i></a>&nbsp;
                                                            <a class="btn btn-info" title="Cập nhật dữ liệu" data-toggle="tooltip" data-placement="bottom" href="{{route('admin.danhmuc.chitiet', ['id' => $loaidm->id])}}"><i class="fa fa-edit"></i></a>
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
                            {{ $object['danhmuc']->links() }}
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