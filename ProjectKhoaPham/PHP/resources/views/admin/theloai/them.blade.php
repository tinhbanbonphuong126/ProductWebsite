@extends('admin.layout.index')

@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">The loai
                        <small>Them</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                    @if(count($errors))
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $err)
                                {{ $err }} <br>
                            @endforeach
                        </div>
                    @endif

                    @if(session('thongbao'))
                        <div class="alert alert-success">
                              {{session('thongbao')}}
                        </div>
                    @endif

                    <form action="admin/theloai/them" method="POST">
                        {{--<div class="form-group">--}}
                        {{--<label>Category Parent</label>--}}
                        {{--<select class="form-control">--}}
                        {{--<option value="0">Please Choose Category</option>--}}
                        {{--<option value="">Tin Tức</option>--}}
                        {{--</select>--}}
                        {{--</div>--}}

                        {{ csrf_field() }}

                        <div class="form-group">
                            <label>Ten the loai</label>
                            <input class="form-control" name="Ten" placeholder="Nhap ten the loai"/>
                        </div>

                        <button type="submit" class="btn btn-default">Category Add</button>
                        <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->

@endsection
