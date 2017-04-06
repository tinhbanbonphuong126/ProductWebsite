@extends('layout.index')

@section('content')
    <!-- Page Content -->
    <div class="container">

        <!-- slider -->
        <div class="row carousel-holder">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">Đăng nhập</div>
                    <div class="panel-body">
                        @if(count($errors) > 0)
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $err )
                                    {{ $err }} <br/>
                                @endforeach
                            </div>
                        @endif

                        @if(session('thongbao'))
                            <div class="alert alert-warning">
                                {{ session('thongbao') }}
                            </div>
                        @endif
                        <form method="post" action="dangnhap">
                            {{ csrf_field() }}
                            @php
                            echo url()->previous() . '<br/> 1 </br>';
                            echo asset('') . 'dangnhap' . '<br/> 1 </br>';
                            echo session('previousUrl');
                            if(url()->previous() != asset('') . 'dangnhap')
                            {
                                session(['previousUrl' => url()->previous()]);
                            }
                            @endphp

                            <input type="hidden" name="previousUrl" value="{{ url()->previous() }}">
                            <div>
                                <label>Email</label>
                                <input type="email" class="form-control" placeholder="Email" name="email"
                                >
                            </div>
                            <br>
                            <div>
                                <label>Mật khẩu</label>
                                <input type="password" class="form-control" name="password">
                            </div>
                            <br>
                            <button type="submit" class="btn btn-default">Đăng nhập
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
        <!-- end slide -->
    </div>
    <!-- end Page Content -->
@endsection
