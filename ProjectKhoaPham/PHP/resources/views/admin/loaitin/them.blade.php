@extends('admin.layout.index')

@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Loai tin
                        <small>Them</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                @if(count($errors))
                    <div class="col-lg-12">
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $err)
                                {{ $err }} <br>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(session('thongbao'))
                    <div class="col-lg-12">
                        <div class="alert alert-success">
                            {{session('thongbao')}}
                        </div>
                    </div>
                @endif

                <div class="col-lg-7" style="padding-bottom:120px">
                    <form action="admin/loaitin/them" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>The loai</label>
                            <select class="form-control" name="TheLoai">
                                <option value="">Chon the loai</option>
                                @foreach ($theloai as $tl)
                                    <option value="{{$tl->id}}">
                                        {{$tl->Ten}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Ten loai tin</label>
                            <input class="form-control" name="Ten" placeholder="Vui long nhap loai tin"/>
                        </div>

                        <button type="submit" class="btn btn-default">Them</button>
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
