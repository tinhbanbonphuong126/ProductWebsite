@extends('admin.layouts.app-menu')

@section('title')
    利用者登録・編集
@endsection

@section('content')
    
    <div class="container" id="user-employee">
        <div class="form-border">
            <form action="{{ url('admin/staff/edit') }}" method="post" data-toggle="validator" role="form" id="CreateEditEmployee">
                {{ csrf_field() }}
                <legend><span class="simsum" style="font-size: 25px">ID: {{$staff->code}}</span></legend>
                <input type="hidden" name="id" value="{{$staff->id}}">
                <input type="hidden" name="code" value="{{$staff->code}}">
                <div class="form-group form-inline">
                    <span class="color-red">※</span>
                    <label for="">名前: </label>
                    <input type="text" class="form-control" name="name" value="{{$staff->name}}">
                </div>
                <div class="form-group form-inline">
                    <span class="color-red">※</span>
                    <label for="">性別: </label>
                    <select name="gender" id="" class="select-sex form-control" value="{{$staff->gender}}">
                        <option {{ $staff->gender == 1 ? "selected" : ""}} value="1">男</option>
                        <option {{ $staff->gender == 0 ? "selected" : ""}} value="0">女</option>
                    </select>
                </div>
                <div class="form-group form-inline">
                    <span class="color-red">※</span>
                    <label for="">生年月日: </label>
                    <input type="datetime" name="birth_date" id="datepicker" class="form-control" value="{{$staff->birth_date}}"/>
                </div>
                <div class="form-group form-inline">
                    <span class="color-red">※</span>
                    <label for="">国籍: </label>
                    <input type="text" class="form-control" name="nationality" value="{{$staff->nationality}}"/>
                </div>
                <div class="form-group form-inline">
                    <span class="color-red">※</span>
                    <label for="">住所: </label>
                    <input type="text" class="form-control" name="address"  value="{{$staff->address}}">
                </div>
                <div class="form-group form-inline">
                    <span class="color-red">※</span>
                    <label for="">電話番号: </label>
                    <input type="text" class="form-control" name="tel" value="{{$staff->tel}}"/>
                </div>
                <div class="form-group form-inline">
                    <span class="color-red">※</span>
                    <label for="">メールアドレス: </label>
                    <input type="email" class="form-control" name="email" value="{{$staff->email}}"/>
                </div>
                <div class="form-group form-inline">
                    <span class="color-red">※</span>
                    <label for="">パスワード: </label>
                    <input type="password" class="form-control" name="password" value="{{$staff->password}}"/>
                </div>
                @include('admin.includes.errors')

                <div class="back-btn" style="padding-top: 20px; margin-left: 5px;">
                    <!-- Button back -->
                    <a href="{{ url('admin/staff') }}" style="width: 70px;" class="btn btn-default">戻る</a>
                    <!-- Button submit vs modal -->
                    <button type="button" id="btn-save" class="btn btn-success btn-sm" style="float: right;">保　存</button>
                </div>

                <!-- Modal -->
                @include('admin.modal.modal-confirm')
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $( function() {
            $( "#datepicker" ).datepicker({
                yearRange: "-100:+0",
                changeYear: true, //表示年の指定が可能
                changeMonth: true, //表示月の指定が可能
                dateFormat: 'yy年mm月dd日' //年-月-日(曜日)
            });
        });
        function confirm(e) {
            $("#myModal").modal('show');
        }
        function save(e) {
            $("#CreateEditEmployee").submit();
        }
        $(document).ready(function () {
            $("#btn-save").bind('click', confirm);
            $("#saveModal #btnSave").bind('click', save);
        });
    </script>
@endsection