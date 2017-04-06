@extends('admin.layouts.app-detail')

@section('title')カルテ詳細@endsection

@section('content')
    <div class="row form-border" id="medical-form">
        <form action="" method="post" role="form" class="vertical-align">
            <div class="col-sm-11 col-xs-11">
                <div class="main-medical-register table-responsive">
                    <table class="table no-border-table">
                        <tr>
                            <th>朝</th>
                            <th>
                                血圧 <br/>
                                <p>{{ $medicalRecord->morning_blood_pressure_high }}/{{ $medicalRecord->morning_blood_pressure_low }}</p>
                            </th>
                            <th>
                                脈拍 <br/> <p>{{ $medicalRecord->morning_pulse }}</p>
                            </th>
                            <th>体温 <br/> <p>{{ $medicalRecord->morning_body_temperature }}</p></th>
                            <th>体重 <br/> <p>{{ $medicalRecord->morning_weight }} kg</p></th>
                        </tr>
                        <tr>
                            <th>食 事 <br/> 副食/主食</th>
                            <th>
                                朝食 <br/>
                                <div class="u-row">
                                    <div>
                                        {{ getOptionText('meal_breakfast_side_dish', $medicalRecord->meal_breakfast_side_dish_ja, false) }}/
                                        {{ getOptionText('meal_breakfast_staple_food', $medicalRecord->meal_breakfast_staple_food_ja, false) }}
                                    </div>
                                </div>
                            </th>
                            <th>昼食 <br/>
                                <div class="u-row">
                                    <div>
                                        {{ getOptionText('meal_lunch_side_dish', $medicalRecord->meal_lunch_side_dish_ja, false) }}/
                                        {{ getOptionText('meal_lunch_staple_food', $medicalRecord->meal_lunch_staple_food_ja, false) }}
                                    </div>
                                </div>
                            </th>
                            <th>おやつ <br/>
                                <div class="u-row">
                                    <div>
                                        {{ getOptionText('meal_snack_side_dish', $medicalRecord->meal_snack_side_dish_ja, false) }}/
                                        {{ getOptionText('meal_snack_staple_food', $medicalRecord->meal_snack_staple_food_ja, false) }}
                                    </div>
                                </div>
                            </th>
                            <th>夕食 <br/>
                                <div class="u-row">
                                    <div>
                                        {{ getOptionText('meal_dinner_side_dish', $medicalRecord->meal_dinner_side_dish_ja, false) }}/
                                        {{ getOptionText('meal_dinner_staple_food', $medicalRecord->meal_dinner_staple_food_ja, false) }}
                                    </div>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>排 泄 <br/>  尿/便</th>
                            <th>朝 <br/>
                                <div class="u-row">
                                    <div>
                                        {{ getOptionText('excretion_morning_flight', $medicalRecord->excretion_morning_flight_ja, false) }}/
                                        {{ getOptionText('excretion_morning_urine', $medicalRecord->excretion_morning_urine_ja, false) }}
                                    </div>
                                </div>
                            </th>
                            <th>昼 <br/>
                                <div class="u-row">
                                    <div>
                                        {{ getOptionText('excretion_afternoon_flight', $medicalRecord->excretion_afternoon_flight_ja, false) }}/
                                        {{ getOptionText('excretion_afternoon_urine', $medicalRecord->excretion_afternoon_urine_ja, false) }}
                                    </div>
                                </div>
                            </th>
                            <th>夜 <br/>
                                <div class="u-row">
                                    <div>
                                        {{ getOptionText('excretion_night_flight', $medicalRecord->excretion_night_flight_ja, false) }}/
                                        {{ getOptionText('excretion_night_urine', $medicalRecord->excretion_night_urine_ja, false) }}
                                    </div>
                                </div>
                            </th>
                            <th>水分 <br/>
                                <div class="u-row">
                                    <div>
                                        {{ $medicalRecord->excretion_moisture }} ml
                                    </div>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>入 浴</th>
                            <th>入浴 <br/>
                                <div class="u-row">
                                    <div>
                                        {{ getOptionText('body_bath', $medicalRecord->body_bath_ja, false) }}
                                    </div>
                                </div>
                            </th>
                            <th>清拭 <br/>
                                <div class="u-row">
                                    <div>
                                        {{ getOptionText('wipe_people', $medicalRecord->wipe_people_ja, false) }}
                                    </div>
                                </div>
                            </th>
                            <th>拒否 <br/>
                                <div class="u-row">
                                    <div>
                                        {{ getOptionText('rejection', $medicalRecord->rejection_ja, false) }}
                                    </div>
                                </div>
                            </th>
                            <th>中止 <br/>
                                <div class="u-row">
                                    <div>
                                        {{ getOptionText('prohibition', $medicalRecord->prohibition_ja, false) }}
                                    </div>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>日 勤</th>
                            <td colspan="4">
                                <div class="u-row">
                                    <div>{{ $medicalRecord->work_day }}</div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>夜 勤</th>
                            <td colspan="4">
                                <div class="u-row">
                                    <div>{{ $medicalRecord->work_night }}</div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>巡 室</th>
                            <th colspan="4" style="" id="half-input-medical">
                                <div>
                                    <span class="simsum">21</span> 時 <br/>
                                    <p>{{ getOptionText('check_21_hour', $medicalRecord->check_21_hour_ja, false) }}</p>
                                </div>
                                <div>
                                    <span class="simsum">0</span> 時 <br/>
                                    <p>{{ getOptionText('check_0_hour', $medicalRecord->check_0_hour_ja, false) }}</p>
                                </div>
                                <div>
                                    <span class="simsum">3</span> 時 <br/>
                                    <p>{{ getOptionText('check_3_hour', $medicalRecord->check_3_hour_ja, false) }}</p>
                                </div>
                                <div>
                                    <span class="simsum">6</span> 時 <br/>
                                    <p>{{ getOptionText('check_6_hour', $medicalRecord->check_6_hour_ja, false) }}</p>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>備 考</th>
                            <td colspan="4">
                                <div class="u-row">
                                    <div>{{ $medicalRecord->remarks }}</div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col-sm-1 col-xs-1">
            </div>
        </form>
        <div class="back-btn" style="padding-top: 15px; margin-left: 22px;">
            <a href="{{ url('admin/user/calendar/' . $user->id) }}" class="btn btn-default">戻る</a>
        </div>
    </div>
@endsection