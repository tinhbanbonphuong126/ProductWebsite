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
                    <form name="TinTucForm" id="configform" action="admin/tintuc/them" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>The loai</label>
                            <select class="form-control" id="TheLoai" name="TheLoai">
                                <option id="TheLoaiReset" value="">--</option>
                                @foreach ($theloai as $tl)
                                    <option {{ old('TheLoai') == $tl->id ? 'selected': '' }} value="{{ $tl->id  }}">{{ $tl->Ten }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Loai tin</label>
                            <select class="form-control" id="LoaiTin" name="LoaiTin">
                                <option id="LoaiTinReset" value="">--</option>
                                @foreach ($loaitin as $lt)
                                    <option {{ old('LoaiTin') == $lt->id ? 'selected': '' }} value="{{ $lt->id  }}">{{ $lt->Ten }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Tieu de</label>
                            <input class="form-control" name="TieuDe" value="{{ old('TieuDe') }}" placeholder="Nhap Tieu De"/>
                        </div>

                        <div class="form-group">
                            <label>Tom tat</label>
                            <textarea name="TomTat" class="form-control ckeditor" id="TomTat" cols="30" rows="10">
                                {{ old('TomTat') }}
                            </textarea>
                        </div>

                        <div class="form-group">
                            <label>Noi Dung</label>
                            <textarea name="NoiDung" class="form-control ckeditor" id="NoiDung" cols="30" rows="10">
                                {{ old('NoiDung') }}
                            </textarea>
                        </div>

                        <div class="form-group">
                            <label for="">Hinh Anh</label>
                            <input type="file" name="Hinh" class="form-control">

                        </div>

                        <div class="form-group">
                            <label>Noi Bat</label>
                            <label class="radio-inline">
                                <input name="NoiBat" value="1" checked="" type="radio">Khong
                            </label>
                            <label class="radio-inline">
                                <input name="NoiBat" value="2" type="radio">Co
                            </label>
                        </div>

                        <button type="submit" class="btn btn-default">Them tin tuc</button>
                        <button type="reset" id="configreset" class="btn btn-default">Lam moi</button>
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
    <script type="text/javascript">
        $(document).ready(function () {
            var TheLoaiReset = ($('#TheLoai').html()).replace('selected', '');
            var LoaiTinReset = ($('#LoaiTin').html()).replace('selected', '');

            $('#configreset').on('click', function () {
                $('#TheLoai').html(TheLoaiReset);
                $('#LoaiTin').html(LoaiTinReset);
                CKEDITOR.instances["TomTat"].setData('');
                CKEDITOR.instances["NoiDung"].setData('');

            })

            $('#TheLoai').change(function () {
                var idTheLoai = $(this).val();

                $.get('admin/ajax/loaitin/' + idTheLoai, function (data) {
                    $('#LoaiTin').html(data);
                })
            })

            $('#LoaiTin').change(function () {
                var idLoaiTin = $(this).val();

                $.get('admin/ajax/theloai/' + idLoaiTin, function (data) {
                    $('#TheLoai').html(data);
                })
            })
        });
    </script>
@endsection

