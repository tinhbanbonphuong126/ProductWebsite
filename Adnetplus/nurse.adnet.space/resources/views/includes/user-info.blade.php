<div class="form-border" style="font-size: 20px;">
    <div><span class="simsum">@lang('messages.user-detail.id'):&nbsp;&nbsp;</span>{{ $user->code }}</div>
    <div class="row">
        <div class="col-sm-4">@lang('messages.user-detail.name'):&nbsp;&nbsp;{{ $user->name }}</div>
        <div class="col-sm-3">
            @lang('messages.user-detail.gender'):&nbsp;&nbsp;
            @if($user->gender == 1) @lang('messages.list.gender.male') @else @lang('messages.list.gender.female')@endif
        </div>
        <div class="col-sm-5">@lang('messages.user-detail.birth-date'):&nbsp;&nbsp;{{ $user->birth_date }}</div>
    </div>
</div>