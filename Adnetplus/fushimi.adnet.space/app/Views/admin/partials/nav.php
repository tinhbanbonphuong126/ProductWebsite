<div id="nav-vetical">
    <div class="sidebar-nav">
        <div class="navbar navbar-default" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <span class="visible-xs navbar-brand">タイトル</span>
            </div>
            <div class="navbar-collapse collapse sidebar-navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="menu <?= isActiveMenu('admin/home') ? 'active' : '' ?>"><a href="<?= url('admin/home') ?>">ニュースリリース・お知らせ</a></li>
                    <li class="menu <?= isActiveMenu('admin/topic') ? 'active' : '' ?>"><a href="<?= url('admin/topic') ?>">医薬品トピックス</a></li>
                    <li class="menu"><a href="<?= url('admin/logout') ?>">ログアウト</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<script>
    /*
    function isActiveMenu(name) {
        var pathArray = window.location.pathname.split('/');
        return pathArray.indexOf(name) > -1
    }
    $(document).ready(function () {
        $(".menu").each(function () {
            var link = $(this).find("a").attr('href');
            var name = link.substr(link.lastIndexOf('/') + 1);
            if (isActiveMenu(name)) {
                $(this).addClass('active');
            } else {
                $(this).removeClass('active');
            }
        });
    });
    */
</script>