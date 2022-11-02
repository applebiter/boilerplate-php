<?= $this->Form->create($form, [
    'autocomplete' => 'off',
    'class' => 'g-3',
    'url' => '/account/changepwd'
]) ?>
    <input autocomplete="false" name="hidden" type="text" style="display:none;">
    <div class="row gx-5 align-items-center justify-content-center">

        <div class="col-lg-5">
            <h2>
                <i class="bi bi-key-fill me-2"></i>
                <?= __('Change Your Password') ?>
            </h2>
            <p class="small">
                <?= __('') ?>
            </p>
            <?= $this->Flash->render() ?>
        </div>

        <div class="col-xxl-5 col-lg-7">
            <div class="form-group">
                <label for="old_password" class="col-form-label">
                    <?= __('Current Password') ?>
                </label>
                <input type="password" class="form-control<?= $this->Form->error('old_password') ? ' is-invalid' : '' ?>" 
                    id="old_password" name="old_password" required maxlength="36" value="<?= $form->getData('old_password') ?>" 
                    autocomplete="new-password">
                <?php if ($this->Form->error('old_password')) : ?>
                <div class="text-danger"><?php print_r($this->Form->error('old_password')) ?></div>
                <?php endif ?>
            </div>

            <div class="form-group">
                <label for="password" class="col-form-label">
                    <?= __('New Password') ?>
                </label>
                <input type="password" class="form-control<?= $this->Form->error('password') ? ' is-invalid' : '' ?>" 
                    id="password" name="password" required maxlength="36" value="<?= $form->getData('password') ?>" 
                    autocomplete="new-password">
                <?php if ($this->Form->error('password')) : ?>
                <div class="text-danger"><?php print_r($this->Form->error('password')) ?></div>
                <?php endif ?>
            </div>

            <div class="form-group">
                <label for="repassword" class="col-form-label">
                    <?= __('Re-type the New Password') ?>
                </label>
                <input type="password" class="form-control<?= $this->Form->error('repassword') ? ' is-invalid' : '' ?>" 
                    id="repassword" name="repassword" required maxlength="36" value="<?= $form->getData('repassword') ?>" 
                    autocomplete="new-password">
                <?php if ($this->Form->error('repassword')) : ?>
                <div class="text-danger"><?php print_r($this->Form->error('repassword')) ?></div>
                <?php endif ?>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-primary mt-3" onclick="this.form.submit()">
                    <?= __('Save Changes') ?> 
                    <i class="bi bi-save ms-2"></i>
                </button>
            </div>
        </div>
    </div>
<?= $this->Form->end() ?>