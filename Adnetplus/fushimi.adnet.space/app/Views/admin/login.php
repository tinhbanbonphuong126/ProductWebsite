<div id="login">
    <div class="container">
        <div class="row">
            <div id="login-form" class="col-xs-12 col-sm-12 col-md-offset-3 col-md-6 col-lg-offset-3 col-lg-6">
                <form class="form-horizontal" method="post" action="<?= url('admin/login') ?>">
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                            <h4>管理者ログイン</h4>
                        </div>
                    </div>
                    <?php if (isset($errors) && count($errors) > 0): ?>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9" style="color: red;">※IDまたはPASSが間違っています</div>
                    </div>
                    <?php endif ?>
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="id">ID :</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="code" placeholder="ID入力">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="pwd">パスワード :</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" name="password" placeholder="パスワード入力">
                        </div>
                    </div>
                    <div class="clear-fix-10"></div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                            <button type="submit" class="btn btn-success pull-right w100">ログイン</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>