@extends('admin.layout.index')

@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Tin tuc
                        <small>Them</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
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
                    <form name="SlideForm" id="" action="admin/slide/them" method="POST"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Ten slide</label>
                            <input class="form-control" name="Ten" value="{{ old('Ten') }}"
                                   placeholder="Nhap Ten Slide"/>
                        </div>

                        <div class="form-group">
                            <label>Noi Dung</label>
                            <textarea name="NoiDung" class="form-control ckeditor" id="NoiDung" cols="30" rows="10">
                                {{ old('NoiDung') }}
                            </textarea>
                        </div>

                        <div class="form-group">
                            <label>Link</label>
                            <input class="form-control" name="Link" value="{{ old('Link') }}"
                                   placeholder="Nhap Link URL"/>
                        </div>

                        <div class="form-group">
                            <label for="">Hinh Anh</label>
                            <input type="file" name="Hinh" class="form-control">

                        </div>

                        <button type="submit" class="btn btn-default">Them tin tuc</button>
                        <button type="reset" id="configreset" class="btn btn-default">Lam moi</button>
                        <form>
                </div>
            </div>
            <!-- /.row -->
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->

@endsection
