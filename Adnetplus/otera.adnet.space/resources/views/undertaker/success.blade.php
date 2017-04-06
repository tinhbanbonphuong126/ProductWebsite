@extends('layouts.app-one')
@section('title')派遣管理システム　{!! $undertaker->undertaker_name !!}@endsection
@section('header-title')派遣管理システム　{!! $undertaker->undertaker_name !!}@endsection
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="col-sm-12 text-center" style="padding: 100px 0px 40px 0px;">
                依頼を送信しました。
            </div>
            <div class="col-sm-12 text-center" style="padding: 0px 0px 40px 0px;">
                    <a href="{!! route('under.urequest.create') !!}" class="btn btn-default" style="padding: 4px 40px;">戻る</a>
            </div>
        </div>
    </div>
@endsection
