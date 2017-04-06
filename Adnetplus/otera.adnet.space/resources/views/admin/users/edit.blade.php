@extends('layouts.app')
@section('title')派遣管理システム　管理者@endsection
@section('header-title')派遣管理システム　管理者@endsection
@section('content')
<div class="row">

    <h2>派遣社員編集</h2>
    <hr/>
    <div class="col-md-12" style="font-size: 16px !important;">
    {!! Form::model($user, [
        'method' => 'PATCH',
        'url' => ['/admin/users', $user->id],
        'class' => 'form-horizontal',
        'files' => true
    ]) !!}
        <div class="form-group {{ $errors->has('account_id') ? 'has-error' : ''}}">
            {!! Form::label('account_id', 'ID', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                {!! Form::text('id', $user->id, ['class' => 'form-control','readonly']) !!}
                {!! $errors->first('id', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('account_id') ? 'has-error' : ''}}">
            {!! Form::label('account_id', '社員ID', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                {!! Form::text('account_id', $user->account_id, ['class' => 'form-control','readonly']) !!}
                {!! $errors->first('account_id', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('account_id') ? 'has-error' : ''}}">
            <label for="account_id" class="col-sm-2 control-label">
                社員パスワード
            </label>
            <div class="col-sm-10">
                {!! Form::text('password', decryptIt($user->encrypt_pass), ['class' => 'form-control','readonly']) !!}
                {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
            <label for="name" class="col-sm-2 control-label">
                <span class="bullet">※</span>社員名
            </label>
            <div class="col-sm-10">
                {!! Form::text('name', $user->name, ['class' => 'form-control','maxlength'=>32]) !!}
                {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
            </div>
        </div>

        <div class="form-group {{ $errors->has('type_id') ? 'has-error' : ''}}">
            {!! Form::label('type_id', '担当区分', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                {!! Form::select('type_id',$types,$user->type_id, ['class' => 'form-control']) !!}
                {!! $errors->first('type_id', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('birthday') ? 'has-error' : ''}}">
            <label for="birthday" class="col-sm-2 control-label">
                <span class="bullet">※</span>生年月日
            </label>
            <div class="col-sm-10">
                {!! Form::text('birthday', date("Y/m/d", strtotime($user->birthday)), ['class' => 'form-control pickerCreate']) !!}
                {!! $errors->first('birthday', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
            <label for="address" class="col-sm-2 control-label">
                <span class="bullet">※</span>住所
            </label>
            <div class="col-sm-10">
                {!! Form::text('address', $user->address, ['class' => 'form-control','maxlength'=>128]) !!}
                {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('phone') ? 'has-error' : ''}}">
            <label for="phone" class="col-sm-2 control-label">
                <span class="bullet">※</span>電話番号
            </label>
            <div class="col-sm-10">
                {!! Form::text('phone', $user->phone, ['class' => 'form-control','maxlength'=>16]) !!}
                {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('emails') ? 'has-error' : ''}}">
            <label for="emails" class="col-sm-2 control-label">
                <span class="bullet">※</span>メールアドレス
            </label>
            <div class="col-sm-10">
                {!! Form::text('emails', $user->emails, ['class' => 'form-control','maxlength'=>256]) !!}
                {!! $errors->first('emails', '<p class="help-block">:message</p>') !!}
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-3 pull-left">
                <a href="{!! route('admin.users.index') !!}" class="btn btn-default btn-block">戻る</a>
            </div>
            <div class="col-sm-3 pull-right">
                <button class="btn btn-default btn-block" type="submit">登録</button>
            </div>
        </div>
    {!! Form::close() !!}

    </div>
</div>
@endsection