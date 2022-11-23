<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ResourcesRole $resourcesRole
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Resources Role'), ['action' => 'edit', $resourcesRole->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Resources Role'), ['action' => 'delete', $resourcesRole->id], ['confirm' => __('Are you sure you want to delete # {0}?', $resourcesRole->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Resources Roles'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Resources Role'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="resourcesRoles view content">
            <h3><?= h($resourcesRole->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Resource') ?></th>
                    <td><?= $resourcesRole->has('resource') ? $this->Html->link($resourcesRole->resource->id, ['controller' => 'Resources', 'action' => 'view', $resourcesRole->resource->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Role') ?></th>
                    <td><?= $resourcesRole->has('role') ? $this->Html->link($resourcesRole->role->name, ['controller' => 'Roles', 'action' => 'view', $resourcesRole->role->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($resourcesRole->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($resourcesRole->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($resourcesRole->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Can Create') ?></th>
                    <td><?= $resourcesRole->can_create ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Can Read') ?></th>
                    <td><?= $resourcesRole->can_read ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Can Update') ?></th>
                    <td><?= $resourcesRole->can_update ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Can Delete') ?></th>
                    <td><?= $resourcesRole->can_delete ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Can Execute') ?></th>
                    <td><?= $resourcesRole->can_execute ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Owner') ?></th>
                    <td><?= $resourcesRole->is_owner ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
