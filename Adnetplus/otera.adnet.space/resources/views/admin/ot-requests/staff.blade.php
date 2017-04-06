@extends('layouts.app')
@section('title')派遣管理システム　管理者@endsection
@section('header-title')派遣管理システム　管理者@endsection
@section('content')
<div class="row" style="padding-bottom: 30px;">
    <div class="col-md-12">
        <div class="col-md-12 pb-20">
            <h2>派遣社員確定 &nbsp;&nbsp;&nbsp;故人名: {!! $requests->funeral_name !!}</h2>
        </div>
        <div class="col-md-12 pb-30">
            <div class="col-md-2 pull-right">
                <a data-id="{{ $requests->id }}" class="btnDetail btn btn-default btn-block">依頼確認</a>
            </div>
            <div class="col-md-2 pull-right">
                <a href="{{ url('/admin/ot-requests/' . $requests->id . '/choose') }}" class="btn btn-default btn-block">再募集</a>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-xs-12 smtop10">
        <div class="alert alert-danger">

            @if($type1_noconfirm  > 0 )
            <p>司会・進行が{!! $type1_noconfirm !!}人不足しています。</p>
            @endif

            @if($type2_noconfirm  > 0 )
            <p>アシスタントが{!! $type2_noconfirm !!}人不足しています。</p>
            @endif
        </div>
    </div>
    <div class="col-md-12 col-xs-12 smtop10">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th><th>社員名</th><th>担当区分</th><th>受信日</th><th>回答</th><th>確定</th>
                </tr>
            </thead>
            <tbody>
                @if(!is_null($confirmRequest) && count($confirmRequest) > 0 )
                    @foreach($confirmRequest as $item)
                    <tr>
                        <td>{!! $item->id !!}</td>
                        <td>{!! $item->user->name !!}</td>
                        <td>{!! isset($workTypes[$item->type_id]) ? $workTypes[$item->type_id] : $item->user->type_work->name !!}</td>
                        <td>{!! date('Y/m/d',strtotime($item->created_at)) !!}</td>
                        <td>
                            <a href="{{ url('/admin/ot-requests/' . $item->id . '/answer') }}">
                                {{ $item->type_confirm == 1 ? '受ける' : '断る' }}
                            </a>
                        </td>
                        <td>
                            @if($item->type_confirm == 1 && $item->delflag == 0)
                                <span class="changeShiNai_{{$item->id}} addHref" onclick="changToShiNai({{$item->id}})">する</span>
                            @else
                                <span class="changeShiNai_{{$item->id}} addHref" onclick="changToSuru({{$item->id}})">しない</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
    <div class="form-group">
        <div class="col-sm-3 pull-left">
            <a href="{!! route('admin.ot-requests.index') !!}" class="btn btn-default btn-block">戻る</a>
        </div>
        <div class="col-sm-3 pull-right">
            <a class="btn btn-default btn-block sendMailSuccess" >依頼を確定する</a>
        </div>
    </div>
    </div>
</div>

<!-- Detail Modal -->
<div id="showDetailModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
                <div class="modal-body text-center">
                    <table class="table no-border text-left">
                        <tbody>
                        <tr>
                            <td>ID</td>
                            <td class="modal_id"></td>
                        </tr>
                        <tr>
                            <td width="30%">葬儀法要の種類</td>
                            <td class="modal_funeral_funeral_name"></td>
                        </tr>
                        <tr>
                            <th colspan="2">式について</th>
                        </tr>
                        <tr>
                            <td>式名</td>
                            <td class="modal_funeral_name">
                                故 &nbsp;&nbsp; <span></span>
                            </td>
                        </tr>
                        <tr>
                            <td>開式時間</td>
                            <td class="modal_start_time"></td>
                        </tr>
                        <tr>
                            <td>喪主名</td>
                            <td class="modal_chief_name"></td>
                        </tr>
                        <tr>
                            <td>宗派</td>
                            <td class="modal_religious_faction"> <span></span> &nbsp;&nbsp;&nbsp;宗 &nbsp;&nbsp;<span></span> &nbsp;&nbsp;&nbsp;派</td>
                        </tr>
                        <tr>
                            <td>寺院名</td>
                            <td class="modal_otera_name"></td>
                        </tr>
                        <tr>
                            <td>会場名</td>
                            <td class="modal_venue"></td>
                        </tr>
                        <tr>
                            <td>会場詳細</td>
                            <td class="modal_venue_address"></td>
                        </tr>
                        <tr>
                            <td>回葬予想人数</td>
                            <td class="modal_times_funeral"> 約&nbsp;&nbsp; <span></span> &nbsp;&nbsp;名 </td>
                        </tr>
                        <tr>
                            <th colspan="2">発注業務</th>
                        </tr>
                        <tr>
                            <td>司会・進行</td>
                            <td class="modal_type_one"></td>
                        </tr>
                        <tr>
                            <td>アシスタント</td>
                            <td class="modal_type_two">
                            </td>
                        </tr>
                        <tr>
                            <td>連絡事項</td>
                            <td class="modal_contact_matter"></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
        </div>
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
                    <p>確定を”しない”にします。</p>
                    <p>“しない”の場合、確定のメールは送信させれません。</p>
                    <p>本当によろしいですか。</p>
                </div>
                <div class="modal-footer">
                    <div class="col-md-6 col-xs-12">
                        <button type="button" class="btn btn-default btn-block" data-dismiss="modal">キャンセル</button>
                    </div>
                    <div class="col-md-6 col-xs-12 smtop10">
                        <button type="button" class="btn btn-default btn-block okClick">OK</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Sendmail Full Modal -->
