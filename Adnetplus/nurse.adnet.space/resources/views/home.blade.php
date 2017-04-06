@extends('layouts.app-two')

@section('title')
    @lang('messages.user-list.title')
@endsection

@section('content')
    <!--Search form begin-->
    <form class="form-inline form-border" id="search-form" action="{{ url('/search') }}" method="get">
        <input type="hidden" name="sort_by" value="{{ $sortBy }}">
        <input type="hidden" name="order_by" value="{{ $orderBy }}">
        <h3>@lang('messages.user-list.search.title')</h3>
        <div class="row vertical-align">
            <div class="col-sm-6 col-xs-12">
                <label class="control-label" for="name">@lang('messages.user-list.search.name'):</label>
                <input type="text" class="form-control" id="name" name="name" value="{!! $name !!}" placeholder="">
            </div>
            <div class="col-sm-3 col-xs-6">
                <label class="control-label" for="sex">@lang('messages.user-list.search.gender'):</label>
                <select class="form-control select-sex" name="sex" id="sex">
                    <option value=""></option>
                    <option value="male" @if($sex == 'male') selected @endif>@lang('messages.list.gender.male')</option>
                    <option value="female" @if($sex == 'female') selected @endif>@lang('messages.list.gender.female')</option>
                </select>
            </div>
            <div class="col-sm-3 col-xs-6 bottom">
                <button type="submit" class="btn btn-info">@lang('messages.user-list.search.button')</button>
            </div>
        </div>
    </form>
    <!--Search form end-->

    <!--Employee list begin-->
    <div class="table-border form-border">
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th class="a-arrow">
                        <a href="{{ route('search.users', ['name' => $name, 'sex' => $sex, 'sort_by' => 'code', 'order_by' => $orderBy == 'asc' ? 'desc' : 'asc']) }}">
                            @lang('messages.user-list.result.id')
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
                    <th>@lang('messages.user-list.result.name')</th>
                    <th>@lang('messages.user-list.result.gender')</th>
                    <th class="a-arrow">
                        <a href="{{ route('search.users', ['name' => $name, 'sex' => $sex, 'sort_by' => 'date', 'order_by' => $orderBy == 'asc' ? 'desc' : 'asc']) }}">
                            @lang('messages.user-list.result.last-modification')
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
                    <th>@lang('messages.user-list.result.modifier')</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @if ($userList->total() > 0)
                    @foreach($userList as $user)
                        <tr>
                            <td>{{ $user->code }}</td>
                            <td>{{ $user->name }}</td>
                            <td>@if($user->gender == 1) @lang('messages.list.gender.male') @else @lang('messages.list.gender.female') @endif</td>
                            <td>{{ $user->updated_at->format('Y.m.d') }}</td>
                            <td>{{ $user->updatedBy->name }}</td>
                            <td>
                                <a href="{{ url('user/show/' . $user->id) }}"><input type="button" value="@lang('messages.user-list.result.detail')" class="btn btn-primary"/></a>
                                <a href="{{ url('user/calendar/' . $user->id) }}"><input type="button" value="@lang('messages.user-list.result.edit')" class="btn btn-success"/></a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <td colspan="6"><span class="errors">@lang('messages.user-list.no-result')</span></td>
                @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-12 col-xs-12">
        <div class="pagination-wrapper">{!! $userList->appends(['name' => $name, 'sex' => $sex, 'sort_by' => $sortBy, 'order_by' => $orderBy])->render() !!}</div>
    </div>
    <!--Employee list end-->
@endsection