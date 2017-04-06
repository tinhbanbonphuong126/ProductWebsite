<div class="modal fade create" role="dialog" id="dlgCreate">
    <div class="modal-dialog modal-sm modal-user">
        <div class="modal-content">
            <div class="modal-body">
                <form class="form-horizontal" method="post" action="<?= url('admin/news/create') ?>" id="frmCreate">
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="id"><span class="color-red">※</span>タイトル</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="title" id="id" placeholder="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="id"><span class="color-red">※</span>日付</label>
                        <div class="col-sm-9">
                            <div class='input-group date'>
                                <input type='text' name="news_date" class="form-control" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="category"><span class="color-red">※</span>種類</label>
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
        $(".modal.create .btn-ok").bind('click', function () {
            $("#frmCreate").submit();
        });
    });
</script>