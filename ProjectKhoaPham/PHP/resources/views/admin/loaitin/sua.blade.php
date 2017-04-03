@extends('admin.layout.index')

@section('content')

    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Loai tin
                        <small>{{ $loaitin->Ten }}</small>
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
                    <form action="admin/loaitin/sua/{{$loaitin->id}}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>The Loai</label>
                            <select class="form-control" name="TheLoai">
                                @foreach ($theloai as $tl)
                                    <option value="{{$tl->id}}"
                                    @if($loaitin->idTheLoai == $tl->id)
                                        {{"selected"}}
                                    @endif>
                                        {{ $tl->Ten }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Ten Loai tin</label>
                            <input class="form-control" name="Ten" value="{{ $loaitin->Ten }}" placeholder="Nhap ten loai tin"/>
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

@section('edit-tintuc')
@endsection

@section('edit-user')
@endsection

@section('edit-theloai')
@endsection

@section('edit-slide')
@endsection

@section('edit-loaitin')
    <li style="display: none;">
        <a href="admin/loaitin/sua/{{ $loaitin->id }}">Them the loai</a>
    </li>
@endsection

