<?= $this->Form->create($form, [
    'autocomplete' => 'off',
    'class' => 'g-3',
    'url' => '/account/login'
]) ?>
    <input autocomplete="false" name="hidden" type="text" style="display:none;">
    <div class="row gx-5 align-items-center justify-content-center">

        <div class="col-lg-5">
            <h2>
                <i class="bi bi-person-circle me-2"></i>
                <?= __('Member Login') ?>
            </h2>
            <p class="small">
                <?= __('') ?>
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
                <label for="password" class="col-form-label">
                    <?= __('Password') ?>
                </label>
                <input type="password" class="form-control<?= $this->Form->error('password') ? ' is-invalid' : '' ?>" 
                    id="password" name="password" required maxlength="36" value="<?= $form->getData('password') ?>" 
                    autocomplete="new-password">
                <?php if ($this->Form->error('password')) : ?>
                <div class="text-danger"><?php print_r($this->Form->error('password')) ?></div>
                <?php endif ?>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-primary mt-3" onclick="this.form.submit()">
                    <?= __('Log In') ?> 
                    <i class="bi bi-forward-fill ms-2"></i>
                </button>
            </div>

            <p>
                <a href="/account/register"><?= __('Not yet a member? Register here.') ?></a><br>
                <a href="/account/resetpwdreq"><?= __('Forgot your password? Request a password reset here.') ?></a>
            </p>

        </div>

    </div>
<?= $this->Form->end() ?>