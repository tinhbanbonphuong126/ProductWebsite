@extends('layouts.app')
@section('title')派遣管理システム　管理者@endsection
@section('header-title')派遣管理システム　管理者@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <h1>依頼確認（スタッフ派遣発注書 {{ $curYear }}年{{ $curMonth }}月{{ $curDay }}日）</h1>
        <hr>
        <div class="table-responsive">
            <table class="table no-border">
                <tbody>
                    <tr>
                        <td>ID</td>
                        <td>{{ $otrequest->id }}</td>
                    </tr>
                    <tr>
                        <td width="30%">葬儀法要の種類</td>
                        <td> {{ $otrequest->funeral->funeral_name }} </td>
                    </tr>
                    <tr>
                        <th colspan="2">式について</th>
                    </tr>
                    <tr>
                        <td>式名</td>
                        <td> 故 &nbsp;&nbsp;{{ $otrequest->funeral_name }}</td>
                    </tr>
                    <tr>
                        <td>開式時間</td>
                        <td> {{ date('Y/m/d H:i',strtotime($otrequest->start_time)) }} </td>
                    </tr>
                    <tr>
                        <td>喪主名</td>
                        <td> {{ $otrequest->chief_name }} </td>
                    </tr>
                    <tr>
                        <td>宗派</td>
                        <td> {{ $otrequest->religious }} &nbsp;&nbsp;&nbsp;宗 &nbsp;&nbsp;{{ $otrequest->faction }} &nbsp;&nbsp;&nbsp;派</td>
                    </tr>
                    <tr>
                        <td>寺院名</td>
                        <td> {{ $otrequest->otera_name }} </td>
                    </tr>
                    <tr>
                        <td>会場名</td>
                        <td> {{ $otrequest->venue }} </td>
                    </tr>
                    <tr>
                        <td>会場詳細</td>
                        <td> {{ $otrequest->venue_address }} </td>
                    </tr>
                    <tr>
                        <td>回葬予想人数</td>
                        <td> 約&nbsp;&nbsp; {{ $otrequest->times_funeral }} &nbsp;&nbsp;名 </td>
                    </tr>
                    <tr>
                        <th colspan="2">発注業務</th>
                    </tr>
                    <tr>
                        <td>司会・進行</td>
                        <td>
                            @if(!is_null($otrequest->classification_request))
                                @foreach($otrequest->classification_request as $item)
                                    @if($item->type_id == 1)
                                        <p> {!! $item->count_nin !!} &nbsp;&nbsp;名&nbsp;&nbsp;&nbsp;{!! $item->time_start !!} 時 ～ &nbsp;{!! $item->time_end !!} 時 </p>
                                    @endif
                                @endforeach
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>アシスタント</td>
                        <td>
                            @if(!is_null($otrequest->classification_request))
                                @foreach($otrequest->classification_request as $item)
                                    @if($item->type_id == 2)
                                        <p> {!! $item->count_nin !!} &nbsp;&nbsp;名&nbsp;&nbsp;&nbsp;{!! $item->time_start !!} 時 ～ &nbsp;{!! $item->time_end !!} 時 </p>
                                    @endif
                                @endforeach
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>連絡事項</td>
                        <td> {{ $otrequest->contact_matter }} </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="form-group">
            <div class="col-sm-3 col-xs-12 pull-left">
                <a href="{!! route('admin.ot-requests.index') !!}" class="btn btn-default btn-block">戻る</a>
            </div>
            @if($otrequest->status == 0)
            <div class="col-sm-3 col-xs-12 smtop10 pull-right">
                <a class="btn btn-default btn-block"  href="{{ url('/admin/ot-requests/' . $otrequest->id . '/choose') }}">派遣社員を選ぶ</a>
            </div>
            @endif
        </div>
        <p><p><p>&nbsp;</p></p></p>
        <p>&nbsp;</p>
    </div>
</div>
@endsection
