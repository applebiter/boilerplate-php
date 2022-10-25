<?= $this->Form->create($form, [
    'autocomplete' => 'off',
    'class' => 'g-3',
    'url' => '/account/activate'
]) ?>
    <input autocomplete="false" name="hidden" type="text" style="display:none;">
    <div class="row gx-5 align-items-center justify-content-center">

        <div class="col-lg-5">
            <h2>
                <i class="bi bi-person-check-fill me-2"></i>
                <?= __('Activate an Account') ?>
            </h2>
            <p class="small">
                <?= __('Please enter the username and activation code that was sent to your inbox.') ?>
            </p>
            <?= $this->Flash->render() ?>
        </div>

        <div class="col-xxl-5 col-lg-7">

            <div class="form-group">
                <label for="username" class="col-form-label">
                    <?= __('Username') ?>
                </label>
                <input type="input" class="form-control<?= $this->Form->error('username') ? ' is-invalid' : '' ?>" 
                    id="username" name="username" required maxlength="36" value="<?= $form->getData('username') ?>" 
                    autocomplete="off">
                <?php if ($this->Form->error('username')) : ?>
                <div class="text-danger"><?php print_r($this->Form->error('username')) ?></div>
                <?php endif ?>
            </div>

            <div class="form-group">
                <label for="secret" class="col-form-label">
                    <?= __('Code') ?>
                </label>
                <input type="input" class="form-control<?= $this->Form->error('secret') ? ' is-invalid' : '' ?>" 
                    id="secret" name="secret" required maxlength="100" value="<?= $form->getData('secret') ?>" 
                    autocomplete="off">
                <?php if ($this->Form->error('secret')) : ?>
                <div class="text-danger"><?php print_r($this->Form->error('secret')) ?></div>
                <?php endif ?>
            </div>

        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-primary mt-3" onclick="this.form.submit()">
                <?= __('Activate') ?> 
                <i class="bi bi-forward-fill ms-2"></i>
            </button>
        </div>

    </div>
<?= $this->Form->end() ?>