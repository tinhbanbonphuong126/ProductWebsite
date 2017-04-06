<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>派遣管理システム 派遣社員ログイン</title>

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
                    <h3 class="panel-title">派遣管理システム　派遣社員ログイン</h3>
                </div>
                <div class="panel-body" style="padding-top:60px; padding-bottom: 60px; ">
                    {!! Form::open(['route'=>'auth.postlogin','method'=>'POST','class'=>'form-horizontal']) !!}
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="email">ID:</label>
                            <div class="col-sm-9">
                                <input type="text" name="account_id" class="form-control" id="id" placeholder="ID">
                                {!! $errors->first('account_id', '<div class="txt_err">:message</div>') !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="pwd">パスワード:</label>
                            <div class="col-sm-9">
                                <input type="password" name="password" class="form-control" id="pwd" placeholder="パスワード">
                                {!! $errors->first('password', '<div class="txt_err">:message</div>') !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="pwd"></label>
                            <div class="col-sm-9">
                                <!-- Message -->
                                @if (!is_null(Session::get('message')))
                                    <p class="text-danger">{{ Session::get('message') }}</p>
                                    @endif
                                            <!-- End Message -->
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" class="btn btn-default btn-block">ログイン</button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- jQuery -->
{!! HTML::script('sb-admin/vendor/jquery/jquery.min.js') !!}

        <!-- Bootstrap Core JavaScript -->
{!! HTML::script('sb-admin/vendor/bootstrap/js/bootstrap.min.js') !!}

        <!-- Metis Menu Plugin JavaScript -->
{!! HTML::script('sb-admin/vendor/metisMenu/metisMenu.min.js') !!}

        <!-- Custom Theme JavaScript -->
{!! HTML::script('sb-admin/dist/js/sb-admin-2.js') !!}

</body>

</html>
