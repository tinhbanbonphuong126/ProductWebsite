@extends('admin.layouts.app-menu')

@section('title')
    利用者登録・編集
@endsection

@section('content')
    <div class="container" id="user-employee">
        <div class="form-border">
            
            <form action="{{ url('admin/user/edit') }}" method="post" data-toggle="validator" role="form" id="form">
                {{ csrf_field() }}
                <legend><span class="simsum" style="font-size: 25px">ID: {{$record->code}}</span></legend>

                <input type="hidden" class="form-control" name="id" value="{{$record->id}}">
                <input type="hidden" class="form-control" name="code" value="{{$record->code}}">
                <div class="form-group form-inline">
                    <span class="color-red">※</span>
                    <label for="">名前: </label>
                    <input type="text" class="form-control" name="name" value="{{$record->name}}">
                </div>
                <div class="form-group form-inline">
                    <span class="color-red note-hide">※</span>
                    <label for="">性別: </label>
                    <select name="gender" id="" class="select-sex form-control" value="{{$record->gender}}">
                        <option {{ $record->gender == 1 ? "selected" : ""}} value="1">男</option>
                        <option {{ $record->gender == 0 ? "selected" : ""}} value="0">女</option>
                    </select>
                </div>
                <div class="form-group form-inline">
                    <span class="color-red note-hide">※</span>
                    <label for="">生年月日: </label>
                    <input type="datetime" name="birth_date" id="datepicker" class="form-control" value="{{$record->birth_date}}"/>
                </div>
                <div class="form-group form-inline">
                    <span class="color-red">※</span>
                    <label for="">住所: </label>
                    <input type="text" class="form-control" name="address" value="{{$record->address}}">
                </div>
                <div class="form-group form-inline">
                    <span class="color-red">※</span>
                    <label for="">電話番号: </label>
                    <input type="text" class="form-control" name="tel" value="{{$record->tel}}"/>
                </div>
                <div class="form-group form-inline">
                    <span class="color-red" style="visibility: hidden;">※</span>
                    <label for="">メールアドレス: </label>
                    <input type="email" class="form-control" name="email" value="{{$record->email}}"/>
                </div>
                @include('admin.includes.errors')

                <div class="back-btn" style="padding-top: 20px; margin-left: 5px;">
                    <!-- Button back -->
                    <a href="{{ url('admin/user') }}" style="width: 70px;" class="btn btn-default">戻る</a>
                    <!--Button submit vs modal-->
                    <button type="button" id="btn-save" class="btn btn-success btn-sm" style="float: right;">保　存</button>
                </div>

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