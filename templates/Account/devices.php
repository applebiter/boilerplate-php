<div class="row gx-5 align-items-center justify-content-center">

    <div class="col-lg-5 mb-4">
        <h2>
            <i class="bi bi-phone-vibrate me-2"></i>
            <?= __('Mobile Devices') ?>
        </h2>
        <p class="small">
            <?= __('Add optional mobile devices to receive SMS notifications.') ?>
        </p>
        <?= $this->Flash->render() ?>
        <ul class="list-group">
            <?php foreach ($devices as $device): ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <?= h($device->name) ?>                
                <?= $this->Form->postLink(__('<i class="bi bi-trash-fill me-2" title="'.__('Delete Device Info').'"></i>'), [
                        'action' => 'devices', 
                        $device->id
                    ], [
                        'confirm' => __('Are you sure you want to delete {0}?', 
                        $device->name), 
                        'escape' => false
                    ]) ?>
            </li>
            <?php endforeach ?>
        </ul>
    </div>

    <div class="col-lg-5 mb-4">
        <?= $this->Form->create($form, [
            'autocomplete' => 'off',
            'url' => '/account/devices'
        ]) ?>

            <div class="form-group">
                <label for="name" class="col-form-label mt-4">
                    <?= __('Device Name') ?>
                </label>
                <input type="input" class="form-control<?= $this->Form->error('name') ? ' is-invalid' : '' ?>" 
                    id="name" name="name" required maxlength="100" value="<?= $form->getData('name') ?>" 
                    autocomplete="off">
                <?php if ($this->Form->error('name')) : ?>
                <div class="text-danger"><?php print_r($this->Form->error('name')) ?></div>
                <?php endif ?>
            </div>

            <div class="form-group">
                <label for="number" class="col-form-label mt-4">
                    <?= __('Device Number') ?>
                </label>
                <input type="tel" class="form-control<?= $this->Form->error('number') ? ' is-invalid' : '' ?>" 
                    id="number" name="number" required maxlength="100" value="<?= $form->getData('number') ?>" 
                    autocomplete="off">
                <?php if ($this->Form->error('number')) : ?>
                <div class="text-danger"><?php print_r($this->Form->error('number')) ?></div>
                <?php endif ?>
            </div>

            <div class="form-group">
                <label for="gateway" class="form-label mt-4">
                    <?= __('Mobile Provider') ?>
                </label>
                <select class="form-select" id="gateway" name="gateway">
                    <option><?= __('Choose...') ?></option>
                    <?php foreach ($carriers as $key => $val) : ?>
                    <option value="<?= h($key) ?>"><?= h($val) ?></option>
                    <?php endforeach ?>
                </select>
                <?php if ($this->Form->error('gateway')) : ?>
                <div class="text-danger"><?php print_r($this->Form->error('gateway')) ?></div>
                <?php endif ?>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-primary mt-3" onclick="this.form.submit()">
                    <?= __('Add Device') ?> 
                    <i class="bi bi-save ms-2"></i>
                </button>
            </div>

        <?= $this->Form->end() ?>
    </div>

</div>