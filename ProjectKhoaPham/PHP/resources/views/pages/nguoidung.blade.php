@extends('layout.index')

@section('content')
    <!-- Page Content -->
    <div class="container">

        <!-- slider -->
        <div class="row carousel-holder">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Thông tin tài khoản</div>
                    <div class="panel-body">
                        @if(Auth::check())
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
                            <form action="nguoidung" method="post">
                                {{ csrf_field() }}
                                <div>
                                    <label>Họ tên</label>
                                    <input type="text" class="form-control" placeholder="Username" name="name"
                                           aria-describedby="basic-addon1"
                                           value="{{ Auth::user()->name }}">
                                </div>
                                <br>
                                <div>
                                    <label>Email</label>
                                    <input type="email" class="form-control" placeholder="Email" name="email"
                                           aria-describedby="basic-addon1"
                                           readonly value="{{ Auth::user()->email }}"
                                    >
                                </div>
                                <br>
                                <div class="form-group">
                                    <input type="checkbox" name="changePassword" id="changePassword"> Doi mat khau <br>
                                    <label>Password</label>
                                    <input class="form-control password" name="password" type="password"
                                           placeholder="Nhap password" disabled/>
                                </div>

                                <div class="form-group">
                                    <label>Password Confirm</label>
                                    <input class="form-control password" name="passwordAgain" type="password"
                                           placeholder="Nhap lai password" disabled/>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-default">Sửa
                                </button>

                            </form>

                            @else
                            <p>Vui long <a href="dangnhap"><b>dang nhap</b></a></p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-2">
            </div>
        </div>
        <!-- end slide -->
    </div>
    <!-- end Page Content -->
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $('#changePassword').change(function () {
                if ($(this).is(":checked")) {
                    $(".password").removeAttr('disabled');
                } else {
                    $(".password").attr('disabled', '');

                }
            })
        });
    </script>
@endsection


