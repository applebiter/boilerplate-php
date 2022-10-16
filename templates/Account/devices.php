<div class="devices index content">
    <h3><?= __('Devices') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('number') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($devices as $device): ?>
                <tr>
                    <td><?= h($device->id) ?></td>
                    <td><?= h($device->name) ?></td>
                    <td><?= h($device->number) ?></td>
                    <td class="actions">
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'devices', $device->id], ['confirm' => __('Are you sure you want to delete {0}?', $device->name)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<div class="carriers form content">
    <?= $this->Form->create($form, ['url' => '/account/devices']) ?>
    <fieldset>
        <legend><?= __('Add Device') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('number');
            echo $this->Form->control('gateway', [
                'label' => 'Carrier',
                'type' => 'select', 
                'value' => '',
                'options' => $carriers,
                'empty' => '(choose one)'
            ]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Add Device'), ['onclick' => 'this.form.submit()']) ?>
    <?= $this->Form->end() ?>
</div>
