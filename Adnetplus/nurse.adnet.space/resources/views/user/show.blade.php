@extends('layouts.app-three')

@section('title')
    @lang('messages.user-detail.title')
@endsection

@section('content')
    <div class="form-border table-border">
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>@lang('messages.user-detail.last-modification')</th>
                    <th>@lang('messages.user-detail.modifier')</th>
                    <th style="width: 300px"></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @if(count($user->medicalRecords) > 0)
                    @foreach($user->medicalRecords as $medicalRecord)
                        <tr>
                            <td>{{ $medicalRecord->updated_at->format('Y.m.d') }}</td>
                            <td>{{ $medicalRecord->updatedBy->name }}</td>
                            <th></th>
                            <td>
                                <a href="{{ url('medical-record/show/' . $user->id . '/' . $medicalRecord->created_at->format('Y-m-d')) }}"><input type="button" value="@lang('messages.user-detail.button')" class="btn btn-primary"/></a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr><td colspan="4"><span class="errors">@lang('messages.user-detail.no-result')</span></td></tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="back-btn" style="padding-top: 20px">
        <a href="{{ url('home') }}" style="width: 70px;" class="btn btn-default">@lang('messages.app.button.back')</a>
    </div>
@endsection