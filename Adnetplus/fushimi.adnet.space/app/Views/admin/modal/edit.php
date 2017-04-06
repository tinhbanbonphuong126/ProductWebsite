<div class="modal fade edit" role="dialog">
    <div class="modal-dialog modal-lg modal-user">
        <div class="modal-content">
            <div class="modal-body">
                <form class="form-horizontal" method="post" action="<?= url('admin/news/update') ?>" id="frmEdit">
                    <input type="hidden" name="id" value="">
                    <div class="form-group">
                        <label class="control-label col-md-3"><span class="color-red">※</span>タイトル (Japanese)</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="title_ja">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3"><span class="color-red">※</span>タイトル (English)</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="title_en">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3"><span class="color-red">※</span>タイトル (Chinese)</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="title_cn">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3"><span class="color-red">※</span>日付</label>
                        <div class="col-sm-9">
                            <div class='input-group date'>
                                <input type='text' class="form-control" name="news_date"/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3"><span class="color-red">※</span>種類</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="category_id">
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?= h($category->id)  ?>"><?= h($category->name) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">キャンセル</button>
                <button type="button" class="btn btn-primary btn-ok"> OK </button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $(".modal.edit .btn-ok").bind('click', function () {
            $("#frmEdit").submit();
        });
    });
</script>