@extends('admin.layouts.app-detail')

@section('title')
    カルテ新規登録
@endsection

@section('content')
    <div class="row form-border" id="medical-form">
        <form action="{{ url('admin/medical-record/add/' . $user->id) }}" method="post" role="form" class="vertical-align" id="frmMedicalRecord">
            {{ csrf_field() }}
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            <div class="col-sm-11 col-xs-11">
                <div class="main-medical-register table-responsive">
                    <table class="table no-border-table">
                        <tr>
                            <th>朝</th>
                            <th id="width-th">
                                <span class="color-red">※</span>血圧 <br/>
                                <div class="u-row">
                                    <div class="u-col-sm-6 u-col-sm-12">
                                        <input type="text" name="morning_blood_pressure_high" value="{{ old('morning_blood_pressure_high') }}" class="form-control"/>
                                    </div>
                                    <div class="u-col-sm-6 u-col-sm-12">
                                        <input type="text" name="morning_blood_pressure_low" value="{{ old('morning_blood_pressure_low') }}" class="form-control"/>
                                    </div>
                                </div>
                            </th>
                            <th>
                                <span class="color-red">※</span>脈拍 <br/>
                                <input name="morning_pulse" value="{{ old('morning_pulse') }}" class="form-control" type="text"/>
                            </th>
                            <th>
                                <span class="color-red">※</span>体温 <br/>
                                <input name="morning_body_temperature" value="{{ old('morning_body_temperature') }}" class="form-control" type="text"/></th>
                            <th>
                                <span class="color-red">※</span>体重 <br/>
                                <input name="morning_weight" value="{{ old('morning_weight') }}" class="form-control input-unit inline" type="text"/>
                                <span class="lighter">kg</span>
                            </th>
                        </tr>
                        <tr>
                            <th>食 事<br/>副食/主食</th>
                            <th>
                                {!! generateRequiredLabel('meal_breakfast_side_dish') !!}朝食 <br/>
                                <div class="u-row">
                                    <div class="u-col-sm-6 u-col-sm-12">
                                        <select name="meal_breakfast_side_dish" class="form-control">
                                            {!! generateOptions('meal_breakfast_side_dish', old('meal_breakfast_side_dish'), false) !!}
                                        </select>
                                    </div>
                                    <div class="u-col-sm-6 u-col-sm-12">
                                        <select name="meal_breakfast_staple_food" class="form-control">
                                            {!! generateOptions('meal_breakfast_staple_food', old('meal_breakfast_staple_food'), false) !!}
                                        </select>
                                    </div>
                                </div>
                            </th>
                            <th>
                                {!! generateRequiredLabel('meal_lunch_side_dish') !!}昼食 <br/>
                                <div class="u-row">
                                    <div class="u-col-sm-6 u-col-sm-12">
                                        <select name="meal_lunch_side_dish" class="form-control">
                                            {!! generateOptions('meal_lunch_side_dish', old('meal_lunch_side_dish'), false) !!}
                                        </select>
                                    </div>
                                    <div class="u-col-sm-6 u-col-sm-12">
                                        <select name="meal_lunch_staple_food" class="form-control">
                                            {!! generateOptions('meal_lunch_staple_food', old('meal_lunch_staple_food'), false) !!}
                                        </select>
                                    </div>
                                </div>
                            </th>
                            <th>
                                {!! generateRequiredLabel('meal_snack_side_dish') !!}おやつ <br/>
                                <div class="u-row">
                                    <div class="u-col-sm-6 u-col-sm-12">
                                        <select name="meal_snack_side_dish" class="form-control">
                                            {!! generateOptions('meal_snack_side_dish', old('meal_snack_side_dish'), false) !!}
                                        </select>
                                    </div>
                                    <div class="u-col-sm-6 u-col-sm-12">
                                        <select name="meal_snack_staple_food" class="form-control">
                                            {!! generateOptions('meal_snack_staple_food', old('meal_snack_side_dish'), false) !!}
                                        </select>
                                    </div>
                                </div>
                            </th>
                            <th>
                                {!! generateRequiredLabel('meal_dinner_side_dish') !!}夕食 <br/>
                                <div class="u-row">
                                    <div class="u-col-sm-6 u-col-sm-12">
                                        <select name="meal_dinner_side_dish" class="form-control">
                                            {!! generateOptions('meal_dinner_side_dish', old('meal_dinner_side_dish'), false) !!}
                                        </select>
                                    </div>
                                    <div class="u-col-sm-6 u-col-sm-12">
                                        <select name="meal_dinner_staple_food" class="form-control">
                                            {!! generateOptions('meal_dinner_staple_food', old('meal_dinner_staple_food'), false) !!}
                                        </select>
                                    </div>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>排 泄 <br/> 尿/便</th>
                            <th>{!! generateRequiredLabel('excretion_morning_flight') !!}朝 <br/>
                                <div class="u-row">
                                    <div class="u-col-sm-6 u-col-sm-12">
                                        <select name="excretion_morning_flight" class="form-control">
                                            {!! generateOptions('excretion_morning_flight', old('excretion_morning_flight'), false) !!}
                                        </select>
                                    </div>
                                    <div class="u-col-sm-6 u-col-sm-12">
                                        <select name="excretion_morning_urine" class="form-control">
                                            {!! generateOptions('excretion_morning_urine', old('excretion_morning_urine'), false) !!}
                                        </select>
                                    </div>
                                </div>
                            </th>
                            <th>{!! generateRequiredLabel('excretion_afternoon_flight') !!}昼 <br/>
                                <div class="u-row">
                                    <div class="u-col-sm-6 u-col-sm-12">
                                        <select name="excretion_afternoon_flight" class="form-control">
                                            {!! generateOptions('excretion_afternoon_flight', old('excretion_afternoon_flight'), false) !!}
                                        </select>
                                    </div>
                                    <div class="u-col-sm-6 u-col-sm-12">
                                        <select name="excretion_afternoon_urine" class="form-control">
                                            {!! generateOptions('excretion_afternoon_urine', old('excretion_afternoon_urine'), false) !!}
                                        </select>
                                    </div>
                                </div>
                            </th>
                            <th>{!! generateRequiredLabel('excretion_night_flight') !!}夜 <br/>
                                <div class="u-row">
                                    <div class="u-col-sm-6 u-col-sm-12">
                                        <select name="excretion_night_flight" class="form-control">
                                            {!! generateOptions('excretion_night_flight', old('excretion_night_flight'), false) !!}
                                        </select>
                                    </div>
                                    <div class="u-col-sm-6 u-col-sm-12">
                                        <select name="excretion_night_urine" class="form-control">
                                            {!! generateOptions('excretion_night_urine', old('excretion_night_urine'), false) !!}
                                        </select>
                                    </div>
                                </div>
                            </th>
                            <th>水分 <br/>
                                <input type="text" name="excretion_moisture" value="{{ old('excretion_moisture') }}" class="form-control input-unit inline"/>
                                <span class="lighter"> ml</span>
                            </th>
                        </tr>
                        <tr>
                            <th>入 浴</th>
                            <th>{!! generateRequiredLabel('body_bath') !!}入浴 <br/>
                                <select name="body_bath" class="form-control">
                                    {!! generateOptions('body_bath', old('body_bath'), false) !!}
                                </select>
                            </th>
                            <th>{!! generateRequiredLabel('wipe_people') !!}清拭 <br/>
                                <select name="wipe_people" class="form-control">
                                    {!! generateOptions('wipe_people', old('wipe_people'), false) !!}
                                </select>
                            </th>
                            <th>{!! generateRequiredLabel('rejection') !!}拒否 <br/>
                                <select name="rejection" class="form-control">
                                    {!! generateOptions('rejection', old('rejection'), false) !!}
                                </select>
                            </th>
                            <th>{!! generateRequiredLabel('prohibition') !!}中止 <br/>
                                <select name="prohibition" class="form-control">
                                    {!! generateOptions('prohibition', old('prohibition'), false) !!}
                                </select>
                            </th>
                        </tr>
                        <tr>
                            <th>日 勤</th>
                            <td colspan="4">
                                <textarea class="form-control" name="work_day" rows="3" style="width: 100%">{{ old('work_day') }}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <th>夜 勤</th>
                            <td colspan="4">
                                <textarea class="form-control" name="work_night" rows="3" style="width: 100%">{{ old('work_night') }}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <th>巡 室</th>
                            <th colspan="4" style="" id="half-input-medical">
                                <div>
                                    {!! generateRequiredLabel('check_21_hour') !!}<span class="simsum">21</span> 時 <br/>
                                    <select name="check_21_hour" class="form-control">
                                        {!! generateOptions('check_21_hour', old('check_21_hour'), false) !!}
                                    </select>
                                </div>
                                <div>
                                    {!! generateRequiredLabel('check_0_hour') !!}<span class="simsum">0</span> 時 <br/>
                                    <select name="check_0_hour" class="form-control">
                                        {!! generateOptions('check_0_hour', old('check_0_hour'), false) !!}
                                    </select>
                                </div>
                                <div>
                                    {!! generateRequiredLabel('check_3_hour') !!}<span class="simsum">3</span> 時 <br/>
                                    <select name="check_3_hour" class="form-control">
                                        {!! generateOptions('check_3_hour', old('check_3_hour'), false) !!}
                                    </select>
                                </div>
                                <div>
                                    {!! generateRequiredLabel('check_6_hour') !!}<span class="simsum">6</span> 時 <br/>
                                    <select name="check_6_hour" class="form-control">
                                        {!! generateOptions('check_6_hour', old('check_6_hour'), false) !!}
                                    </select>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>備 考</th>
                            <td colspan="4">
                                <textarea class="form-control" name="remarks" rows="3" style="width: 100%">{{ old('remarks') }}</textarea>
                            </td>
                        </tr>
                    </table>
                </div>
                @include('admin.includes.errors')
            </div>

            <div class="col-sm-1 col-xs-12">
                <!--!-- Button trigger modal -->
                <button type="button" style="margin-top: 30px;" id="btn-save" class="btn btn-success btn-sm">保　存</button>

                <!-- Modal -->
                @include('admin.modal.save')
            </div>
        </form>
        <div class="back-btn" style="margin-left: 22px;">
            <a href="{{ url('admin/user/calendar/' . $user->id) }}" class="btn btn-default">戻る</a>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        function confirm(e) {
            $("#saveModal").modal('show');
        }
        function save(e) {
            $("#frmMedicalRecord").submit();
        }
        $(document).ready(function () {
            $("#btn-save").bind('click', confirm);
            $("#saveModal #btnSave").bind('click', save);
        });
    </script>
@endsection