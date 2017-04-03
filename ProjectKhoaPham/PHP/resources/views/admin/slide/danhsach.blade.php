@extends('admin.layout.index')

@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Slide
                        <small>Danh sach</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                @if(session('thongbao'))
                    <div class="col-lg-12">
                        <div class="alert alert-success">
                            {{ session('thongbao') }}
                        </div>
                    </div>
                @endif
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Ten slide</th>
                        <th>Noi dung</th>
                        <th>Hinh</th>
                        <th>link</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($slide as $sl)
                        <tr class="odd gradeX" align="center">
                            <td>{{ $sl->id }}</td>
                            <td>{{ $sl->Ten }}</td>
                            <td>{{ $sl->NoiDung }}</td>
                            <td><img width="100" src="./uploads/slide/{{ $sl->Hinh }}" alt=""></td>
                            <td>{{ $sl->link }}</td>
                            <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/slide/xoa/{{ $sl->id }}"> Delete</a></td>
                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/slide/sua/{{ $sl->id }}">Edit</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@endsection
