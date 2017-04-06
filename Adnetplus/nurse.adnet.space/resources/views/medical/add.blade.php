@extends('layouts.app-three')

@section('title')
    @lang('messages.medical-record.title.add')
@endsection

@section('content')
    <div class="row form-border" id="medical-form">
        <form action="{{ url('medical-record/add/' . $user->id) }}" method="post" role="form" class="vertical-align" id="frmMedicalRecord">
            {{ csrf_field() }}
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            <div class="col-sm-11 col-xs-11">
                <div class="main-medical-register table-responsive">
                    <table class="table no-border-table">
                        <tr>
                            <th>@lang('messages.morning.text')</th>
                            <th id="width-th">
                                <span class="color-red">※</span>@lang('messages.morning.text.blood_pressure') <br/>
                                <div class="u-row">
                                    <div class="u-col-sm-6 u-col-sm-12">
                                        <input type="text" name="morning_blood_pressure_high" value="{{ session('input.morning_blood_pressure_high') }}" class="form-control"/>
                                    </div>
                                    <div class="u-col-sm-6 u-col-sm-12">
                                        <input type="text" name="morning_blood_pressure_low" value="{{ session('input.morning_blood_pressure_low') }}" class="form-control"/>
                                    </div>
                                </div>
                            </th>
                            <th>
                                <span class="color-red">※</span>@lang('messages.morning.text.pulse') <br/>
                                <input name="morning_pulse" value="{{ session('input.morning_pulse') }}" class="form-control" type="text"/>
                            </th>
                            <th>
                                <span class="color-red">※</span>@lang('messages.morning.text.temperature') <br/>
                                <input name="morning_body_temperature" value="{{ session('input.morning_body_temperature') }}" class="form-control" type="text"/></th>
                            <th>
                                <span class="color-red">※</span>@lang('messages.morning.text.weight') <br/>
                                <input name="morning_weight" value="{{ session('input.morning_weight') }}" class="form-control input-unit inline" type="text"/>
                                <span class="lighter">kg</span>
                            </th>
                        </tr>
                        <tr>
                            <th>@lang('messages.meal.text')</th>
                            <th>
                                {!! generateRequiredLabel('meal_breakfast_side_dish') !!}@lang('messages.meal.breakfast.text') <br/>
                                <div class="u-row">
                                    <div class="u-col-sm-6 u-col-sm-12">
                                        <select name="meal_breakfast_side_dish" class="form-control">
                                            {!! generateOptions('meal_breakfast_side_dish', session('input.meal_breakfast_side_dish')) !!}
                                        </select>
                                    </div>
                                    <div class="u-col-sm-6 u-col-sm-12">
                                        <select name="meal_breakfast_staple_food" class="form-control">
                                            {!! generateOptions('meal_breakfast_staple_food', session('input.meal_breakfast_staple_food')) !!}
                                        </select>
                                    </div>
                                </div>
                            </th>
                            <th>
                                {!! generateRequiredLabel('meal_lunch_side_dish') !!}@lang('messages.meal.lunch.text') <br/>
                                <div class="u-row">
                                    <div class="u-col-sm-6 u-col-sm-12">
                                        <select name="meal_lunch_side_dish" class="form-control">
                                            {!! generateOptions('meal_lunch_side_dish', session('input.meal_lunch_side_dish')) !!}
                                        </select>
                                    </div>
                                    <div class="u-col-sm-6 u-col-sm-12">
                                        <select name="meal_lunch_staple_food" class="form-control">
                                            {!! generateOptions('meal_lunch_staple_food', session('input.meal_lunch_staple_food')) !!}
                                        </select>
                                    </div>
                                </div>
                            </th>
                            <th>
                                {!! generateRequiredLabel('meal_snack_side_dish') !!}@lang('messages.meal.snack.text') <br/>
                                <div class="u-row">
                                    <div class="u-col-sm-6 u-col-sm-12">
                                        <select name="meal_snack_side_dish" class="form-control">
                                            {!! generateOptions('meal_snack_side_dish', session('input.meal_snack_side_dish')) !!}
                                        </select>
                                    </div>
                                    <div class="u-col-sm-6 u-col-sm-12">
                                        <select name="meal_snack_staple_food" class="form-control">
                                            {!! generateOptions('meal_snack_staple_food', session('input.meal_snack_side_dish')) !!}
                                        </select>
                                    </div>
                                </div>
                            </th>
                            <th>
                                {!! generateRequiredLabel('meal_dinner_side_dish') !!}@lang('messages.meal.dinner.text') <br/>
                                <div class="u-row">
                                    <div class="u-col-sm-6 u-col-sm-12">
                                        <select name="meal_dinner_side_dish" class="form-control">
                                            {!! generateOptions('meal_dinner_side_dish', session('input.meal_dinner_side_dish')) !!}
                                        </select>
                                    </div>
                                    <div class="u-col-sm-6 u-col-sm-12">
                                        <select name="meal_dinner_staple_food" class="form-control">
                                            {!! generateOptions('meal_dinner_staple_food', session('input.meal_dinner_staple_food')) !!}
                                        </select>
                                    </div>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>@lang('messages.excretion.text')</th>
                            <th>{!! generateRequiredLabel('excretion_morning_flight') !!}@lang('messages.excretion_morning.text') <br/>
                                <div class="u-row">
                                    <div class="u-col-sm-6 u-col-sm-12">
                                        <select name="excretion_morning_flight" class="form-control">
                                            {!! generateOptions('excretion_morning_flight', session('input.excretion_morning_flight')) !!}
                                        </select>
                                    </div>
                                    <div class="u-col-sm-6 u-col-sm-12">
                                        <select name="excretion_morning_urine" class="form-control">
                                            {!! generateOptions('excretion_morning_urine', session('input.excretion_morning_urine')) !!}
                                        </select>
                                    </div>
                                </div>
                            </th>
                            <th>{!! generateRequiredLabel('excretion_afternoon_flight') !!}@lang('messages.excretion_afternoon.text') <br/>
                                <div class="u-row">
                                    <div class="u-col-sm-6 u-col-sm-12">
                                        <select name="excretion_afternoon_flight" class="form-control">
                                            {!! generateOptions('excretion_afternoon_flight', session('input.excretion_afternoon_flight')) !!}
                                        </select>
                                    </div>
                                    <div class="u-col-sm-6 u-col-sm-12">
                                        <select name="excretion_afternoon_urine" class="form-control">
                                            {!! generateOptions('excretion_afternoon_urine', session('input.excretion_afternoon_urine')) !!}
                                        </select>
                                    </div>
                                </div>
                            </th>
                            <th>{!! generateRequiredLabel('excretion_night_flight') !!}@lang('messages.excretion_night.text') <br/>
                                <div class="u-row">
                                    <div class="u-col-sm-6 u-col-sm-12">
                                        <select name="excretion_night_flight" class="form-control">
                                            {!! generateOptions('excretion_night_flight', session('input.excretion_night_flight')) !!}
                                        </select>
                                    </div>
                                    <div class="u-col-sm-6 u-col-sm-12">
                                        <select name="excretion_night_urine" class="form-control">
                                            {!! generateOptions('excretion_night_urine', session('input.excretion_night_urine')) !!}
                                        </select>
                                    </div>
                                </div>
                            </th>
                            <th>@lang('messages.excretion_moisture.text') <br/>
                                <input type="text" name="excretion_moisture" value="{{ session('input.excretion_moisture') }}" class="form-control input-unit inline"/>
                                <span class="lighter"> ml</span>
                            </th>
                        </tr>
                        <tr>
                            <th>@lang('messages.bath.text')</th>
                            <th>{!! generateRequiredLabel('body_bath') !!}@lang('messages.body_bath.text') <br/>
                                <select name="body_bath" class="form-control">
                                    {!! generateOptions('body_bath', session('input.body_bath')) !!}
                                </select>
                            </th>
                            <th>{!! generateRequiredLabel('wipe_people') !!}@lang('messages.wipe_people.text') <br/>
                                <select name="wipe_people" class="form-control">
                                    {!! generateOptions('wipe_people', session('input.wipe_people')) !!}
                                </select>
                            </th>
                            <th>{!! generateRequiredLabel('rejection') !!}@lang('messages.rejection.text') <br/>
                                <select name="rejection" class="form-control">
                                    {!! generateOptions('rejection', session('input.rejection')) !!}
                                </select>
                            </th>
                            <th>{!! generateRequiredLabel('prohibition') !!}@lang('messages.prohibition.text') <br/>
                                <select name="prohibition" class="form-control">
                                    {!! generateOptions('prohibition', session('input.prohibition')) !!}
                                </select>
                            </th>
                        </tr>
                        <tr>
                            <th>@lang('messages.work_day.text')</th>
                            <td colspan="4">
                                <textarea class="form-control" name="work_day" rows="3" style="width: 100%">{{ session('input.work_day') }}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('messages.work_night.text')</th>
                            <td colspan="4">
                                <textarea class="form-control" name="work_night" rows="3" style="width: 100%">{{ session('input.work_night') }}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('messages.check.text')</th>
                            <th colspan="4" style="" id="half-input-medical">
                                <div>
                                    {!! generateRequiredLabel('check_21_hour') !!}@lang('messages.check_21_hour.text') <br/>
                                    <select name="check_21_hour" class="form-control">
                                        {!! generateOptions('check_21_hour', session('input.check_21_hour')) !!}
                                    </select>
                                </div>
                                <div>
                                    {!! generateRequiredLabel('check_0_hour') !!}@lang('messages.check_0_hour.text') <br/>
                                    <select name="check_0_hour" class="form-control">
                                        {!! generateOptions('check_0_hour', session('input.check_0_hour')) !!}
                                    </select>
                                </div>
                                <div>
                                    {!! generateRequiredLabel('check_3_hour') !!}@lang('messages.check_3_hour.text') <br/>
                                    <select name="check_3_hour" class="form-control">
                                        {!! generateOptions('check_3_hour', session('input.check_3_hour')) !!}
                                    </select>
                                </div>
                                <div>
                                    {!! generateRequiredLabel('check_6_hour') !!}@lang('messages.check_6_hour.text') <br/>
                                    <select name="check_6_hour" class="form-control">
                                        {!! generateOptions('check_6_hour', session('input.check_6_hour')) !!}
                                    </select>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>@lang('messages.remarks.text')</th>
                            <td colspan="4">
                                <textarea class="form-control" name="remarks" rows="3" style="width: 100%">{{ session('input.remarks') }}</textarea>
                            </td>
                        </tr>
                    </table>
                </div>
                @include('includes.errors')
            </div>

            <div class="col-sm-1 col-xs-12">
                <!--!-- Button trigger modal -->
                <button type="button" id="btn-save" class="btn btn-success btn-sm">@lang('messages.medical-record.button.text')</button>

                <!-- Modal -->
                @include('modal.save')
            </div>
        </form>
        <div class="back-btn" style="padding-top: 20px; margin-left: 22px;">
            <a href="{{ url('user/calendar/' . $user->id) }}" class="btn btn-default">@lang('messages.app.button.back')</a>
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