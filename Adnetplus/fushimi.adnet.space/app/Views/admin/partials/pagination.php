<?php
if ($pagination['total_pages'] > 1):
    $pagingUrl = $url . '?page=';
    $currentPage = $pagination['current_page'];
    $totalPages = $pagination['total_pages'];
    $records = $pagination['data'];
    $prevPage = ($currentPage > 1) ? $currentPage - 1 : 1;
    $nextPage = ($currentPage < $totalPages) ? $currentPage + 1 : $currentPage;
?>
<div id="note-pagination">
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <li>
                <a href="<?= $pagingUrl . $prevPage ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="<?= ($i == $currentPage)? 'active' : '' ?>"><a href="<?= $pagingUrl .$i ?>"><?= $i ?></a></li>
            <?php endfor; ?>
            <li>
                <a href="<?= $pagingUrl . $nextPage ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</div>
<?php endif; ?>
