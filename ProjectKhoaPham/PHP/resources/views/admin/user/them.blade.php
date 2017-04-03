@extends('admin.layout.index')

@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">User
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
                    <form action="admin/user/them" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Ho Ten</label>
                            <input class="form-control" name="name" placeholder="Nhap ten nguoi dung"/>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Nhap dia chi email"/>
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input class="form-control" name="password"  type="password" placeholder="Nhap password"/>
                        </div>

                        <div class="form-group">
                            <label>Password Confirm</label>
                            <input class="form-control" name="passwordAgain" type="password" placeholder="Nhap lai password"/>
                        </div>

                        <div class="form-group">
                            <label>Quyen nguoi dung</label> <br>
                            <label class="radio-inline">
                                <input name="quyen" value="0" checked type="radio">User Thuong
                            </label>
                            <label class="radio-inline">
                                <input name="quyen" value="1" type="radio">Admin
                            </label>
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
