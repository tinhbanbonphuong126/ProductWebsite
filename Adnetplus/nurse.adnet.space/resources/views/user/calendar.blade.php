@extends('layouts.app-three')

@section('title')
    @lang('messages.calendar.title')
@endsection

@section('content')
    <div class="table-border form-border">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr id="fix-size-column" style="border: 1px solid #ddd;">
                    <th>@lang('messages.calendar.Monday')</th>
                    <th>@lang('messages.calendar.Tuesday')</th>
                    <th>@lang('messages.calendar.Wednesday')</th>
                    <th>@lang('messages.calendar.Thursday')</th>
                    <th>@lang('messages.calendar.Friday')</th>
                    <th style="color: #0000ff">@lang('messages.calendar.Saturday')</th>
                    <th style="color: #ff0000">@lang('messages.calendar.Sunday')</th>
                </tr>
                </thead>
                <tbody id="fix-height-td">
                <tr>
                    @foreach($weekDays as $day)
                        <td>{{ $day }}</td>
                    @endforeach
                </tr>
                <tr>
                    @foreach($weekDays as $idx => $day)
                        @if (isCurrentDate($day))
                            <td>
                                @if (!checkCurrentMedicalRecord($user->id))
                                <p>
                                    <a href="{{ url('medical-record/add/' . $user->id) }}">
                                        <input type="button" value="@lang('messages.calendar.button.add')" class="btn btn-success"/>
                                    </a>
                                </p>
                                @else
                                <p>
                                    <a href="{{ url('medical-record/edit/' . $user->id . '/' . date('Y-m-d')) }}">
                                        <input type="button" value="@lang('messages.calendar.button.edit')" class="btn btn-warning"/>
                                    </a>
                                </p>
                                @endif
                            </td>
                        @elseif (isPreviousDate($day))
                            <td>
                                @if (checkMedicalRecordDetail($user->id, $idx))
                                <a href="{{ url('medical-record/show/'. $user->id . '/' . getSpecificDate($idx)) }}">
                                    <input type="button" value="@lang('messages.calendar.button.detail')" class="btn btn-primary"/>
                                </a>
                                @endif
                            </td>
                        @else
                            <td></td>
                        @endif
                    @endforeach
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div id="next-back-week">
            <div class="col-sm-2">
                <a href="{{ action('UsersController@calendar', ['id' => $user->id, 'w' => 'prev']) }}" class="text-center center-block btn btn-success">@lang('messages.calendar.last-week')</a>
            </div>
            <div class="col-sm-3"></div>
            <div class="col-sm-2">
                <a href="{{ action('UsersController@calendar', ['id' => $user->id, 'w' => 'current']) }}" class="text-center center-block btn btn-success">@lang('messages.calendar.current-week')</a>
            </div>
            <div class="col-sm-3"></div>
            <div class="col-sm-2">
                <a href="{{ action('UsersController@calendar', ['id' => $user->id, 'w' => 'next']) }}" class="text-center center-block btn btn-success">@lang('messages.calendar.next-week')</a>
            </div>
        </div>
        <div class="back-btn" style="padding-top: 10px; margin-left: 14px;">
            <a href="{{ url('home') }}" style="width: 70px;" class="btn btn-default">@lang('messages.app.button.back')</a>
        </div>
        <div class="clear-fix-20"></div>
    </div>
@endsection