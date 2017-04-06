@extends('layouts.app')
@section('title')派遣管理システム　管理者@endsection
@section('header-title')派遣管理システム　管理者@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <h2>派遣社員選択 &nbsp;葬儀社名: {!! $undertaker->undertaker_name !!}</h2>
            <hr>
            <div class="form-group">
                <h2><b>司会・進行&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{!! $countNin1 !!}名</b></h2>
                <hr>
                <p>社員名</p>
                <div class="frame frame1" count-frame1="{!! $countNin1 !!}">
                    @if($userType1)
                        @foreach($userType1 as $user1)
                            @if(checkUserRequest($user1->id, $request->id, 1) == true)
                                @if(checkUserAgree($user1->id, $request->id, 1) == 0)
                                    <label class="checkbox-inline show-noconfirm">
                                        {!! HTML::image('sb-admin/dist/img/mail.gif',null,['width'=>'15']) !!}
                                        {!! $user1->name !!}</label>
                                @elseif(checkUserAgree($user1->id, $request->id, 1) == 1)
                                    <label class="checkbox-inline show-yes">{!! HTML::image('sb-admin/dist/img/yes.png',null,['width'=>'15']) !!} {!! $user1->name !!}</label>
                                @else
                                    <label class="checkbox-inline show-no">{!! HTML::image('sb-admin/dist/img/no.png',null,['width'=>'15']) !!} {!! $user1->name !!}</label>
                                @endif
                            @else
                                <label class="checkbox-inline">
                                    <input type="checkbox" value="{!! $user1->id !!}" user-name="{!! $user1->name !!}">{!! $user1->name !!}
                                </label>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="form-group">
                <h2><b>アシスタント&nbsp;&nbsp;&nbsp;{!! $countNin2 !!}名</b></h2>
                <hr>
                <p>社員名</p>
                <div class="frame frame2" count-frame2="{!! $countNin2 !!}">
                    @if($userType2)
                        @foreach($userType2 as $user2)
                            @if(checkUserRequest($user2->id, $request->id, 2) == true)
                                @if(checkUserAgree($user2->id, $request->id, 2) == 0)
                                    <label class="checkbox-inline show-noconfirm">
                                        {!! HTML::image('sb-admin/dist/img/mail.gif',null,['width'=>'15']) !!}
                                        {!! $user2->name !!}</label>
                                @elseif(checkUserAgree($user2->id, $request->id, 2) == 1)
                                    <label class="checkbox-inline show-yes">{!! HTML::image('sb-admin/dist/img/yes.png',null,['width'=>'15']) !!} {!! $user2->name !!}</label>
                                @else
                                    <label class="checkbox-inline show-no">{!! HTML::image('sb-admin/dist/img/no.png',null,['width'=>'15']) !!} {!! $user2->name !!}</label>
                                @endif
                            @else
                                <label class="checkbox-inline">
                                    <input type="checkbox" value="{!! $user2->id !!}" user-name="{!! $user2->name !!}">{!! $user2->name !!}
                                </label>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="form-group" style="padding-top: 50px;">
                <div class="col-sm-3 col-sm-offset-5">
                    <button class="btn btn-default btn-block submit-form" type="button">派遣を依頼する</button>
                </div>
            </div>
            <p>
            <p>
            <p>&nbsp;</p></p></p>
            <p>&nbsp;</p>
        </div>
    </div>

    <!-- Delete Modal -->
    <div id="showSubmitModal" class="modal fade" role="dialog">
        <div class="modal-dialog  modal-sm">
            <!-- Modal content-->
            <div class="modal-content">
                <form role="form" method="POST" action="">
                    {!! csrf_field() !!}
                    <div class="modal-body text-center">
                        <p>派遣社員に依頼を送信します。</p>
                        <p>本当によろしいですか。</p>
                        <div class="show-name"></div>
                        <input type="hidden" name="id_request" value="{!! $request->id !!}">
                        <input type="hidden" name="array_user_type_id">
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
        // submit button
        $(".submit-form").click(function () {
            var flag = 0;
            var html = '';
            var userId;
            var idData = []; // get all user_id checked
            var typeIdData = []; // get all type_id checked
            var url;
            var index;

            if (flag == 0) {
                // open modal and submit form
                $('#showSubmitModal').modal('show');

                // push frame1 (type_id = 1)
                $('.frame1 input[type="checkbox"]:checked').each(function () {
                    userId = $(this).val();
                    idData.push(userId);
                    typeIdData.push(userId + '=1');
                    html = html + "<p>" + $(this).attr('user-name') + "</p>";
                });

                // push frame2 (type_id = 2)
                $('.frame2 input[type="checkbox"]:checked').each(function () {
                    userId = $(this).val();
                    if (idData.indexOf(userId) == -1) {
                        idData.push(userId);
                        html = html + "<p>" + $(this).attr('user-name') + "</p>";
                    }
                    typeIdData.push(userId + '=2');
                });

                $('#showSubmitModal .show-name').html(html);
                $('#showSubmitModal input[name="array_user_type_id"]').val(typeIdData);

                url = "{!! URL::to('/admin/ot-requests') !!}/" + $("input[name='id_request']").val() + "/process-choose";
                $('#showSubmitModal form').attr('action', url);
            }
        });
    </script>
@endsection
