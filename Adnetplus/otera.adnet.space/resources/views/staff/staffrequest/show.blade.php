@extends('layouts.app-user')
@section('title')派遣管理システム　{!! $user->name !!}@endsection
@section('header-title')派遣管理システム　{!! $user->name !!}@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <h2>依頼確認</h2>
        <hr>
        <div class="table-responsive">
            <table class="table no-border">
                <tbody>
                <tr>
                    <td>ID</td>
                    <td>{{ $requestUser->id }}</td>
                </tr>
                <tr>
                    <td width="30%">葬儀法要の種類</td>
                    <td>{{ $requestUser->requests->funeral->funeral_name }} </td>
                </tr>
                <tr>
                    <th colspan="2">式について</th>
                </tr>
                <tr>
                    <td>式名</td>
                    <td>  故 &nbsp;&nbsp; {{ $requestUser->requests->funeral_name }}</td>
                </tr>
                <tr>
                    <td>開式時間</td>
                    <td> {{ date('Y/m/d H:i',strtotime($requestUser->requests->start_time)) }} </td>
                </tr>
                <tr>
                    <td>喪主名</td>
                    <td> {{ $requestUser->requests->chief_name }} </td>
                </tr>
                <tr>
                    <td>宗派</td>
                    <td> {{ $requestUser->requests->religious }} &nbsp;&nbsp;&nbsp;宗 &nbsp;&nbsp;{{ $requestUser->requests->faction }} &nbsp;&nbsp;&nbsp;派</td>
                </tr>
                <tr>
                    <td>寺院名</td>
                    <td> {{ $requestUser->requests->otera_name }} </td>
                </tr>
                <tr>
                    <td>会場名</td>
                    <td> {{ $requestUser->requests->venue }} </td>
                </tr>
                <tr>
                    <td>会場詳細</td>
                    <td> {{ $requestUser->requests->venue_address }} </td>
                </tr>
                <tr>
                    <td>回葬予想人数</td>
                    <td> 約&nbsp;&nbsp; {{ $requestUser->requests->times_funeral }} &nbsp;&nbsp;名 </td>
                </tr>
                <tr>
                    <th colspan="2">発注業務</th>
                </tr>
                @if($requestUser->type_id == 1)
                <tr>
                    <td>司会・進行</td>
                    <td>
                        @if(!is_null($requestUser->requests->classification_request))
                            @foreach($requestUser->requests->classification_request as $item)
                                @if($item->type_id == 1)
                                    <p> {!! $item->count_nin !!} &nbsp;&nbsp;名&nbsp;&nbsp;&nbsp;{!! removeAmPM($item->time_start) !!} 時 ～ &nbsp;{!! removeAmPM($item->time_end) !!} 時 </p>
                                @endif
                            @endforeach
                        @endif
                    </td>
                </tr>
                @endif
                @if($requestUser->type_id == 2)
                <tr>
                    <td>アシスタント</td>
                    <td>
                        @if(!is_null($requestUser->requests->classification_request))
                            @foreach($requestUser->requests->classification_request as $item)
                                @if($item->type_id == 2)
                                    <p> {!! $item->count_nin !!} &nbsp;&nbsp;名&nbsp;&nbsp;&nbsp;{!! removeAmPM($item->time_start) !!} 時 ～ &nbsp;{!! removeAmPM($item->time_end) !!} 時 </p>
                                @endif
                            @endforeach
                        @endif
                    </td>
                </tr>
                @endif
                <tr>
                    <td>連絡事項</td>
                    <td> {{ $requestUser->requests->contact_matter }} </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <hr>
                    </td>
                </tr>
                <tr>
                    <td>返答</td>
                    <td>
                        @if(is_null($requestUser->requests->user_confirmed))
                            {!! Form::select('type_confirm',$getReply,isset($requestUser->requests->user_confirmed->type_confirm)?$requestUser->requests->user_confirmed->type_confirm:null,['class'=>'form-control']) !!}
                        @else
                            {!! Form::select('type_confirm',$getReply,isset($requestUser->requests->user_confirmed->type_confirm)?$requestUser->requests->user_confirmed->type_confirm:null,['class'=>'form-control','readonly']) !!}
                        @endif
                    </td>
                </tr>
                <!--
                <tr>
                    <th colspan="2">依頼を断る場合、理由を記述してください。</th>
                </tr>
                <tr>
                    <td>理由</td>
                    <td>
                        @if(is_null($requestUser->requests->user_confirmed))
                            {!! Form::select('reason_id',$getReason, isset($requestUser->requests->user_confirmed->reason_id)?$requestUser->requests->user_confirmed->reason_id:null,['class'=>'form-control']) !!}
                        @else
                            {!! Form::select('reason_id',$getReason,isset($requestUser->requests->user_confirmed->reason_id)?$requestUser->requests->user_confirmed->reason_id:null,['class'=>'form-control','readonly']) !!}
                        @endif
                    </td>
                </tr>
                -->
                <tr>
                    <td>備考</td>
                    <td>
                        @if(is_null($requestUser->requests->user_confirmed))
                            {!! Form::textarea('content',isset($requestUser->requests->user_confirmed->content)?$requestUser->requests->user_confirmed->content:null,['class'=>'form-control']) !!}
                        @else
                            {!! Form::textarea('content',isset($requestUser->requests->user_confirmed->content)?$requestUser->requests->user_confirmed->content:null,['class'=>'form-control','readonly']) !!}
                        @endif
                        <p class="content help-block">詳細は必須です。</p>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        @if(is_null($requestUser->requests->user_confirmed))
        <div class="form-group">
            <div class="col-sm-3 col-xs-12 pull-left">
                <a href="{!! route('staff.staffrequest.index') !!}" class="btn btn-default btn-block">戻る</a>
            </div>
            <div class="col-sm-3 col-xs-12 smtop10 pull-right">
                <button class="btn btn-default btn-block submitForm" type="button">送信</button>
            </div>
        </div>
        @else
            <div class="form-group">
                <div class="col-sm-3 col-xs-12 col-sm-offset-4">
                    <a href="{!! route('staff.staffrequest.index') !!}" class="btn btn-default btn-block">戻る</a>
                </div>
            </div>
        @endif
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
    </div>
