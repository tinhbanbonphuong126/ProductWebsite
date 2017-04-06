@extends('layouts.app')
@section('title')派遣管理システム　管理者@endsection
@section('header-title')派遣管理システム　管理者@endsection
@section('content')
<div class="row">
    <div class="col-md-12 col-xs-12 pb-20">
        <h2>依頼管理</h2>
    </div>
    <div class="col-md-12 col-xs-12 pb-30">
        <div class="row">
            {!! Form::open(['route'=>'admin.ot-requests.index','method'=>'GET','class'=>'form-horizontal']) !!}
            <div class="col-md-2 col-xs-12 smtop10">葬儀社名</div>
            <div class="col-md-3 col-xs-12 smtop10">
                {!! Form::text('undertaker_name',isset($undertaker_name)?$undertaker_name:'',['class'=>'form-control']) !!}
            </div>
            <div class="col-md-1 col-xs-12 smtop10">状態</div>
            <div class="col-md-3 col-xs-12 smtop10">
                {!! Form::select('status',$getStatus,isset($status)?$status:1,['class'=>'form-control']) !!}
            </div>
            <div class="col-md-2 col-xs-12 smtop10">
                <button class="form-control btn btn-default btn-block">検索</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    <div class="col-md-12 col-xs-12 smtop10">
        <div class="row">
            @if(Session::has('flash_message'))
                <p class="alert alert-success">{{ Session::get('flash_message') }}</p>
            @endif
        </div>
    </div>
    <div class="col-md-12 col-xs-12">
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>故人名</th>
                    <th>葬儀社名</th>
                    <th>開式時間</th>
                    <th>確定</th>
                    <th>新着</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($otrequests as $item)
                    <tr class="<?php if($item->status == 1){echo ' bg-brown ';} else{if(isConfirmedRequest($item->id) == false){ echo ' bg-pink '; }} ?>">
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->funeral_name }}</td>
                        <td>{{ $item->undertaker_name }}</td>
                        <td>{{ date("Y/m/d H:i", strtotime($item->start_time)) }}</td>
                        <td>{{ $item->completed_request == 1 ? '確定済' : '' }}</td>
                        <td style="color: red;">{{ $item->is_new_request == 1 ? 'New!' : '' }}</td>
                        <td width="20%" align="center">
                            <a href="{{ url('/admin/ot-requests/' . $item->id . '/staff') }}">詳細</a>
                            .
                            <a href="{{ url('/admin/ot-requests/' . $item->id . '/') }}">確認</a>
                            .
                            <a data-id="{{ $item->id }}" id="delModal" class="btnDelete">削除</a>
                            .
                            <a data-id="{{ $item->id }}" status="{{ $item->status }}" id="doneModal" class="btnDone">完了</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-12 col-xs-12">
        <div class="pagination-wrapper"> {!! $otrequests->render() !!} </div>
    </div>
</div>
<!-- Delete Modal -->
<div id="showDeleteModal" class="modal fade" role="dialog">
    <div class="modal-dialog  modal-sm">

        <!-- Modal content-->
        <div class="modal-content">
            <form role="form" method="POST" action="">
                <input name="_method" type="hidden" value="DELETE"/>
                {!! csrf_field() !!}
                <div class="modal-body text-center">
                    <p>一度削除したデータは元に戻せません。</p>
                    <p>本当によろしいですか。</p>
                </div>
                <div class="modal-footer">
                    <div class="col-md-6 col-xs-12">
                        <button type="button" class="btn btn-default btn-block" data-dismiss="modal">キャンセル</button>
                    </div>
                    <div class="col-md-6 col-xs-12 smtop10">
                        <button type="submit" class="btn btn-default btn-block">OK</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
<!-- Done Modal -->
<div id="showDoneModal" class="modal fade" role="dialog">
    <div class="modal-dialog  modal-sm">

        <!-- Modal content-->
        <div class="modal-content">
            <form role="form" method="POST" action="">
                {!! csrf_field() !!}
                <div class="modal-body text-center">
                    <p>この依頼は終了してもよろしいですか？</p>
                    {!! Form::hidden('status',null) !!}
                </div>
                <div class="modal-footer">
                    <div class="col-md-6 col-xs-12">
                        <button type="button" class="btn btn-default btn-block" data-dismiss="modal">キャンセル</button>
                    </div>
                    <div class="col-md-6 col-xs-12 smtop10">
                        <button type="submit" class="btn btn-default btn-block">OK</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
<script>
    // button edit click
    $(document).ready(function(){
        // delete modal
        $(document).on('click','a#delModal',function(){
            var id = $(this).attr('data-id');
            $('#showDeleteModal').modal('show');
            var url = "{!! URL::to('/admin/ot-requests') !!}/"+id;
            $('#showDeleteModal form').attr('action',url);
        });
        // done modal
        $(document).on('click','a#doneModal',function(){
            var id = $(this).attr('data-id');
            var status = $(this).attr('status');
            $('#showDoneModal').modal('show');
            var url = "{!! URL::to('/admin/ot-requests') !!}/"+id+"/done";
            $('#showDoneModal form').attr('action',url);
            $('#showDoneModal form input[name="status"]').val(status);
        });
    });
</script>
@endsection
