@extends('layouts.app-one')
@section('title')派遣管理システム　{!! $undertaker->undertaker_name !!}@endsection
@section('header-title')派遣管理システム　{!! $undertaker->undertaker_name !!}@endsection
@section('content')
    <div class="row">

    <h2>お問い合わせ</h2>
        <hr/>
        <div class="col-md-12">
    {!! Form::open(['url' => '/under/ucontact', 'class' => 'form-horizontal', 'files' => true]) !!}

            <div class="form-group {{ $errors->has('undertaker_name') ? 'has-error' : ''}}">
                {!! Form::label('undertaker_name', '葬儀社名', ['class' => 'col-sm-2 control-label font-normal']) !!}
                <div class="col-sm-10">
                    {!! Form::text('undertaker_name', $undertaker->undertaker_name, ['class' => 'form-control','readonly']) !!}
                    {!! $errors->first('undertaker_name', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('subject') ? 'has-error' : ''}}">
                <label for="subject" class="col-sm-2 control-label font-normal">
                    <span class="bullet">※</span> 件名
                </label>
                <div class="col-sm-10">
                    {!! Form::text('subject', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('subject', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('content') ? 'has-error' : ''}}">
                <label for="content" class="col-sm-2 control-label font-normal">
                    <span class="bullet">※</span> 内容
                </label>
                <div class="col-sm-10">
                    {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('content', '<p class="help-block">:message</p>') !!}
                </div>
            </div>


        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-3">
                {!! Form::submit('送信', ['class' => 'btn btn-default form-control']) !!}
            </div>
        </div>
    {!! Form::close() !!}
    </div>

</div>
@endsection