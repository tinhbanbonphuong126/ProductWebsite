@extends('layouts.app-user')
@section('title')派遣管理システム　{!! $user->name !!}@endsection
@section('header-title')派遣管理システム　{!! $user->name !!}@endsection
@section('content')
<div class="row">
        <div class="col-md-12 col-xs-12 pb-20">
            <h2>依頼管理</h2>
        </div>
        <div class="col-md-12 col-xs-12 pb-30">
            <div class="col-md-8 col-xs-12 pull-left" style="padding-left: 0; padding-right: 0">
                <div class="row">
                    {!! Form::open(['route'=>'staff.staffrequest.index','method'=>'GET','class'=>'form-horizontal']) !!}
                    <div class="col-md-2 col-xs-12 smtop10">葬儀日時</div>
                    <div class="col-md-5 col-xs-12 smtop10">
                        {!! Form::text('time_request',isset($time_request)?$time_request:'',['class'=>'form-control datepicker','onfocus'=>'blur();']) !!}
                    </div>
                    <div class="col-md-2 col-xs-12 smtop10">
                        <button class="form-control btn btn-default btn-block">検索</button>
                    </div>
                    {!! Form::close() !!}
                </div>

            </div>
        </div>
    <div class="col-md-12 col-xs-12 pb-20">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>故人名</th>
                    <th>葬儀法要の種類</th>
                    <th>開式時間</th>
                    <th>担当区分</th>
                    <th>回答</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
            @foreach($staffrequest as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->requests->funeral_name }}</td>
                    <td>{{ $item->requests->funeral->funeral_name }}</td>
                    <td>{{ date("Y/m/d H:i",strtotime($item->requests->start_time)) }}</td>
                    <td>{{ isset($workTypes[$item->type_id]) ? $workTypes[$item->type_id] : ''  }}</td>
                    <td>
                        @if(is_null($item->requests->user_confirmed))
                        @else
                            @if($item->requests->user_confirmed->type_confirm == 1)
                                受ける
                            @else
                                断る
                            @endif
                        @endif
                    </td>
                    <td>
                        <a href="{{ url('/staff/staffrequest/' . $item->id . '/') }}">確認</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
    </div>
    <div class="col-md-12 col-xs-12 pb-20">
        <div class="pagination-wrapper"> {!! $staffrequest->render() !!} </div>
    </div>
</div>
@endsection
