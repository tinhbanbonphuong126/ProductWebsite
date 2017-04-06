<div class="form-border" style="font-size: 20px;">
    <div><span class="simsum">ID:&nbsp;&nbsp;</span>{{ $user->code }}</div>
    <div class="row">
        <div class="col-sm-3">名前:&nbsp;&nbsp;{{ $user->name }}</div>
        <div class="col-sm-2">
            性別:&nbsp;&nbsp;@if($user->gender == 1) 男 @else 女 @endif
        </div>
        <div class="col-sm-5">生年月日:&nbsp;&nbsp;{{ $user->birth_date }}</div>
    </div>
    <div class="row">
        <div class="col-sm-5">住所:&nbsp;&nbsp;{{ $user->address }}</div>
        <div class="col-sm-5">
            電話番号:&nbsp;&nbsp;{{ $user->tel }}
        </div>
    </div>
</div>