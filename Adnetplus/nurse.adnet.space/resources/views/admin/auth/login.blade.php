@extends('admin.layouts.app')

@section('title')
管理者ログイン
@endsection
@section('content')
    <div class="container" id="form-login">
        <div class="row">
            <div class="col-sm-offset-3 col-sm-6">
                <form class="form-horizontal form-border" method="post" action="/admin/login">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                            <h4>管理者ログイン</h4>
                        </div>
                    </div>
                    @if (count($errors) > 0)
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9"><span class="color-red">※<span class="simsum">ID</span>または<span class="simsum">PASS</span>が間違っています</span></div>
                    </div>
                    @endif
                    <div class="form-group">
                        <label for="id" class="col-sm-3 control-label"><span class="simsum">ID</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control bg-color" id="code" name="code" placeholder="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-sm-3 control-label"><span class="simsum">PASS</span></label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control bg-color" id="password" name="password" placeholder="">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                            <button type="submit" class="btn btn-success col-sm-12 col-xs-12">ログイン</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <span class="text-center center-block">※パスワードを忘れた場合は、本部へお問い合わせください。</span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
