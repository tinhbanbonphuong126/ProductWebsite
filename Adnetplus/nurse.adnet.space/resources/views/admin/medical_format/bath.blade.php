@extends('admin.layouts.app-menu')

@section('title')
    カルテフォーマット編集
@endsection

@section('content')
    <div class="container">
        <div id="main-record-format" class="form-border">
            <form action="{{ url('admin/medical-record-format/bath') }}" method="post" id="frmMedicalRecordFormat">
                {{ csrf_field() }}
                <h3 style="font-weight: bold;font-size: 28px;">入浴登録</h3>
                <div class="row vertical-align">
                    <div class="col-sm-10" style="font-size: 20px;"  id="medical-format">
                        <table class="table table-responsive">
                            <tr>
                                <th class="left-title"><div></div></th>
                                <th class="form-meal">
                                    <div class="row">
                                        <div class="col-sm-6 col-xs-12">
                                            <table class="table table-responsive" id="table-1">
                                                <tr>
                                                    <th colspan="2">
                                                        <label for="checkbox-1-1" class="relative">入浴
                                                            {!! generateCheckbox('body_bath') !!}
                                                            <label class="label-checkbox" for="checkbox-1-1"></label>
                                                        </label>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th>日本語</th>
                                                    <th>ベトナム語</th>
                                                </tr>
                                                {!! generateInputs('body_bath') !!}
                                                <tr>
                                                    <td colspan="2">
                                                        <button type="button" class="btn btn-success btn-add-more"
                                                                data-name="body_bath" style="width: 100%">
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
                                                        <label for="checkbox-1-2" class="relative">清拭
                                                            {!! generateCheckbox('wipe_people') !!}
                                                            <label class="label-checkbox" for="checkbox-1-2"></label>
                                                        </label>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th>日本語</th>
                                                    <th>ベトナム語</th>
                                                </tr>
                                                {!! generateInputs('wipe_people') !!}
                                                <tr>
                                                    <td colspan="2">
                                                        <button type="button" class="btn btn-success btn-add-more"
                                                                data-name="wipe_people" style="width: 100%">
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
                                <th class="left-title"><div></div></th>
                                <th class="form-meal">
                                    <div class="row">
                                        <div class="col-sm-6 col-xs-12">
                                            <table class="table table-responsive" id="table-3">
                                                <tr>
                                                    <th colspan="2">
                                                        <label for="checkbox-1-3" class="relative">拒否
                                                            {!! generateCheckbox('rejection') !!}
                                                            <label class="label-checkbox" for="checkbox-1-3"></label>
                                                        </label>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th>日本語</th>
                                                    <th>ベトナム語</th>
                                                </tr>
                                                {!! generateInputs('rejection') !!}
                                                <tr>
                                                    <td colspan="2">
                                                        <button type="button" class="btn btn-success btn-add-more"
                                                                data-name="rejection" style="width: 100%">
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
                                                        <label for="checkbox-1-4" class="relative">中止
                                                            {!! generateCheckbox('prohibition') !!}
                                                            <label class="label-checkbox" for="checkbox-1-4"></label>
                                                        </label>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th>日本語</th>
                                                    <th>ベトナム語</th>
                                                </tr>
                                                {!! generateInputs('prohibition') !!}
                                                <tr>
                                                    <td colspan="2">
                                                        <button type="button" class="btn btn-success btn-add-more"
                                                                data-name="prohibition" style="width: 100%">
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
                            <div>
                                <a href="{{ url('admin/medical-record-format/check') }}"><button class="btn btn-primary" type="button">次へ</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            @include('admin.includes.errors')
            <!--Back button-->
            <div class="back-btn" style="margin-top: -92px; margin-left: 20px; z-index: 10000; position: absolute;">
                <a href="{{ url('admin/medical-record-format/excretion') }}" style="width: 70px;" class="btn btn-default">戻る</a>
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