@extends('layouts.app-one')
@section('title')派遣管理システム　{!! $undertaker->undertaker_name !!}@endsection
@section('header-title')派遣管理システム　{!! $undertaker->undertaker_name !!}@endsection
@section('content')
    <div class="row">
        <h2>新規依頼</h2>
        <hr/>
        <div class="col-md-12" style="font-size: 16px !important;">
            {!! Form::open(['url' => '/under/urequest', 'class' => 'form-horizontal', 'files' => true]) !!}
            {!! Form::hidden('undertaker_id',$undertaker->id) !!}
            <div class="form-group {{ $errors->has('funeral_id') ? 'has-error' : ''}}">
                {!! Form::label('funeral_id', '葬儀法要の種類', ['class' => 'col-sm-2 control-label font-normal']) !!}
                <div class="col-sm-10">
                    {!! Form::select('funeral_id', $selectFuneral,null, ['class' => 'form-control']) !!}
                    {!! $errors->first('funeral_id', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12"><strong>式について</strong></div>
            </div>
            <div class="form-group {{ $errors->has('funeral_name') ? 'has-error' : ''}}">
                <label for="funeral_name" class="col-sm-2 control-label font-normal">
                    <span class="bullet">※</span> 式名
                </label>
                <div class="col-sm-10">
                    {!! Form::text('funeral_name', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('funeral_name', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('start_time') ? 'has-error' : ''}}">
                <label for="start_time" class="col-sm-2 control-label font-normal">
                    <span class="bullet">※</span>開式時間
                </label>
                <div class="col-sm-10">
                    {!! Form::text('start_time', null, ['class' => 'form-control datetime']) !!}
                    {!! $errors->first('start_time', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('chief_name') ? 'has-error' : ''}}">
                <label for="chief_name" class="col-sm-2 control-label font-normal">
                    <span class="bullet">※</span>喪主名
                </label>
                <div class="col-sm-10">
                    {!! Form::text('chief_name', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('chief_name', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('religious') ? 'has-error' : ''}}">
                <label for="religious" class="col-sm-2 control-label font-normal">
                    <span class="bullet">※</span> 宗派
                </label>
                <div class="col-sm-10">
                    <div class="col-sm-4" style="padding-left: 0px;">
                        {!! Form::text('religious', null, ['class' => 'form-control']) !!}
                        {!! $errors->first('religious', '<p class="help-block">:message</p>') !!}
                    </div>
                    <div class="col-sm-1">宗</div>
                    <div class="col-sm-4" style="padding-left: 0px;">
                        {!! Form::text('faction', null, ['class' => 'form-control']) !!}
                        {!! $errors->first('faction', '<p class="help-block">:message</p>') !!}
                    </div>
                    <div class="col-sm-1">派</div>
                </div>
            </div>
            <div class="form-group {{ $errors->has('otera_name') ? 'has-error' : ''}}">
                <label for="otera_name" class="col-sm-2 control-label font-normal">
                    <span class="bullet">※</span>寺院名
                </label>
                <div class="col-sm-10">
                    {!! Form::text('otera_name', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('otera_name', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('venue') ? 'has-error' : ''}}">
                <label for="venue" class="col-sm-2 control-label font-normal">
                    <span class="bullet">※</span>会場名
                </label>
                <div class="col-sm-10">
                    {!! Form::select('venue', ['会館' => '会館', '自宅' => '自宅', 'その他' =>'その他'], null, ['class' => 'form-control']) !!}
                    {!! $errors->first('venue', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('venue_address') ? 'has-error' : ''}}">
                <label for="venue_address" class="col-sm-2 control-label font-normal">
                    会場詳細
                </label>
                <div class="col-sm-10">
                    {!! Form::text('venue_address', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('venue_address', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('times_funeral') ? 'has-error' : ''}}">
                <label for="times_funeral" class="col-sm-2 control-label font-normal">
                    回葬予想人数
                </label>
                <div class="col-sm-10">
                    <div class="col-sm-1" style="padding-left: 0px;">約</div>
                    <div class="col-sm-3">
                        {!! Form::text('times_funeral', null, ['class' => 'form-control']) !!}
                        {!! $errors->first('times_funeral', '<p class="help-block">:message</p>') !!}
                    </div>
                    <div class="col-sm-1" style="padding-left: 0px;">名</div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12"><strong>発注業務</strong></div>
            </div>
            {!! Form::hidden('request_1_type_id',1) !!}
            {!! Form::hidden('request_2_type_id',2) !!}
            {!! Form::hidden('request_3_type_id',2) !!}
            <div class="form-group {{ $errors->has('request_1_count_nin') ? 'has-error' : ''}}">
                <label for="times_funeral" class="col-sm-2 control-label font-normal">
                    司会進行
                </label>
                <div class="col-sm-10">
                    <div class="col-sm-2" style="padding-left: 0px;">
                        {!! Form::text('request_1_count_nin', null, ['class' => 'form-control']) !!}
                        {!! $errors->first('request_1_count_nin', '<p class="help-block">:message</p>') !!}
                    </div>
                    <div class="col-sm-1" style="padding-left: 0px;">名</div>
                    <div class="col-sm-2">
                        {!! Form::text('request_1_time_start', null, ['class' => 'form-control request_1_time_start']) !!}
                        {!! $errors->first('request_1_time_start', '<p class="help-block">:message</p>') !!}
                    </div>
                    <div class="col-sm-1" style="padding-left: 0px;">時～</div>
                    <div class="col-sm-2">
                        {!! Form::text('request_1_time_end', null, ['class' => 'form-control request_1_time_end']) !!}
                        {!! $errors->first('request_1_time_end', '<p class="help-block">:message</p>') !!}
                    </div>
                    <div class="col-sm-1" style="padding-left: 0px;">時</div>
                </div>
            </div>
            <div class="form-group {{ $errors->has('request_2_count_nin') ? 'has-error' : ''}}">
                <label for="times_funeral" class="col-sm-2 control-label font-normal">
                    アシスタント
                </label>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="col-sm-2" style="padding-left: 0px;">
                                {!! Form::text('request_2_count_nin', null, ['class' => 'form-control']) !!}
                                {!! $errors->first('request_2_count_nin', '<p class="help-block">:message</p>') !!}
                            </div>
                            <div class="col-sm-1" style="padding-left: 0px;">名</div>
                            <div class="col-sm-2">
                                {!! Form::text('request_2_time_start', null, ['class' => 'form-control request_2_time_start']) !!}
                                {!! $errors->first('request_2_time_start', '<p class="help-block">:message</p>') !!}
                            </div>
                            <div class="col-sm-1" style="padding-left: 0px;">時～</div>
                            <div class="col-sm-2">
                                {!! Form::text('request_2_time_end', null, ['class' => 'form-control request_2_time_end']) !!}
                                {!! $errors->first('request_2_time_end', '<p class="help-block">:message</p>') !!}
                            </div>
                            <div class="col-sm-1" style="padding-left: 0px;">時</div>
                        </div>
                    </div>
                    <div class="row" style="padding-top: 20px;">
                        <div class="col-sm-12">
                            <div class="col-sm-2" style="padding-left: 0px;">
                                {!! Form::text('request_3_count_nin', null, ['class' => 'form-control']) !!}
                                {!! $errors->first('request_3_count_nin', '<p class="help-block">:message</p>') !!}
                            </div>
                            <div class="col-sm-1" style="padding-left: 0px;">名</div>
                            <div class="col-sm-2">
                                {!! Form::text('request_3_time_start', null, ['class' => 'form-control request_3_time_start']) !!}
                                {!! $errors->first('request_3_time_start', '<p class="help-block">:message</p>') !!}
                            </div>
                            <div class="col-sm-1" style="padding-left: 0px;">時～</div>
                            <div class="col-sm-2">
                                {!! Form::text('request_3_time_end', null, ['class' => 'form-control request_3_time_end']) !!}
                                {!! $errors->first('request_3_time_end', '<p class="help-block">:message</p>') !!}
                            </div>
                            <div class="col-sm-1" style="padding-left: 0px;">時</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group {{ $errors->has('contact_matter') ? 'has-error' : ''}}">
                <label for="contact_matter" class="col-sm-2 control-label font-normal">
                    連絡事項
                </label>
                <div class="col-sm-10">
                    {!! Form::textarea('contact_matter', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('contact_matter', '<p class="help-block">:message</p>') !!}
                </div>
            </div>


            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-2">
                    {!! Form::submit('確認する', ['class' => 'btn btn-default form-control']) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $('input.request_1_time_start').on("keydown keypress keyup", false);
            $('input.request_1_time_start').timepicker({
                timeFormat: 'HH tt',
                onSelect: function(dateText) {
                    var newtime = "";
                    var time = $(this).val().split(' ');
                    if (time[0] ==  '22'){
                        newtime = newtime+"00"+" 午前";
                    }else if(time[0] == '23'){
                        newtime = newtime+"01"+" 午前";
                    }else{
                        var addTime = parseInt(time[0]) + parseInt(2);
                        if(parseInt(addTime) < 10){
                            addTime = "0"+addTime;
                            newtime = newtime + addTime+" "+time[1];
                        }else{
                            if (parseInt(addTime) < 12){
                                newtime = newtime + addTime+" 午前";
                            }else{
                                newtime = newtime + addTime+" 午後";
                            }
                        }
                    }
                    $('input.request_1_time_end').val(newtime);
                }
            });
            $('input.request_1_time_end').on("keydown keypress keyup", false);
            $('input.request_1_time_end').timepicker({timeFormat: 'HH tt'});

            $('input.request_2_time_start').on("keydown keypress keyup", false);
            $('input.request_2_time_start').timepicker({
                timeFormat: 'HH tt',
                onSelect: function(dateText) {
                    var newtime = "";
                    var time = $(this).val().split(' ');
                    if (time[0] ==  '22'){
                        newtime = newtime+"00"+" 午前";
                    }else if(time[0] == '23'){
                        newtime = newtime+"01"+" 午前";
                    }else{
                        var addTime = parseInt(time[0]) + parseInt(4);
                        if(parseInt(addTime) < 10){
                            addTime = "0"+addTime;
                            newtime = newtime + addTime+" "+time[1];
                        }else{
                            if (parseInt(addTime) < 12){
                                newtime = newtime + addTime+" 午前";
                            }else{
                                newtime = newtime + addTime+" 午後";
                            }
                        }
                    }
                    $('input.request_2_time_end').val(newtime);
                }
            });
            $('input.request_2_time_end').on("keydown keypress keyup", false);
            $('input.request_2_time_end').timepicker({timeFormat: 'HH tt'});

            $('input.request_3_time_start').on("keydown keypress keyup", false);
            $('input.request_3_time_start').timepicker({
                timeFormat: 'HH tt',
                onSelect: function(dateText) {
                    var newtime = "";
                    var time = $(this).val().split(' ');
                    if (time[0] ==  '22'){
                        newtime = newtime+"00"+" 午前";
                    }else if(time[0] == '23'){
                        newtime = newtime+"01"+" 午前";
                    }else{
                        var addTime = parseInt(time[0]) + parseInt(4);
                        if(parseInt(addTime) < 10){
                            addTime = "0"+addTime;
                            newtime = newtime + addTime+" "+time[1];
                        }else{
                            if (parseInt(addTime) < 12){
                                newtime = newtime + addTime+" 午前";
                            }else{
                                newtime = newtime + addTime+" 午後";
                            }
                        }
                    }
                    $('input.request_3_time_end').val(newtime);
                }
            });

            $('input.request_3_time_end').on("keydown keypress keyup", false);
            $('input.request_3_time_end').timepicker({timeFormat: 'HH tt'});

        });
    </script>
@endsection