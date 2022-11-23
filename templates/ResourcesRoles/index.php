<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\ResourcesRole> $resourcesRoles
 */
?>
<div class="resourcesRoles index content">
    <?= $this->Html->link(__('New Resources Role'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Resources Roles') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('resource_id') ?></th>
                    <th><?= $this->Paginator->sort('role_id') ?></th>
                    <th><?= $this->Paginator->sort('can_create') ?></th>
                    <th><?= $this->Paginator->sort('can_read') ?></th>
                    <th><?= $this->Paginator->sort('can_update') ?></th>
                    <th><?= $this->Paginator->sort('can_delete') ?></th>
                    <th><?= $this->Paginator->sort('can_execute') ?></th>
                    <th><?= $this->Paginator->sort('is_owner') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resourcesRoles as $resourcesRole): ?>
                <tr>
                    <td><?= $this->Number->format($resourcesRole->id) ?></td>
                    <td><?= $resourcesRole->has('resource') ? $this->Html->link($resourcesRole->resource->id, ['controller' => 'Resources', 'action' => 'view', $resourcesRole->resource->id]) : '' ?></td>
                    <td><?= $resourcesRole->has('role') ? $this->Html->link($resourcesRole->role->name, ['controller' => 'Roles', 'action' => 'view', $resourcesRole->role->id]) : '' ?></td>
                    <td><?= h($resourcesRole->can_create) ?></td>
                    <td><?= h($resourcesRole->can_read) ?></td>
                    <td><?= h($resourcesRole->can_update) ?></td>
                    <td><?= h($resourcesRole->can_delete) ?></td>
                    <td><?= h($resourcesRole->can_execute) ?></td>
                    <td><?= h($resourcesRole->is_owner) ?></td>
                    <td><?= h($resourcesRole->created) ?></td>
                    <td><?= h($resourcesRole->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $resourcesRole->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $resourcesRole->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $resourcesRole->id], ['confirm' => __('Are you sure you want to delete # {0}?', $resourcesRole->id)]) ?>
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
