@extends('admin.layouts.app-detail')

@section('title')
    利用者詳細・カレンダー
@endsection

@section('content')
    <div class="table-border form-border">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr id="fix-size-column" style="border: 1px solid #ddd;">
                    <th>月</th>
                    <th>火</th>
                    <th>水</th>
                    <th>木</th>
                    <th>金</th>
                    <th style="color: #0000ff">土</th>
                    <th style="color: #ff0000">日</th>
                </tr>
                </thead>
                <tbody id="fix-height-td">
                <tr>
                    @foreach($weekDays as $day)
                        <td>{{ $day }}</td>
                    @endforeach
                </tr>
                <tr>
                    @foreach($weekDays as $idx => $day)
                        @if (isCurrentDate($day))
                            <td>
                                @if (!checkCurrentMedicalRecord($user->id))
                                    <p>
                                        <a href="{{ url('admin/medical-record/add/' . $user->id) }}">
                                            <input type="button" value="入　力" class="btn btn-success"/>
                                        </a>
                                    </p>
                                @else
                                    <p>
                                        <a href="{{ url('admin/medical-record/edit/' . $user->id . '/' . date('Y-m-d')) }}">
                                            <input type="button" value="編　集" class="btn btn-warning"/>
                                        </a>
                                    </p>
                                @endif
                            </td>
                        @elseif (isPreviousDate($day))
                            <td>
                                @if (checkMedicalRecordDetail($user->id, $idx))
                                    <p>
                                        <a href="{{ url('admin/medical-record/show/'. $user->id . '/' . getSpecificDate($idx)) }}">
                                            <input type="button" value="詳　細" class="btn btn-primary"/>
                                        </a>
                                    </p>
                                    <p>
                                        <a href="{{ url('admin/medical-record/edit/' . $user->id . '/' . getSpecificDate($idx)) }}">
                                            <input type="button" value="編　集" class="btn btn-warning"/>
                                        </a>
                                    </p>
                                @endif
                            </td>
                        @else
                            <td></td>
                        @endif
                    @endforeach
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div id="next-back-week">
            <div class="col-sm-2">
                <a href="{{ action('Admin\UsersController@calendar', ['id' => $user->id, 'w' => 'prev']) }}" class="text-center center-block btn btn-success">先週</a>
            </div>
            <div class="col-sm-3"></div>
            <div class="col-sm-2">
                <a href="{{ action('Admin\UsersController@calendar', ['id' => $user->id, 'w' => 'current']) }}" class="text-center center-block btn btn-success">今週</a>
            </div>
            <div class="col-sm-3"></div>
            <div class="col-sm-2">
                <a href="{{ action('Admin\UsersController@calendar', ['id' => $user->id, 'w' => 'next']) }}" class="text-center center-block btn btn-success">次週</a>
            </div>
        </div>
        <div class="back-btn" style="padding-top: 10px; margin-left: 14px;">
            <a href="{{ url('admin/user') }}" style="width: 70px;" class="btn btn-default">戻る</a>
        </div>
        <div class="clear-fix-20"></div>
    </div>
@endsection

@section('script')
@endsection