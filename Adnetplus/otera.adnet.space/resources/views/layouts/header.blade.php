<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>

    <!-- Bootstrap Core CSS -->
    {!! HTML::style('sb-admin/vendor/bootstrap/css/bootstrap.min.css') !!}

    <!-- MetisMenu CSS -->
    {!! HTML::style('sb-admin/vendor/metisMenu/metisMenu.min.css') !!}

    <!-- Custom CSS -->
    {!! HTML::style('sb-admin/dist/css/sb-admin-2.css') !!}

    {!! HTML::style('sb-admin/dist/css/admin.css') !!}

    <!-- Custom Fonts -->
    {!! HTML::style('sb-admin/vendor/font-awesome/css/font-awesome.min.css') !!}

            <!-- datepicker -->
    {!! HTML::style('sb-admin/dist/css/jquery-ui.css') !!}
    {!! HTML::style('sb-admin/dist/css/jquery-ui-timepicker-addon.css') !!}

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery -->
    {!! HTML::script('sb-admin/js/jquery.min.js') !!}

    {!! HTML::script('sb-admin/dist/js/jquery-ui.min.js') !!}

    {!! HTML::script('sb-admin/dist/js/jquery-ui-timepicker-addon.js') !!}
    {!! HTML::script('sb-admin/dist/js/jquery-ui-sliderAccess.js') !!}
    {!! HTML::script('sb-admin/dist/js/jquery-ui-timepicker-ja.js') !!}
</head>

<body>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{!! route('admin.users.index') !!}">@yield('header-title')</a>
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">
        </ul>
        <!-- /.navbar-top-links -->

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <!-- admin -->
                    <li>
                        <a href="{!! route('admin.users.index') !!}">派遣社員管理</a>
                    </li>
                    <li>
                        <a href="{!! route('admin.undertaker.index') !!}">葬儀社管理</a>
                    </li>
                    <li>
                        <a href="{!! route('admin.ot-requests.index') !!}">依頼管理</a>
                    </li>
                    <!-- common -->
                    <li>
                        <a href="{!! route('auth.logout') !!}">ログアウト</a>
                    </li>
                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>