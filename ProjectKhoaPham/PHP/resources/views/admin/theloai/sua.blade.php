@extends('admin.layout.index')

@section('content')

    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">The loai
                        <small>{{ $theloai->Ten }}</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                    @if(count($errors) > 0)
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $err )
                                {{ $err }} <br/>
                            @endforeach
                        </div>
                    @endif

                    @if(session('thongbao'))
                        <div class="alert alert-success">
                            {{ session('thongbao') }}
                        </div>
                    @endif
                    <form action="admin/theloai/sua/{{$theloai->id}}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Ten the loai</label>
                            <input class="form-control" name="Ten" value="{{ $theloai->Ten }}"
                                   placeholder="Dien ten the loai"/>
                        </div>
                        <button type="submit" class="btn btn-default">Sua</button>
                        <button type="reset" class="btn btn-default">Lam moi</button>
                    <form>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@endsection


@section('edit-theloai')
    <li style="display: none;">
        <a href="admin/theloai/sua/{{ $theloai->id }}">Them the loai</a>
    </li>
@endsection

@section('edit-tintuc')
@endsection

@section('edit-user')
@endsection

@section('edit-slide')
@endsection

@section('edit-loaitin')
@endsection