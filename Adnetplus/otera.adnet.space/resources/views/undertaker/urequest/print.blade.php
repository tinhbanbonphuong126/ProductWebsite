@extends('layouts.app-one')
@section('title')派遣管理システム　{!! $undertaker->undertaker_name !!}@endsection
@section('header-title')派遣管理システム　{!! $undertaker->undertaker_name !!}@endsection
@section('content')
<div class="row">
    <h2>新規依頼-確認画面</h2>
    <hr/>
    <div class="col-md-12">
        {!! Form::open(['route' => 'undertaker.urequestconfirm', 'class' => 'form-horizontal', 'files' => true]) !!}
        {!! Form::hidden('undertaker_id',$undertaker->id) !!}
            <div class="table-responsive">
                <table class="table no-border">
                    <tbody>
                    <tr>
                        <td width="20%">葬儀法要の種類</td>
                        <td>
                            {{ getNameByFuneralId($requestData['funeral_id']) }}
                            {!! Form::hidden('funeral_id',$requestData['funeral_id']) !!}
                        </td>
                    </tr>
                    <tr>
                        <th colspan="2">式について</th>
                    </tr>
                    <tr>
                        <td>式名</td>
                        <td>
                            故 &nbsp;&nbsp;{{ $requestData['funeral_name'] }}
                            {!! Form::hidden('funeral_name',$requestData['funeral_name']) !!}
                        </td>
                    </tr>
                    <tr>
                        <td>開式時間</td>
                        <td>
                            {{ date('Y/m/d H:i',strtotime($requestData['start_time'])) }}
                            {!! Form::hidden('start_time',$requestData['start_time']) !!}
                        </td>
                    </tr>
                    <tr>
                        <td>喪主名</td>
                        <td>
                            {{ $requestData['chief_name'] }}
                            {!! Form::hidden('chief_name',$requestData['chief_name']) !!}
                        </td>
                    </tr>
                    <tr>
                        <td>宗派</td>
                        <td>
                            {{ $requestData['religious'] }}
                            &nbsp;&nbsp;&nbsp;宗
                            &nbsp;&nbsp;
                            {{ $requestData['faction'] }}
                            &nbsp;&nbsp;&nbsp;派
                            {!! Form::hidden('religious',$requestData['religious']) !!}
                            {!! Form::hidden('faction',$requestData['faction']) !!}
                        </td>
                    </tr>
                    <tr>
                        <td>寺院名</td>
                        <td>
                            {{ $requestData['otera_name'] }}
                            {!! Form::hidden('otera_name',$requestData['otera_name']) !!}
                        </td>
                    </tr>
                    <tr>
                        <td>会場名</td>
                        <td>
                            {{ $requestData['venue'] }}
                            {!! Form::hidden('venue',$requestData['venue']) !!}
                        </td>
                    </tr>
                    <tr>
                        <td>会場詳細</td>
                        <td>
                            {{ $requestData['venue_address'] }}
                            {!! Form::hidden('venue_address',$requestData['venue_address']) !!}
                        </td>
                    </tr>
                    <tr>
                        <td>回葬予想人数</td>
                        <td> 約&nbsp;&nbsp;
                            {{ $requestData['times_funeral'] }}
                            &nbsp;&nbsp;名
                            {!! Form::hidden('times_funeral',$requestData['times_funeral']) !!}
                        </td>
                    </tr>
                    <tr>
                        <th colspan="2">発注業務</th>
                    </tr>
                    <tr>
                        {!! Form::hidden('request_1_type_id',1) !!}
                        {!! Form::hidden('request_2_type_id',2) !!}
                        {!! Form::hidden('request_3_type_id',3) !!}
                        {!! Form::hidden('request_4_type_id',3) !!}
                        <td style="display: none">導師（僧侶）</td>
                        <td  style="display: none">
                            <p>
                                {{ isset($requestData['request_1_count_nin'])? $requestData['request_1_count_nin']: ''  }}
                                &nbsp;&nbsp;名&nbsp;&nbsp;&nbsp;
                                {{ removeAmPM(isset($requestData['request_1_time_start']) ? $requestData['request_1_time_start']: '') }}
                                時 ～ &nbsp;
                                {{ removeAmPM(isset($requestData['request_1_time_end'])?$requestData['request_1_time_end']: '') }}
                                時
                                {!! Form::hidden('request_1_count_nin',isset($requestData['request_1_count_nin']) ? $requestData['request_1_count_nin']: '') !!}
                                {!! Form::hidden('request_1_time_start',isset($requestData['request_1_time_start']) ? $requestData['request_1_time_start']: '') !!}
                                {!! Form::hidden('request_1_time_end',isset($requestData['request_1_time_end']) ? $requestData['request_1_time_end'] : '') !!}
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>司会・進行</td>
                        <td>
                            <p>
                                {{ $requestData['request_2_count_nin'] }}
                                &nbsp;&nbsp;名&nbsp;&nbsp;&nbsp;
                                {{ removeAmPM($requestData['request_2_time_start']) }}
                                時 ～ &nbsp;
                                {{ removeAmPM($requestData['request_2_time_end']) }}
                                時
                                {!! Form::hidden('request_2_count_nin',$requestData['request_2_count_nin']) !!}
                                {!! Form::hidden('request_2_time_start',$requestData['request_2_time_start']) !!}
                                {!! Form::hidden('request_2_time_end',$requestData['request_2_time_end']) !!}
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>アシスタント</td>
                        <td>
                            <p>
                                {{ $requestData['request_3_count_nin'] }}
                                &nbsp;&nbsp;名&nbsp;&nbsp;&nbsp;
                                {{ removeAmPM($requestData['request_3_time_start']) }}
                                時 ～ &nbsp;
                                {{ removeAmPM($requestData['request_3_time_end']) }}
                                時
                                {!! Form::hidden('request_3_count_nin',$requestData['request_3_count_nin']) !!}
                                {!! Form::hidden('request_3_time_start',$requestData['request_3_time_start']) !!}
                                {!! Form::hidden('request_3_time_end',$requestData['request_3_time_end']) !!}
                            </p>
                            <p>
                                {{ $requestData['request_4_count_nin'] }}
                                &nbsp;&nbsp;名&nbsp;&nbsp;&nbsp;
                                {{ removeAmPM($requestData['request_4_time_start']) }}
                                時 ～ &nbsp;
                                {{ removeAmPM($requestData['request_4_time_end']) }}
                                時
                                {!! Form::hidden('request_4_count_nin',$requestData['request_4_count_nin']) !!}
                                {!! Form::hidden('request_4_time_start',$requestData['request_4_time_start']) !!}
                                {!! Form::hidden('request_4_time_end',$requestData['request_4_time_end']) !!}
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>連絡事項</td>
                        <td>
                            <?php echo nl2br($requestData['contact_matter']); ?>
                            {!! Form::hidden('contact_matter',$requestData['contact_matter']) !!}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="col-sm-2 col-xs-12">
                                <a style="cursor: pointer" class="btn btn-default btn-block" onclick="history.go(-1);">キャンセル</a>
                            </div>
                            <div class="col-sm-2 col-xs-12">
                                <a style="cursor: pointer;" class="btn btn-default btn-block">印刷する</a>
                            </div>
                            <div class="col-sm-2 col-xs-12 smtop10">
                                <button class="btn btn-default btn-block" type="submit">依頼する</button>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection
