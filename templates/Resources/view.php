<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Resource $resource
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Resource'), ['action' => 'edit', $resource->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Resource'), ['action' => 'delete', $resource->id], ['confirm' => __('Are you sure you want to delete # {0}?', $resource->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Resources'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Resource'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="resources view content">
            <h3><?= h($resource->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Path') ?></th>
                    <td><?= h($resource->path) ?></td>
                </tr>
                <tr>
                    <th><?= __('Type') ?></th>
                    <td><?= h($resource->type) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($resource->id) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Roles') ?></h4>
                <?php if (!empty($resource->roles)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($resource->roles as $roles) : ?>
                        <tr>
                            <td><?= h($roles->id) ?></td>
                            <td><?= h($roles->name) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Roles', 'action' => 'view', $roles->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Roles', 'action' => 'edit', $roles->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Roles', 'action' => 'delete', $roles->id], ['confirm' => __('Are you sure you want to delete # {0}?', $roles->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
