@extends('admin.layout.index')

@section('content')

    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">User
                        <small>{{ $user->name }}</small>
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
                    <form action="admin/user/sua/{{ $user->id }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Ho Ten</label>
                            <input class="form-control" name="name" value="{{ old('name')? old('name'): $user->name }}" placeholder="Nhap ten nguoi dung"/>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input style="cursor: text;" type="email" class="form-control" value="{{ old('email')? old('email'): $user->email }}" readonly name="email" placeholder="Nhap dia chi email"/>
                        </div>

                        <div class="form-group">
                            <input type="checkbox" name="changePassword" id="changePassword"> Doi mat khau <br>
                            <label>Password</label>
                            <input class="form-control password" name="password" type="password" placeholder="Nhap password" disabled/>
                        </div>

                        <div class="form-group">
                            <label>Password Confirm</label>
                            <input class="form-control password" name="passwordAgain" type="password"
                                   placeholder="Nhap lai password" disabled/>
                        </div>

                        <div class="form-group">
                            <label>Quyen nguoi dung</label> <br/>
                            <label class="radio-inline">
                                <input name="quyen" value="0" {{ old('quyen')==null? ($user->quyen? '': 'checked'): (old('quyen')? '': 'checked') }} type="radio">User Thuong
                            </label>
                            <label class="radio-inline">
                                <input name="quyen" value="1" {{ old('quyen')==null? ($user->quyen? 'checked': ''): (old('quyen')? 'checked': '') }} type="radio">Admin
                            </label>
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


@section('script')
    <script>
        $(document).ready(function () {
            $('#changePassword').change(function () {
                if ($(this).is(":checked"))
                {
                    $(".password").removeAttr('disabled');
                } else {
                    $(".password").attr('disabled', '');

                }
            })
        });
    </script>
@endsection






@section('edit-user')
    <li style="display: none;">
        <a href="admin/theloai/sua/{{ $user->id }}">Them the loai</a>
    </li>
@endsection


@section('edit-tintuc')
@endsection

@section('edit-theloai')
@endsection

@section('edit-slide')
@endsection

@section('edit-loaitin')
@endsection