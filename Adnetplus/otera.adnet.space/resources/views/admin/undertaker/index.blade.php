@extends('layouts.app')
@section('title')派遣管理システム　管理者@endsection
@section('header-title')派遣管理システム　管理者@endsection
@section('content')
<div class="row">
    <div class="col-md-12 col-xs-12 pb-20">
        <h2>葬儀社管理</h2>
    </div>
    <div class="col-md-12 col-xs-12 pb-30">
        <div class="col-md-8 col-xs-12 pull-left" style="padding-left: 0; padding-right: 0;">
            <div class="row">
            {!! Form::open(['route'=>'admin.undertaker.index','method'=>'GET','class'=>'form-horizontal']) !!}
            <div class="col-md-2 col-xs-12 smtop10">葬儀社名</div>
            <div class="col-md-5 col-xs-12 smtop10">
                {!! Form::text('name',isset($name)?$name:'',['class'=>'form-control']) !!}
            </div>
            <div class="col-md-2 col-xs-12 smtop10">
                <button class="form-control btn btn-default btn-block">検索</button>
            </div>
            {!! Form::close() !!}
            </div>
        </div>
        <div class="col-md-2 col-xs-12 pull-right smtop10">
            <div class="row">
                <a href="{{ url('/admin/undertaker/create') }}" class="btn btn-default btn-block" title="Add New User">
                    新規登録
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-xs-12">
        @if(Session::has('flash_message'))
            <p class="alert alert-success">{{ Session::get('flash_message') }}</p>
        @endif
    </div>
    <div class="col-md-12 col-xs-12">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th> 葬儀社名 </th>
                        <th> 会館名 </th>
                        <th> 操作 </th>
                    </tr>
                </thead>
                <tbody>
                @foreach($undertaker as $item)
                    <tr>
                        <td width="10%" align="center">{{ $item->id }}</td>
                        <td width="40%">{{ $item->undertaker_name }}</td>
                        <td width="40%">{{ $item->other_name }}</td>
                        <td width="10%" align="center">
                            <a href="{{ url('/admin/undertaker/' . $item->id . '/edit') }}">
                                編集
                            </a>
                            .
                            <a data-id="{{ $item->id }}" id="delModal" class="btnDelete">削除</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-12 col-xs-12">
        <div class="pagination-wrapper"> {!! $undertaker->render() !!} </div>
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
                    <p>一度削除したデータは元に戻せませ</p>
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
<script>
    // button edit click
    $(document).ready(function(){
        // delete modal
        $(document).on('click','a#delModal',function(){
            var id = $(this).attr('data-id');
            console.log(id);
            $('#showDeleteModal').modal('show');
            var url = "{!! URL::to('/admin/undertaker') !!}/"+id;
            $('#showDeleteModal form').attr('action',url);
        });
    });
</script>
@endsection
