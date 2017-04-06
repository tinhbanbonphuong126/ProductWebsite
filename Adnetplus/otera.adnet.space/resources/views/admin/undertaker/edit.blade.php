@extends('layouts.app')
@section('title')派遣管理システム　管理者@endsection
@section('header-title')派遣管理システム　管理者@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <h1>葬儀社編集</h1>
    <hr/>
    <div style="font-size: 16px !important;">
    {!! Form::model($undertaker, [
        'method' => 'PATCH',
        'url' => ['/admin/undertaker', $undertaker->id],
        'class' => 'form-horizontal',
        'files' => true
    ]) !!}
        <div class="form-group {{ $errors->has('undertaker_id') ? 'has-error' : ''}}">
            {!! Form::label('id', 'ID', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                {!! Form::number('id', $undertaker->id, ['class' => 'form-control','readonly']) !!}
                {!! $errors->first('id', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('account_id') ? 'has-error' : ''}}">
            {!! Form::label('account_id', '葬儀社ID', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                {!! Form::text('account_id', $undertaker->account_id, ['class' => 'form-control','readonly']) !!}
                {!! $errors->first('account_id', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('undertaker_id') ? 'has-error' : ''}}">
            {!! Form::label('password', '葬儀社パスワード', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                {!! Form::text('password', decryptIt($undertaker->encrypt_pass), ['class' => 'form-control','readonly']) !!}
                {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('undertaker_name') ? 'has-error' : ''}}">
            <label for="undertaker_name" class="col-sm-2 control-label">
                <span class="bullet">※</span>葬儀社名
            </label>
            <div class="col-sm-10">
                {!! Form::text('undertaker_name', $undertaker->undertaker_name, ['class' => 'form-control','maxlength'=>64]) !!}
                {!! $errors->first('undertaker_name', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('other_name') ? 'has-error' : ''}}">
            <label for="other_name" class="col-sm-2 control-label">
                <span class="bullet">※</span>会館名
            </label>
            <div class="col-sm-10">
                {!! Form::text('other_name', $undertaker->other_name, ['class' => 'form-control','maxlength'=>32]) !!}
                {!! $errors->first('other_name', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
            <label for="address" class="col-sm-2 control-label">
                <span class="bullet">※</span>住所
            </label>
            <div class="col-sm-10">
                {!! Form::text('address', $undertaker->address, ['class' => 'form-control','maxlength'=>128]) !!}
                {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('phone') ? 'has-error' : ''}}">
            <label for="phone" class="col-sm-2 control-label">
                <span class="bullet">※</span>電話番号
            </label>
            <div class="col-sm-10">
                {!! Form::text('phone', null, ['class' => 'form-control','maxlength'=>16]) !!}
                {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('emails') ? 'has-error' : ''}}">
            <label for="emails" class="col-sm-2 control-label">
                <span class="bullet">※</span>メールアドレス
            </label>
            <div class="col-sm-10">
                {!! Form::text('emails', null, ['class' => 'form-control','maxlength'=>256]) !!}
                {!! $errors->first('emails', '<p class="help-block">:message</p>') !!}
            </div>
        </div>


        <div class="form-group">
            <div class="col-sm-3 pull-left">
                <a href="{!! route('admin.undertaker.index') !!}" class="btn btn-default btn-block">戻る</a>
            </div>
            <div class="col-sm-3 pull-right">
                <button class="btn btn-default btn-block" type="submit">登録</button>
            </div>
        </div>
    {!! Form::close() !!}
    </div>
    </div>

</div>
@endsection