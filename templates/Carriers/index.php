<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Carrier> $carriers
 */
?>
<div class="carriers index content">
    <?= $this->Html->link(__('New Carrier'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Carriers') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('country_id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('gateway') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($carriers as $carrier): ?>
                <tr>
                    <td><?= $this->Number->format($carrier->id) ?></td>
                    <td><?= $carrier->has('country') ? $this->Html->link($carrier->country->name, ['controller' => 'Countries', 'action' => 'view', $carrier->country->id]) : '' ?></td>
                    <td><?= h($carrier->name) ?></td>
                    <td><?= h($carrier->gateway) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $carrier->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $carrier->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $carrier->id], ['confirm' => __('Are you sure you want to delete # {0}?', $carrier->id)]) ?>
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
