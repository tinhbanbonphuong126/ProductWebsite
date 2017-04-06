<div class="modal fade edit" role="dialog">
    <div class="modal-dialog modal-lg modal-user">
        <div class="modal-content">
            <div class="modal-body">
                <form class="form-horizontal" method="post" action="<?= url('admin/news/update') ?>" id="frmEdit" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="">
                    <div class="form-group">
                        <label class="control-label col-md-3">タイトル (Japanese)</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control edit" name="title_ja" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">タイトル (English)</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control edit" name="title_en">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">タイトル (Chinese)</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control edit" name="title_cn">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3"><span class="color-red">※</span>日付</label>
                        <div class="col-sm-9">
                            <div class='input-group date edit'>
                                <input type='text' class="form-control edit" name="news_date" required/>
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
                    <div class="form-group">
                        <label class="control-label col-sm-3">PDF</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input type="text" class="form-control" readonly name="file_name" value="" id="file_name_edit"/>
                                <span style="overflow-x: hidden" class="input-group-btn ">
                                    <label id="file-choice" for="upload_edit" class="btn btn-success">参照</label>
                                </span>
                                <span style="overflow-x: hidden" class="input-group-btn ">
                                    <label class="btn btn-danger file-cancel edit">X</label>
                                </span>
                            </div>
                            <input accept="application/pdf, pdf" required type="file" name="pdf_link" id="upload_edit" class="form-control hide edit"/>
                            <label id="status"></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">URL</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control edit" name="url_link">
                        </div>
                    </div>
                    <div class="form-group" id="edit-error-message">
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
            var isValidated = true;
            $("#edit-error-message").empty();
            $(".error-message").remove();
            var titleJa = $(".edit[name=title_ja]").val();
            if (titleJa.trim().length == 0) {
                var html = '<span class="color-red error-message">必須項目を入力してください。</span>';
                $(".edit[name=title_ja]").after(html);
                isValidated = false;
            }

            var  newsDate = $(".edit[name=news_date]").val();
            if (newsDate.trim().length == 0) {
                var html = '<div class="error-message"><span class="color-red">必須項目を入力してください。</span></div>';
                $(".input-group.date.edit").after(html);
                isValidated = false;
            }

            var pdfLink = $("#file_name_edit").val();
            var url = $(".edit[name=url_link]").val();
            if (pdfLink.length > 0 && url.length > 0) {
                var html = '<label class="control-label col-md-12"><span class="color-red error-message">PDFかURLのいずれだけに入力してください。</span></label>';
                $("#edit-error-message").append(html);
                isValidated = false;
            }
            if (isValidated) {
                $("#frmEdit").submit();
            }
        });

        $(".file-cancel.edit").bind('click', function () {
            $("input[name=pdf_link].edit").val("");
            $("#file_name_edit").val("");
        });
    });

    //display pdf file name
    $(function() {
        $('#upload_edit').change(function(e){
            var fileName = $(this).val();
            var index = fileName.lastIndexOf("\\");
            var name = fileName.substring(index + 1);
            $("#file_name_edit").val(name);
        });
    });
</script>