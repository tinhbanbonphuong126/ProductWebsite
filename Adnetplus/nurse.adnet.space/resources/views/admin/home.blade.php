@extends('admin.layouts.app-menu')

@section('title')
    スタッフ一覧
@endsection

@section('content')
    <div class="container">
        <!--Search form begin-->
        <form class="form-inline form-border" id="search-form">
            <h3>検索</h3>
            <div class="row vertical-align">
                <div class="col-sm-6 col-xs-12">
                    <label class="control-label" for="name">名前:</label>
                    <input type="text" class="form-control" name="name" placeholder="" value="{{$name}}" />
                </div>
                <div class="col-sm-3 col-xs-6">
                    <label class="control-label" for="sex">性別:</label>
                    <select class="form-control select-sex" name="sex" id="sex">
                        <option value=""></option>
                        <option {{ $sex == 'male' ? 'selected' : '' }} value="male">男</option>
                        <option {{ $sex == 'female' ? 'selected' : '' }} value="female">女</option>
                    </select>
                </div>
                <div class="col-sm-3 col-xs-6 bottom">
                    <button type="submit" class="btn btn-info" style="float: right;">検　索</button>
                </div>
            </div>
        </form>
        <!--Search form end-->

        <!--Employee list begin-->
        <div class="table-border form-border">
            <div class="text-right">
                <a href="{{ url('admin/staff/add') }}"><input type="button" class="btn btn-success" value="新規登録"/></a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th class="a-arrow">
                            <a href="{{ route('admin.sort.staffs', ['name' => $name, 'sex' => $sex, 'sort_by' => 'code', 'order_by' => $orderBy == 'asc' ? 'desc' : 'asc']) }}">
                                ID
                                    <div style="display: inline-block;">
                                        <div>
                                            <span class="arrow {{ empty($sortBy) || ($sortBy == 'code' && $orderBy == 'asc') ? 'show' : 'hide'}}"> &#9650;</span>
                                        </div>
                                        <div>
                                            <span class="arrow {{ $sortBy == 'code' && $orderBy == 'desc' ? 'show' : 'hide'}}"> &#9660;</span>
                                        </div>
                                    </div>
                            </a>
                        </th>
                        <th>スタッフ名</th>
                        <th>性 別</th>
                        <th class="a-arrow">
                            <a href="{{ route('admin.sort.staffs', ['name' => $name, 'sex' => $sex, 'sort_by' => 'date', 'order_by' => $orderBy == 'asc' ? 'desc' : 'asc']) }}">
                                最終更新日
                                    <div style="display: inline-block;">
                                        <div>
                                            <span class="arrow {{ $sortBy == 'date' && $orderBy == 'asc' ? 'show' : 'hide'}}"> &#9650;</span>
                                        </div>
                                        <div>
                                            <span class="arrow {{ $sortBy == 'date' && $orderBy == 'desc' ? 'show' : 'hide'}}"> &#9660;</span>
                                        </div>
                                    </div>
                            </a>
                        </th>
                        <th>最終入力者</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @if ($staffList->total() > 0)
                        @foreach($staffList as $row)
                        <tr>
                            
                            <td>{{ $row->code }}</td>
                            <td>{{ $row->name }}</td>
                            <td>@if($row->gender == 1) 男 @else 女 @endif</td>
                            <td>{{ $row->updated_at->format('Y.m.d') }}</td>
                            <td>{{ $row->updatedBy->name }}</td>
                            <td>
                                <a href="{{ url('admin/staff/edit/' . $row->id) }}"><input type="button" value="編　集" class="btn-sm btn btn-warning pull-right"/></a>
                            </td>
                        </tr>

                        @endforeach
                    @else
                        <tr>
                            
                            <td colspan="6"><span class="errors">※該当する人が見つかりませんでした。</span></td>
                        </tr>
                    @endif
                    </tbody>
                </table>

            </div>
        </div>

        <div class="pagination-wrapper">{!! $staffList->appends(['name' => $name, 'sex' => $sex, 'sort_by' => $sortBy, 'order_by' => $orderBy])->render() !!}</div>
        <!--Employee list end-->
    </div>
@endsection