<div id="showSuccessModal" class="modal fade" role="dialog">
    <div class="modal-dialog  modal-sm">
        <!-- Modal content-->
        <div class="modal-content">
            <form role="form" method="POST" action="">
                <input name="_method" type="hidden" value="DELETE"/>
                {!! csrf_field() !!}
                <div class="modal-body text-center">
                    <p>依頼を確定します。</p>
                    <p>本当によろしいですか。</p>
                </div>
                <div class="modal-footer">
                    <div class="col-md-6 col-xs-12">
                        <button type="button" class="btn btn-default btn-block" data-dismiss="modal">キャンセル</button>
                    </div>
                    <div class="col-md-6 col-xs-12 smtop10">
                        <a href="{{ url('/admin/ot-requests/' . $requests->id . '/staff-sendmail') }}" class="btn btn-default btn-block" >OK</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(".btnDetail").click(function(){
        var request_id = $(this).attr('data-id');
        $("#showDetailModal").modal("show");
        // call ajax
        var url = "{!! url('/admin/ot-requests/') !!}/"+request_id+"/confirm-request";
        var html1 = "";
        var html2 = "";
        var html3 = "";
        $.ajax({
            type: "GET",
            url:url,
            success:function(data){
                $(".modal_id").html(data.id);
                $(".modal_funeral_funeral_name").html(data.funeral.funeral_name);
                $(".modal_funeral_name span").html(data.funeral_name);
                $(".modal_start_time").html(data.start_time);
                $(".modal_chief_name").html(data.chief_name);
                $(".modal_religious_faction span:nth-child(1)").html(data.religious);
                $(".modal_religious_faction span:nth-child(2)").html(data.faction);
                $(".modal_otera_name").html(data.otera_name);
                $(".modal_venue").html(data.venue);
                $(".modal_venue_address").html(data.venue_address);
                $(".modal_times_funeral").html(data.times_funeral);
                for (i = 0; i < data.classification_request.length ; i++){

                    if (data.classification_request[i].type_id == "1") {
                        html1 = html1 + "<p> "+data.classification_request[i].count_nin+
                            " &nbsp;&nbsp;名&nbsp;&nbsp;&nbsp; "+parseInt(data.classification_request[i].time_start.replace(/(AM|PM)/g,''))+
                            " 時 ～ &nbsp;"+parseInt(data.classification_request[i].time_end.replace(/(AM|PM)/g,''))+" 時 </p>";

                    }if (data.classification_request[i].type_id == "2") {
                        html2 = html2 + "<p> "+data.classification_request[i].count_nin+
                            " &nbsp;&nbsp;名&nbsp;&nbsp;&nbsp; ";
                        if(data.classification_request[i].time_start){
                            html2 = html2 + parseInt(data.classification_request[i].time_start.replace(/(AM|PM)/g,''));
                        }else{
                            html2 = html2 + '  ';
                        }
                        html2 = html2 + " 時 ～ &nbsp;"

                        if(data.classification_request[i].time_end){
                            html2 = html2 + parseInt(data.classification_request[i].time_end.replace(/(AM|PM)/g,''));
                        }else{
                            html2 = html2 + '  ';
                        }
                        html2 = html2    +" 時 </p>";
                    }

                    if (data.classification_request[i].type_id == "3") {
                        html3 = html3 + "<p> "+data.classification_request[i].count_nin+
                            " &nbsp;&nbsp;名&nbsp;&nbsp;&nbsp; ";

                        if(data.classification_request[i].time_start){
                            html3 = html3 + parseInt(data.classification_request[i].time_start.replace(/(AM|PM)/g,''));
                        }else{
                            html3 = html3 + '  ';
                        }
                        html3 = html3 + " 時 ～ &nbsp;"

                        if(data.classification_request[i].time_end){
                            html3 = html3 + parseInt(data.classification_request[i].time_end.replace(/(AM|PM)/g,''));
                        }else{
                            html3 = html3 + '  ';
                        }
                        html3 = html3    +" 時 </p>";
                    }
                }
                $(".modal_type_one").html(html1);
                $(".modal_type_two").html(html2);
                //$(".modal_type_three").html(html3);
                $(".modal_contact_matter").html(data.contact_matter.replace(/(?:\r\n|\r|\n)/g, '<br />'));
            }
        });
    });

    function changToShiNai(id){
        var urlChange = "{!! url('/admin/user-confirmed/delete/') !!}/"+id;
        // show modal
        $("#showDeleteModal").modal('show');
        // call ajax delete request confirmed
        $("#showDeleteModal button.okClick").click(function(){
            $("#showDeleteModal").modal('hide');
            $.ajax({
                type: "GET",
                url:urlChange,
                success:function(data){
                    window.location.reload();
                }
            });
        });
    }

    function changToSuru(id){
        var urlChange = "{!! url('/admin/user-confirmed/delete/') !!}/"+id;
        // call ajax delete request confirmed
        $.ajax({
            type: "GET",
            url:urlChange,
            success:function(data){
                //する
                window.location.reload();
            }
        });
    }
    $(function(){
        $(".sendMailSuccess").click(function(){
            $("#showSuccessModal").modal('show');
        });
    })
</script>
@endsection
