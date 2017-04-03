@extends('admin.layout.index')

@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Loai tin
                        <small>Danh sach loai tin</small>
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

            <!-- /.col-lg-12 -->
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Tieu de</th>
                        <th>Tom tat</th>
                        <th>The Loai</th>
                        <th>Loai tin</th>
                        <th>So luot xem</th>
                        <th>Noi bat</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tintuc as $tt)
                        <tr class="odd gradeX" align="center">
                            <td>{{ $tt->id }}</td>
                            <td>
                                <p>{{ $tt->TieuDe }}</p>
                                <img width="50px" src="uploads/tintuc/{{ $tt->Hinh }}" alt="">
                            </td>
                            <td>{!! $tt->TomTat !!}</td>
                            <td>{{ $tt->loaitin->theloai->Ten }}</td>
                            <td>{{ $tt->loaitin->Ten }}</td>
                            <td>{{ $tt->SoLuotXem }}</td>
                            <td>{{ $tt->NoiBat }}</td>
                            <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a
                                        href="admin/tintuc/xoa/{{ $tt->id }}"> Delete</a></td>
                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a
                                        href="admin/tintuc/sua/{{ $tt->id }}">Edit</a></td>
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
