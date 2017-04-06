@extends('layouts.app-one')

@section('content')
    <div class="container" id="form-login">
        <div class="row">
            <div class="col-sm-offset-3 col-sm-6">
                {!! Form::open(['url' => '/login', 'method' => 'post', 'class' => 'form-horizontal form-border']) !!}
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                            <h4>@lang('messages.login.title')</h4>
                        </div>
                    </div>
                    @if (count($errors) > 0)
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">@lang('messages.login.error')</div>
                    </div>
                    @endif
                    <div class="form-group">
                        <label for="id" class="col-sm-3 control-label"><span class="simsum">@lang('messages.login.code')</span></label>
                        <div class="col-sm-9">
                            {!! Form::text('email', '', ['class' => 'form-control bg-color']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-sm-3 control-label"><span class="simsum">@lang('messages.login.password')</span></label>
                        <div class="col-sm-9">
                            {!! Form::password('password', ['class' => 'form-control bg-color']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                            <button type="submit" class="btn btn-success col-sm-12 col-xs-12">@lang('messages.login.submit')</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <span class="text-center center-block">@lang('messages.login.note')</span>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
        <!--Language-->
        <div id="lang">
            <a href="{{ url('/locale/ja') }}">日本語</a>/<a href="{{ url('/locale/vn') }}">Việt Nam</a>
        </div>
    </div>
@endsection