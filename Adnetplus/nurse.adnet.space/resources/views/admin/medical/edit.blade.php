@extends('admin.layouts.app-detail')

@section('title')
    カルテ編集
@endsection

@section('content')
    <div class="row form-border" id="medical-form">
        <form action="{{ url('admin/medical-record/edit/' . $user->id . '/' . $medicalRecord->created_at->format('Y-m-d')) }}" method="post" role="form" class="vertical-align" id="frmMedicalRecord">
            {{ csrf_field() }}
            <input type="hidden" name="id" value="{{ $medicalRecord->id }}">
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
                                        <input type="text" name="morning_blood_pressure_high" value="{{ $medicalRecord->morning_blood_pressure_high }}" class="form-control"/>
                                    </div>
                                    <div class="u-col-sm-6 u-col-sm-12">
                                        <input type="text" name="morning_blood_pressure_low" value="{{ $medicalRecord->morning_blood_pressure_low }}" class="form-control"/>
                                    </div>
                                </div>
                            </th>
                            <th>
                                <span class="color-red">※</span>脈拍 <br/>
                                <input name="morning_pulse" value="{{ $medicalRecord->morning_pulse }}" class="form-control" type="text"/>
                            </th>
                            <th>
                                <span class="color-red">※</span>体温 <br/>
                                <input name="morning_body_temperature" value="{{ $medicalRecord->morning_body_temperature }}" class="form-control" type="text"/></th>
                            <th>
                                <span class="color-red">※</span>体重 <br/>
                                <input name="morning_weight" value="{{ $medicalRecord->morning_weight }}" class="form-control input-unit inline" type="text"/>
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
                                            {!! generateOptions('meal_breakfast_side_dish', $medicalRecord->meal_breakfast_side_dish_ja, false) !!}
                                        </select>
                                    </div>
                                    <div class="u-col-sm-6 u-col-sm-12">
                                        <select name="meal_breakfast_staple_food" class="form-control">
                                            {!! generateOptions('meal_breakfast_staple_food', $medicalRecord->meal_breakfast_staple_food_ja, false) !!}
                                        </select>
                                    </div>
                                </div>
                            </th>
                            <th>
                                {!! generateRequiredLabel('meal_lunch_side_dish') !!}昼食 <br/>
                                <div class="u-row">
                                    <div class="u-col-sm-6 u-col-sm-12">
                                        <select name="meal_lunch_side_dish" class="form-control">
                                            {!! generateOptions('meal_lunch_side_dish', $medicalRecord->meal_lunch_side_dish_ja, false) !!}
                                        </select>
                                    </div>
                                    <div class="u-col-sm-6 u-col-sm-12">
                                        <select name="meal_lunch_staple_food" class="form-control">
                                            {!! generateOptions('meal_lunch_staple_food', $medicalRecord->meal_lunch_staple_food_ja, false) !!}
                                        </select>
                                    </div>
                                </div>
                            </th>
                            <th>
                                {!! generateRequiredLabel('meal_snack_side_dish') !!}おやつ <br/>
                                <div class="u-row">
                                    <div class="u-col-sm-6 u-col-sm-12">
                                        <select name="meal_snack_side_dish" class="form-control">
                                            {!! generateOptions('meal_snack_side_dish', $medicalRecord->meal_snack_side_dish_ja, false) !!}
                                        </select>
                                    </div>
                                    <div class="u-col-sm-6 u-col-sm-12">
                                        <select name="meal_snack_staple_food" class="form-control">
                                            {!! generateOptions('meal_snack_staple_food', $medicalRecord->meal_snack_staple_food_ja, false) !!}
                                        </select>
                                    </div>
                                </div>
                            </th>
                            <th>
                                {!! generateRequiredLabel('meal_dinner_side_dish') !!}夕食 <br/>
                                <div class="u-row">
                                    <div class="u-col-sm-6 u-col-sm-12">
                                        <select name="meal_dinner_side_dish" class="form-control">
                                            {!! generateOptions('meal_dinner_side_dish', $medicalRecord->meal_dinner_side_dish_ja, false) !!}
                                        </select>
                                    </div>
                                    <div class="u-col-sm-6 u-col-sm-12">
                                        <select name="meal_dinner_staple_food" class="form-control">
                                            {!! generateOptions('meal_dinner_staple_food', $medicalRecord->meal_dinner_staple_food_ja, false) !!}
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
                                            {!! generateOptions('excretion_morning_flight', $medicalRecord->excretion_morning_flight_ja, false) !!}
                                        </select>
                                    </div>
                                    <div class="u-col-sm-6 u-col-sm-12">
                                        <select name="excretion_morning_urine" class="form-control">
                                            {!! generateOptions('excretion_morning_urine', $medicalRecord->excretion_morning_urine_ja, false) !!}
                                        </select>
                                    </div>
                                </div>
                            </th>
                            <th>{!! generateRequiredLabel('excretion_afternoon_flight') !!}昼 <br/>
                                <div class="u-row">
                                    <div class="u-col-sm-6 u-col-sm-12">
                                        <select name="excretion_afternoon_flight" class="form-control">
                                            {!! generateOptions('excretion_afternoon_flight', $medicalRecord->excretion_afternoon_flight_ja, false) !!}
                                        </select>
                                    </div>
                                    <div class="u-col-sm-6 u-col-sm-12">
                                        <select name="excretion_afternoon_urine" class="form-control">
                                            {!! generateOptions('excretion_afternoon_urine', $medicalRecord->excretion_afternoon_urine_ja, false) !!}
                                        </select>
                                    </div>
                                </div>
                            </th>
                            <th>{!! generateRequiredLabel('excretion_night_flight') !!}夜 <br/>
                                <div class="u-row">
                                    <div class="u-col-sm-6 u-col-sm-12">
                                        <select name="excretion_night_flight" class="form-control">
                                            {!! generateOptions('excretion_night_flight', $medicalRecord->excretion_night_flight_ja, false) !!}
                                        </select>
                                    </div>
                                    <div class="u-col-sm-6 u-col-sm-12">
                                        <select name="excretion_night_urine" class="form-control">
                                            {!! generateOptions('excretion_night_urine', $medicalRecord->excretion_night_urine_ja, false) !!}
                                        </select>
                                    </div>
                                </div>
                            </th>
                            <th>水分 <br/>
                                <input type="text" name="excretion_moisture" value="{{ $medicalRecord->excretion_moisture }}" class="form-control input-unit inline"/>
                                <span class="lighter"> ml</span>
                            </th>
                        </tr>
                        <tr>
                            <th>入 浴</th>
                            <th>{!! generateRequiredLabel('body_bath') !!}入浴 <br/>
                                <select name="body_bath" class="form-control">
                                    {!! generateOptions('body_bath', $medicalRecord->body_bath_ja, false) !!}
                                </select>
                            </th>
                            <th>{!! generateRequiredLabel('wipe_people') !!}清拭 <br/>
                                <select name="wipe_people" class="form-control">
                                    {!! generateOptions('wipe_people', $medicalRecord->wipe_people_ja, false) !!}
                                </select>
                            </th>
                            <th>{!! generateRequiredLabel('rejection') !!}拒否 <br/>
                                <select name="rejection" class="form-control">
                                    {!! generateOptions('rejection', $medicalRecord->rejection_ja, false) !!}
                                </select>
                            </th>
                            <th>{!! generateRequiredLabel('prohibition') !!}中止 <br/>
                                <select name="prohibition" class="form-control">
                                    {!! generateOptions('prohibition', $medicalRecord->prohibition_ja, false) !!}
                                </select>
                            </th>
                        </tr>
                        <tr>
                            <th>日 勤</th>
                            <td colspan="4">
                                <textarea class="form-control" name="work_day" rows="3" style="width: 100%">{{ $medicalRecord->work_day }}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <th>夜 勤</th>
                            <td colspan="4">
                                <textarea class="form-control" name="work_night" rows="3" style="width: 100%">{{ $medicalRecord->work_night }}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <th>巡 室</th>
                            <th colspan="4" style="" id="half-input-medical">
                                <div>
                                    {!! generateRequiredLabel('check_21_hour') !!}<span class="simsum">21</span> 時 <br/>
                                    <select name="check_21_hour" class="form-control">
                                        {!! generateOptions('check_21_hour', $medicalRecord->check_21_hour_ja, false) !!}
                                    </select>
                                </div>
                                <div>
                                    {!! generateRequiredLabel('check_0_hour') !!}<span class="simsum">0</span> 時 <br/>
                                    <select name="check_0_hour" class="form-control">
                                        {!! generateOptions('check_0_hour', $medicalRecord->check_0_hour_ja, false) !!}
                                    </select>
                                </div>
                                <div>
                                    {!! generateRequiredLabel('check_3_hour') !!}<span class="simsum">3</span> 時 <br/>
                                    <select name="check_3_hour" class="form-control">
                                        {!! generateOptions('check_3_hour', $medicalRecord->check_3_hour_ja, false) !!}
                                    </select>
                                </div>
                                <div>
                                    {!! generateRequiredLabel('check_6_hour') !!}<span class="simsum">6</span> 時 <br/>
                                    <select name="check_6_hour" class="form-control">
                                        {!! generateOptions('check_6_hour', $medicalRecord->check_6_hour_ja, false) !!}
                                    </select>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>備 考</th>
                            <td colspan="4">
                                <textarea class="form-control" name="remarks" rows="3" style="width: 100%">{{ $medicalRecord->remarks }}</textarea>
                            </td>
                        </tr>
                    </table>
                </div>
                @include('admin.includes.errors')
            </div>

            <div class="col-sm-1 col-xs-12">
                <!--!-- Button trigger modal -->
                <button type="button" id="btn-save" class="btn btn-success btn-sm">保　存</button>

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