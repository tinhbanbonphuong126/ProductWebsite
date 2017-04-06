<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>派遣管理システム ログイン</title>

    <!-- Bootstrap Core CSS -->
    {!! HTML::style('sb-admin/vendor/bootstrap/css/bootstrap.min.css') !!}

            <!-- MetisMenu CSS -->
    {!! HTML::style('sb-admin/vendor/metisMenu/metisMenu.min.css') !!}

            <!-- Custom CSS -->
    {!! HTML::style('sb-admin/dist/css/sb-admin-2.css') !!}

            <!-- admin css -->
    {!! HTML::style('sb-admin/dist/css/admin.css') !!}

            <!-- Custom Fonts -->
    {!! HTML::style('sb-admin/vendor/font-awesome/css/font-awesome.min.css') !!}

            <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">派遣管理システム　ログイン</h3>
                </div>
                <div class="panel-body" style="padding-top:60px; padding-bottom: 60px; ">
                    <form method="post" action="" class="form-horizontal" >
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="email">ID:</label>
                            <div class="col-sm-9 account_id">
                                <input type="text" name="account_id" class="form-control" id="id" placeholder="ID">
                                <div class="txt_err"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="pwd">パスワード:</label>
                            <div class="col-sm-9 password">
                                <input type="password" name="password" class="form-control" id="pwd" placeholder="パスワード">
                                <div class="txt_err"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="pwd"></label>
                            <div class="col-sm-9 notExitsAccount">
                                <!-- Message -->
                                @if (!is_null(Session::get('message')))
                                    <p class="text-danger">{{ Session::get('message') }}</p>
                                    @endif
                                <!-- End Message -->
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="button" class="btn btn-default btn-block loginBtn">ログイン</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- jQuery -->
{!! HTML::script('sb-admin/vendor/jquery/jquery.min.js') !!}

<script>
    var url_admin = "{!! route('auth.postlogin') !!}";
    var url_client = "{!! route('undertaker.postlogin') !!}";
    $(".loginBtn").click(function(){
        // check empty
        var flag = 0;
        if ($("input[name='password']").val() == ''){
            flag = 1;
            $(".password .txt_err").html('<div class="txt_err">パスワードは必須です。</div>');
        }
        if ($("input[name='account_id']").val() == ''){
            flag = 1;
            $(".account_id .txt_err").html('<div class="txt_err">IDは必須です。</div>');
        }
        // check login
        if(flag == 0){
            console.log('dddddddddddd');
            var url_check = "{!! route('check.user') !!}";
            $.ajax({
                type: "GET",
                url:url_check+"?account_id="+$("input[name='account_id']").val()+"&password="+$("input[name='password']").val(),
                success:function(data){
                    if (data == "ok"){
                        $("form").attr('action',url_admin);
                        $("form").submit();
                    }else{
                        $("form").attr('action',url_client);
                        $("form").submit();
                    }
                }
            });
        }
    });

</script>

        <!-- Bootstrap Core JavaScript -->
{!! HTML::script('sb-admin/vendor/bootstrap/js/bootstrap.min.js') !!}

        <!-- Metis Menu Plugin JavaScript -->
{!! HTML::script('sb-admin/vendor/metisMenu/metisMenu.min.js') !!}

        <!-- Custom Theme JavaScript -->
{!! HTML::script('sb-admin/dist/js/sb-admin-2.js') !!}
</body>

</html>
