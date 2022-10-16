<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Carrier $carrier
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Carrier'), ['action' => 'edit', $carrier->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Carrier'), ['action' => 'delete', $carrier->id], ['confirm' => __('Are you sure you want to delete # {0}?', $carrier->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Carriers'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Carrier'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="carriers view content">
            <h3><?= h($carrier->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Country') ?></th>
                    <td><?= $carrier->has('country') ? $this->Html->link($carrier->country->name, ['controller' => 'Countries', 'action' => 'view', $carrier->country->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($carrier->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Gateway') ?></th>
                    <td><?= h($carrier->gateway) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($carrier->id) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Devices') ?></h4>
                <?php if (!empty($carrier->devices)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Data') ?></th>
                            <th><?= __('Nonce') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($carrier->devices as $devices) : ?>
                        <tr>
                            <td><?= h($devices->id) ?></td>
                            <td><?= h($devices->user_id) ?></td>
                            <td><?= h($devices->data) ?></td>
                            <td><?= h($devices->nonce) ?></td>
                            <td><?= h($devices->created) ?></td>
                            <td><?= h($devices->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Devices', 'action' => 'view', $devices->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Devices', 'action' => 'edit', $devices->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Devices', 'action' => 'delete', $devices->id], ['confirm' => __('Are you sure you want to delete # {0}?', $devices->id)]) ?>
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
