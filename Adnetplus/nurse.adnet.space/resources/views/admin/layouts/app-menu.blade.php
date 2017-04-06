<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Page Description">
    <meta name="author" content="QUE">
    <title>@yield('title')</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"/>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <!--<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>-->
    <!--<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>-->
    <![endif]-->
</head>
<body class="bg-color">
    <div id="top-header">
        <!--Header page begin-->
        <div class="container">
            <div class="row">
                <div class="col-sm-5">
                    <h2 class="bold top-header">@yield('title')</h2>
                </div>
                <div class="col-sm-5 text-center pull-right top-navbar">
                    <div class="pull-right">
                        <span><a href="{{ url('admin/staff') }}">【 スタッフ一覧 】</a></span>
                        <span><a href="{{ url('admin/user') }}">【 利用者一覧 】</a></span>
                        <span><a href="{{ url('admin/medical-record-format/meal') }}">【 カルテテンプレート一覧 】</a></span>
                    </div>
                    <div class="clear-fix"></div>
                    <div>
                        <a href="{{ url('/admin/logout') }}" class="logout">ログアウト</a>
                    </div>
                </div>
            </div>
        </div>
        <!--End header page-->
    </div>

    @yield('content')

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/datepicker-ja.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

    @yield('script')
</body>
</html>
