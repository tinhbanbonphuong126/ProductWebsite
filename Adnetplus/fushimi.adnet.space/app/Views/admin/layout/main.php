<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Page Description">
    <meta name="author" content="">
    <title>ログイン</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?= asset('css/admin/reset.css') ?>"/>
    <link rel="stylesheet" href="<?= asset('css/bootstrap.min.v3.3.7.css') ?>"/>
    <link rel="stylesheet" href="<?= asset('css/admin/bootstrap-datepicker.min.css') ?>"/>
    <link rel="stylesheet" href="<?= asset('css/admin/style.css') ?>"/>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <!--<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>-->
    <!--<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>-->
    <!--<![endif]&ndash;&gt;-->

    <script src="<?= asset('js/admin/jquery.min.js') ?>" type="text/javascript"></script>
    <script src="<?= asset('js/admin/bootstrap.min.js') ?>" type="text/javascript"></script>
    <script src="<?= asset('js/admin/moment.js') ?>" type="text/javascript"></script>
    <script src="<?= asset('js/admin/bootstrap-datepicker.min.js') ?>" type="text/javascript"></script>
    <script src="<?= asset('js/admin/bootstrap-datepicker.ja.min.js') ?>" type="text/javascript"></script>
    <script type="text/javascript">
        var APP_URL = '<?= APP_URL ?>';
        $(document).ready(function() {
            $('.date').datepicker({
                format: 'yyyy.mm.dd',
                language: 'ja',
                startDate: '1950.01.01',
                endDate: '2050.12.31',
                //viewMode: "years",
                //startView: "years",
                autoclose: true
            });
        });
    </script>
</head>
<body>
<?php partial('header_main'); ?>
<div class="clear-fix"></div>
<?php partial('nav'); ?>
<?= $view ?>
</body>
</html>