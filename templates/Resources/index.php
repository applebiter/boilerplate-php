<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Resource> $resources
 */
?>
<div class="resources index content">
    <?= $this->Html->link(__('New Resource'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Resources') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('path') ?></th>
                    <th><?= $this->Paginator->sort('type') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resources as $resource): ?>
                <tr>
                    <td><?= $this->Number->format($resource->id) ?></td>
                    <td><?= h($resource->path) ?></td>
                    <td><?= h($resource->type) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $resource->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $resource->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $resource->id], ['confirm' => __('Are you sure you want to delete # {0}?', $resource->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
