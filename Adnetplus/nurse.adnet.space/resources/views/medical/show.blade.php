@extends('layouts.app-three')

@section('title')
    @lang('messages.medical-record.title.detail')
@endsection

@section('content')
    <div class="row form-border" id="medical-form">
        <form action="" method="post" role="form" class="vertical-align">
            <div class="col-sm-11 col-xs-11">
                <div class="main-medical-register table-responsive">
                    <table class="table no-border-table">
                        <tr>
                            <th>@lang('messages.morning.text')</th>
                            <th>
                                @lang('messages.morning.text.blood_pressure') <br/>
                                <p>{{ $medicalRecord->morning_blood_pressure_high }}/{{ $medicalRecord->morning_blood_pressure_low }}</p>
                            </th>
                            <th>
                                @lang('messages.morning.text.pulse') <br/> <p>{{ $medicalRecord->morning_pulse }}</p>
                            </th>
                            <th>@lang('messages.morning.text.temperature') <br/> <p>{{ $medicalRecord->morning_body_temperature }}</p></th>
                            <th>@lang('messages.morning.text.weight') <br/> <p>{{ $medicalRecord->morning_weight }} kg</p></th>
                        </tr>
                        <tr>
                            <th>@lang('messages.meal.text')</th>
                            <th>
                                @lang('messages.meal.breakfast.text') <br/>
                                <div class="u-row">
                                    <div>
                                        {{ getOptionText('meal_breakfast_side_dish', $medicalRecord->meal_breakfast_side_dish_vn) }}/
                                        {{ getOptionText('meal_breakfast_staple_food', $medicalRecord->meal_breakfast_staple_food_vn) }}
                                    </div>
                                </div>
                            </th>
                            <th>@lang('messages.meal.lunch.text') <br/>
                                <div class="u-row">
                                    <div>
                                        {{ getOptionText('meal_lunch_side_dish', $medicalRecord->meal_lunch_side_dish_vn) }}/
                                        {{ getOptionText('meal_lunch_staple_food', $medicalRecord->meal_lunch_staple_food_vn) }}
                                    </div>
                                </div>
                            </th>
                            <th>@lang('messages.meal.snack.text') <br/>
                                <div class="u-row">
                                    <div>
                                        {{ getOptionText('meal_snack_side_dish', $medicalRecord->meal_snack_side_dish_vn) }}/
                                        {{ getOptionText('meal_snack_staple_food', $medicalRecord->meal_snack_staple_food_vn) }}
                                    </div>
                                </div>
                            </th>
                            <th>@lang('messages.meal.dinner.text') <br/>
                                <div class="u-row">
                                    <div>
                                        {{ getOptionText('meal_dinner_side_dish', $medicalRecord->meal_dinner_side_dish_vn) }}/
                                        {{ getOptionText('meal_dinner_staple_food', $medicalRecord->meal_dinner_staple_food_vn) }}
                                    </div>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>@lang('messages.excretion.text')</th>
                            <th>@lang('messages.excretion_morning.text') <br/>
                                <div class="u-row">
                                    <div>
                                        {{ getOptionText('excretion_morning_flight', $medicalRecord->excretion_morning_flight_vn) }}/
                                        {{ getOptionText('excretion_morning_urine', $medicalRecord->excretion_morning_urine_vn) }}
                                    </div>
                                </div>
                            </th>
                            <th>@lang('messages.excretion_afternoon.text') <br/>
                                <div class="u-row">
                                    <div>
                                        {{ getOptionText('excretion_afternoon_flight', $medicalRecord->excretion_afternoon_flight_vn) }}/
                                        {{ getOptionText('excretion_afternoon_urine', $medicalRecord->excretion_afternoon_urine_vn) }}
                                    </div>
                                </div>
                            </th>
                            <th>@lang('messages.excretion_night.text') <br/>
                                <div class="u-row">
                                    <div>
                                        {{ getOptionText('excretion_night_flight', $medicalRecord->excretion_night_flight_vn) }}/
                                        {{ getOptionText('excretion_night_urine', $medicalRecord->excretion_night_urine_vn) }}
                                    </div>
                                </div>
                            </th>
                            <th>@lang('messages.excretion_moisture.text') <br/>
                                <div class="u-row">
                                    <div>
                                        {{ $medicalRecord->excretion_moisture }} ml
                                    </div>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>@lang('messages.bath.text')</th>
                            <th>@lang('messages.body_bath.text') <br/>
                                <div class="u-row">
                                    <div>
                                        {{ getOptionText('body_bath', $medicalRecord->body_bath_vn) }}
                                    </div>
                                </div>
                            </th>
                            <th>@lang('messages.wipe_people.text') <br/>
                                <div class="u-row">
                                    <div>
                                        {{ getOptionText('wipe_people', $medicalRecord->wipe_people_vn) }}
                                    </div>
                                </div>
                            </th>
                            <th>@lang('messages.rejection.text') <br/>
                                <div class="u-row">
                                    <div>
                                        {{ getOptionText('rejection', $medicalRecord->rejection_vn) }}
                                    </div>
                                </div>
                            </th>
                            <th>@lang('messages.prohibition.text') <br/>
                                <div class="u-row">
                                    <div>
                                        {{ getOptionText('prohibition', $medicalRecord->prohibition_vn) }}
                                    </div>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>@lang('messages.work_day.text')</th>
                            <td colspan="4">
                                <div class="u-row">
                                    <div>{{ $medicalRecord->work_day }}</div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('messages.work_night.text')</th>
                            <td colspan="4">
                                <div class="u-row">
                                    <div>{{ $medicalRecord->work_night }}</div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('messages.check.text')</th>
                            <th colspan="4" style="" id="half-input-medical">
                                <div>
                                    @lang('messages.check_21_hour.text') <br/>
                                    <p>{{ getOptionText('check_21_hour', $medicalRecord->check_21_hour_vn) }}</p>
                                </div>
                                <div>
                                    @lang('messages.check_0_hour.text') <br/>
                                    <p>{{ getOptionText('check_0_hour', $medicalRecord->check_0_hour_vn) }}</p>
                                </div>
                                <div>
                                    @lang('messages.check_3_hour.text') <br/>
                                    <p>{{ getOptionText('check_3_hour', $medicalRecord->check_3_hour_vn) }}</p>
                                </div>
                                <div>
                                    @lang('messages.check_6_hour.text') <br/>
                                    <p>{{ getOptionText('check_6_hour', $medicalRecord->check_6_hour_vn) }}</p>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>@lang('messages.remarks.text')</th>
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
            <a href="{{ url('user/calendar/' . $user->id) }}" class="btn btn-default">@lang('messages.app.button.back')</a>
        </div>
    </div>
@endsection