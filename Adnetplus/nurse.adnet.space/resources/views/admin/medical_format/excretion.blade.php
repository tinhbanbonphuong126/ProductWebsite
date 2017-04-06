@extends('admin.layouts.app-menu')

@section('title')
    カルテフォーマット編集
@endsection

@section('content')
    <div class="container">
        <div id="main-record-format" class="form-border">
            <form action="{{ url('admin/medical-record-format/excretion') }}" method="post" id="frmMedicalRecordFormat">
                {{ csrf_field() }}
                <h3 style="font-weight: bold;font-size: 28px;">排泄登録</h3>
                <div class="row vertical-align">
                    <div class="col-sm-10" style="font-size: 20px;"  id="medical-format">
                        <table class="table table-responsive">
                            <tr>
                                <th class="left-title"><div>朝</div></th>
                                <th class="form-meal">
                                    <div class="row">
                                        <div class="col-sm-6 col-xs-12">
                                            <table class="table table-responsive" id="table-1">
                                                <tr>
                                                    <th colspan="2">
                                                        <label for="checkbox-1-1" class="relative">尿
                                                            {!! generateCheckbox('excretion_morning_flight') !!}
                                                            <label class="label-checkbox" for="checkbox-1-1"></label>
                                                        </label>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th>日本語</th>
                                                    <th>ベトナム語</th>
                                                </tr>
                                                {!! generateInputs('excretion_morning_flight') !!}
                                                <tr>
                                                    <td colspan="2">
                                                        <button type="button" class="btn btn-success btn-add-more"
                                                                data-name="excretion_morning_flight" style="width: 100%">
                                                            <span class="glyphicon glyphicon-plus"></span>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-sm-6 col-xs-12">
                                            <table class="table table-responsive" id="table-2">
                                                <tr>
                                                    <th colspan="2">
                                                        <label for="checkbox-1-2" class="relative">便
                                                            {!! generateCheckbox('excretion_morning_urine') !!}
                                                            <label class="label-checkbox" for="checkbox-1-2"></label>
                                                        </label>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th>日本語</th>
                                                    <th>ベトナム語</th>
                                                </tr>
                                                {!! generateInputs('excretion_morning_urine') !!}
                                                <tr>
                                                    <td colspan="2">
                                                        <button type="button" class="btn btn-success btn-add-more"
                                                                data-name="excretion_morning_urine" style="width: 100%">
                                                            <span class="glyphicon glyphicon-plus"></span>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </th>
                            </tr>
                            <tr>
                                <th class="left-title"><div>昼</div></th>
                                <th class="form-meal">
                                    <div class="row">
                                        <div class="col-sm-6 col-xs-12">
                                            <table class="table table-responsive" id="table-3">
                                                <tr>
                                                    <th colspan="2">
                                                        <label for="checkbox-1-3" class="relative">尿
                                                            {!! generateCheckbox('excretion_afternoon_flight') !!}
                                                            <label class="label-checkbox" for="checkbox-1-3"></label>
                                                        </label>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th>日本語</th>
                                                    <th>ベトナム語</th>
                                                </tr>
                                                {!! generateInputs('excretion_afternoon_flight') !!}
                                                <tr>
                                                    <td colspan="2">
                                                        <button type="button" class="btn btn-success btn-add-more"
                                                                data-name="excretion_afternoon_flight" style="width: 100%">
                                                            <span class="glyphicon glyphicon-plus"></span>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-sm-6 col-xs-12">
                                            <table class="table table-responsive" id="table-4">
                                                <tr>
                                                    <th colspan="2">
                                                        <label for="checkbox-1-4" class="relative">便
                                                            {!! generateCheckbox('excretion_afternoon_urine') !!}
                                                            <label class="label-checkbox" for="checkbox-1-4"></label>
                                                        </label>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th>日本語</th>
                                                    <th>ベトナム語</th>
                                                </tr>
                                                {!! generateInputs('excretion_afternoon_urine') !!}
                                                <tr>
                                                    <td colspan="2">
                                                        <button type="button" class="btn btn-success btn-add-more"
                                                                data-name="excretion_afternoon_urine" style="width: 100%">
                                                            <span class="glyphicon glyphicon-plus"></span>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </th>
                            </tr>
                            <tr>
                                <th class="left-title"><div>夜</div></th>
                                <th class="form-meal">
                                    <div class="row">
                                        <div class="col-sm-6 col-xs-12">
                                            <table class="table table-responsive" id="table-5">
                                                <tr>
                                                    <th colspan="2">
                                                        <label for="checkbox-1-5" class="relative">尿
                                                            {!! generateCheckbox('excretion_night_flight') !!}
                                                            <label class="label-checkbox" for="checkbox-1-5"></label>
                                                        </label>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th>日本語</th>
                                                    <th>ベトナム語</th>
                                                </tr>
                                                {!! generateInputs('excretion_night_flight') !!}
                                                <tr>
                                                    <td colspan="2">
                                                        <button type="button" class="btn btn-success btn-add-more"
                                                                data-name="excretion_night_flight" style="width: 100%">
                                                            <span class="glyphicon glyphicon-plus"></span>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-sm-6 col-xs-12">
                                            <table class="table table-responsive" id="table-6">
                                                <tr>
                                                    <th colspan="2">
                                                        <label for="checkbox-1-6" class="relative">便
                                                            {!! generateCheckbox('excretion_night_urine') !!}
                                                            <label class="label-checkbox" for="checkbox-1-6"></label>
                                                        </label>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th>日本語</th>
                                                    <th>ベトナム語</th>
                                                </tr>
                                                {!! generateInputs('excretion_night_urine') !!}
                                                <tr>
                                                    <td colspan="2">
                                                        <button type="button" class="btn btn-success btn-add-more"
                                                                data-name="excretion_night_urine" style="width: 100%">
                                                            <span class="glyphicon glyphicon-plus"></span>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </th>
                            </tr>
                        </table>
                    </div>
                    <div class="col-sm-2">
                        <div class="btn-responsive btn-media" id="btn-save-edit">
                            <button type="button" class="btn btn-primary btn-save">保存</button>
                            @include('admin.modal.save')
                            <div class="clear-fix-10"></div>
                            <div><a href="{{ url('admin/medical-record-format/bath') }}" class="btn btn-primary">次へ</a></div>
                        </div>
                    </div>
                </div>
            </form>
            @include('admin.includes.errors')
            <!--Back button-->
            <div class="back-btn" style="margin-top: -92px; margin-left: 20px; z-index: 10000; position: absolute;">
                <a href="{{ url('admin/medical-record-format/meal') }}" style="width: 70px;" class="btn btn-default">戻る</a>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        function confirm(e) {
            $("#saveModal").modal('show');
        }
        function save(e) {
            $("#frmMedicalRecordFormat").submit();
        }
        function add(btn, field) {
            var tr = $("<tr></tr>");
            var inputJa = '<td><input class="form-control" type="text" name="' + field + '_ja[]"/></td>';
            var inputVn = '<td><input class="form-control" type="text" name="' + field + '_vn[]"/></td>';
            tr.append(inputJa);
            tr.append(inputVn);
            $(btn).parent().parent().before(tr);
        }
        $(document).ready(function () {
            $(".btn-save").bind('click', confirm);
            $("#saveModal #btnSave").bind('click', save);
            $(".btn-add-more").bind('click', function () { add(this, $(this).data('name'))});
        });
    </script>
@endsection