</div>
<!-- Submit Form Modal -->
<div id="formModal" class="modal fade" role="dialog">
    <div class="modal-dialog  modal-sm">

        <!-- Modal content-->
        <div class="modal-content">
            {!! Form::open(['url' => '/staff/staffrequest', 'class' => 'form-horizontal']) !!}
                <div class="modal-body text-center">
                    <p>管理者にこの内容で返答を送ります。</p>
                    <p>本当によろしいですか。</p>
                    <table class="table no-border">
                        <tr>
                            <td width="20%">返答</td>
                            <td>
                                {!! Form::text('',null,['class'=>'type_confirm_input','readonly']) !!}
                                {!! Form::hidden('type_confirm','') !!}
                            </td>
                        </tr>
                        <!--
                        <tr>
                            <td width="20%">理由</td>
                            <td>
                                {!! Form::text('',null,['class'=>'reason_input','readonly']) !!}
                                {!! Form::hidden('reason_id','') !!}
                            </td>
                        </tr>
                        -->
                        <tr>
                            <td width="20%">備考</td>
                            <td>
                                {!! Form::text('content',null,['readonly']) !!}
                            </td>
                        </tr>
                        {!! Form::hidden('user_id',$user->id) !!}
                        {!! Form::hidden('request_id',$requestUser->requests->id) !!}
                        {!! Form::hidden('type_id',$requestUser->type_id) !!}
                    </table>
                </div>
                <div class="modal-footer">
                    <div class="col-md-6 col-xs-12">
                        <button type="button" class="btn btn-default btn-block" data-dismiss="modal">キャンセル</button>
                    </div>
                    <div class="col-md-6 col-xs-12 smtop10">
                        <button type="submit" class="btn btn-default btn-block">OK</button>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>

    </div>
</div>
    <script>
        $(function(){
            $("p.content").hide();
            $("select[name='type_confirm']").change(function(){
                if ($(this).val() == '1'){
                    $("p.content").hide();
                    $("textarea[name='content']").removeClass('frame-warming');
                }
            });
        })
        // submit form
        $(".submitForm").click(function(){
            var flag = 0;
            // check content note
            if($("select[name='type_confirm']").val() == '2'){
                if (!$.trim($("textarea[name='content']").val())) {
                    flag = 1;
                    $("p.content").show();
                    $("textarea[name='content']").addClass('frame-warming');
                }
            }
            if (flag == 0){
                // show form
                $("#formModal").modal('show');
                // set value for form
                $("#formModal input.type_confirm_input").val($("select[name='type_confirm'] :selected").text());
                $("#formModal input[name='type_confirm']").val($("select[name='type_confirm'] :selected").val());

                if ($("select[name='type_confirm'] :selected").val() == '2'){
                    $("#formModal input.reason_input").val($("select[name='reason_id'] :selected").text());
                    $("#formModal input[name='reason_id']").val($("select[name='reason_id'] :selected").val());
                }else{
                    $("#formModal input.reason_input").val('');
                    $("#formModal input[name='reason_id']").val('');
                }

                $("#formModal input[name='content']").val($("textarea[name='content']").val());
            }
        });
    </script>
@endsection
