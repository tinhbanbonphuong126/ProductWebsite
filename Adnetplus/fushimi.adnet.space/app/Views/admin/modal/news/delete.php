<div class="modal fade delete" role="dialog">
    <div class="modal-dialog modal-sm modal-user">
            <input type="hidden" name="id">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-group">
                        <h4 style="text-align: center;">一度削除したデータは元に戻せません。<br/>
                            本当によろしいですか。
                        </h4>
                    </div>
                </div>
                <div class="modal-footer">
                    <form class="form-horizontal" method="post" action="<?= url('admin/news/delete') ?>">
                        <input type="hidden" id="id" name="id" value="">
                        <button type="button" class="btn btn-default" data-dismiss="modal">キャンセル</button>
                        <button type="submit" class="btn btn-primary btn-ok"> OK </button>
                    </form>
                </div>
            </div>
    </div>
</div>