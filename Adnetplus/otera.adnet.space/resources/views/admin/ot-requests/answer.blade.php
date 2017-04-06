@extends('layouts.app')
@section('title')派遣管理システム　管理者@endsection
@section('header-title')派遣管理システム　管理者@endsection
@section('content')
    <div class="row" style="padding-bottom: 30px;">
        <div class="col-md-12 col-xs-12">
            <div class="col-md-12 pb-20">
                <h2>返事確認</h2>
            </div>
        </div>
        <div class="col-md-12 col-xs-12">
        <div class="table-responsive">
            <table class="table no-border">
                <tbody>
                    <tr>
                        <td width="20%">社員名</td>
                        <td>
                            {!! Form::text('', $confirmRequest->user->name, ['class'=>'form-control','readonly']) !!}
                        </td>
                    </tr>
                    <tr>
                        <td width="20%">備考</td>
                        <td>
                            {!! Form::textarea('',$confirmRequest->content,['class'=>'form-control','readonly']) !!}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="form-group" style="padding-top: 10vw;padding-bottom: 5vw">
            <div class="col-sm-3 col-xs-12 col-sm-offset-4">
                <a href="{{ url('/admin/ot-requests/' . $confirmRequest->request_id . '/staff') }}" class="btn btn-default btn-block">戻る</a>
            </div>
        </div>
        </div>
    </div>
@endsection
