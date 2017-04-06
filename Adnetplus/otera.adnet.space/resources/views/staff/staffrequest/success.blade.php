@extends('layouts.app-user')
@section('title')派遣管理システム　{!! $user->name !!}@endsection
@section('header-title')派遣管理システム　{!! $user->name !!}@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-12 pb-20 text-center" style="padding-top: 15vw; padding-bottom: 5vw">
                <h1>メールを送信しました。</h1>
            </div>
            <div class="col-md-12 pb-20 text-center">
                <a href="{!! route('staff.staffrequest.index') !!}" class="btn btn-default"> 戻る </a>
            </div>
        </div>
    </div>
@endsection
