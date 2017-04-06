<div id="main-content">
    <div class="table-responsive" id="table-note">
        <h2 class="big-title">トピックリリース・お知らせ</h2>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <button type="button" class="btn btn-success btn-sm pull-right btn-create">新規登録</button>
                <tr>
                    <th>トピックリリース・お知らせ</th>
                    <th>種類</th>
                    <th>日付</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php if (count($pagination['data']) > 0): ?>
                    <?php foreach ($pagination['data'] as $record): ?>
                        <tr>
                            <td><?php echo h($record->title); ?></td>
                            <td><?php echo $record->category; ?></td>
                            <td><?php echo dateFormat($record->topic_date); ?></td>
                            <td>
                                <button type="button" class="btn  btn-sm pull-right btn-delete" data-id="<?= $record->id ?>">削 除</button>
                                <button type="button" class="btn  btn-sm pull-right btn-edit" data-id="<?= $record->id ?>">編 集</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php partial('pagination', ['pagination' => $pagination, 'url' => url('admin/topic')]); ?>
    </div>
</div>
<div class="clear-fix"></div>

<!-- includes modals -->
<?php modal('topic.create', compact('categories')); ?>
<?php modal('topic.edit', compact('categories')); ?>
<?php modal('topic.delete'); ?>

<!-- javascript -->
<script type="text/javascript">
    $(document).ready(function () {

        var $editModal = $(".modal.edit");
        var $createModal = $(".modal.create");
        var $deleteModal = $(".modal.delete");

        // Create
        $(".btn-create").bind('click', function () {
            $createModal.modal('show');
        });

        // Edit
        $(".btn-edit").bind('click', function () {
            var id = $(this).data('id');
            $editModal.find("input[name='id']").val(id);
            $editModal.modal('show');
        });
        $editModal.on('show.bs.modal', function () {
            $("#edit-error-message").empty();
            $(".error-message").remove();
            var id = $editModal.find("input[name='id']").val();
            var ajaxUrl = APP_URL + 'admin/topic/getById';
            $.get(ajaxUrl, {id: id}, function (data) {
                $editModal.find("input[name='title_ja']").val(data.title_ja);
                $editModal.find("input[name='topic_date']").val(formatDateValue(data.topic_date));
                $editModal.find("select[name='category_id']").val(data.category_id);
                $editModal.find("input[name='id']").val(data.id);
                $editModal.find("#file_name_edit").val(data.pdf_link);
                $editModal.find("input[name='url_link']").val(data.url_link);
            });
        });

        // Delete
        $(".btn-delete").bind('click', function () {
            var id = $(this).data('id');
            $deleteModal.find("#id").val(id);
            $deleteModal.modal('show');
        });
    });

    function formatDateValue(sDate) {
        if (sDate) {
            return sDate.replace(/\-/g, ".");
        } else {
            return '';
        }
    }
</script>
