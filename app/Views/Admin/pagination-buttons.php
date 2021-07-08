<div class="text-center">
    <nav aria-label="<?= lang('Pager.pageNavigation') ?>">
        <ul class="pagination">
            <li class="page-item <?= $pager->hasPreviousPage() ? '' : 'disabled' ?>">
                <a class="page-link" href="<?= $pager->getPreviousPage() ?>" tabindex="-1">‹</a>
            </li>
            <?php foreach ($pager->links() as $link) : ?>
                <li class="page-item <?= $link['active'] ? 'active' : '' ?>">
                    <a class="page-link" href="<?= $link['uri'] ?>">
                        <?= $link['title'] ?>
                    </a>
                </li>
            <?php endforeach ?>
            <li class="page-item <?= $pager->hasNextPage() ? '' : 'disabled' ?>">
                <a class="page-link" href="<?= $pager->getNextPage() ?>">›</a>
            </li>
        </ul>
    </nav>
</div>