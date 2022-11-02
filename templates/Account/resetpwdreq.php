<?= $this->Form->create($form, [
    'autocomplete' => 'off',
    'class' => 'g-3',
    'url' => '/account/resetpwdreq'
]) ?>
    <input autocomplete="false" name="hidden" type="text" style="display:none;">
    <div class="row gx-5 align-items-center justify-content-center">

        <div class="col-lg-5">
            <h2>
                <i class="bi bi-key-fill me-2"></i>
                <?= __('Request a New Password') ?>
            </h2>
            <p class="small">
                <?= __('Simply provide either your username or the email you used to register with this website.') ?>
            </p>
            <?= $this->Flash->render() ?>
        </div>

        <div class="col-xxl-5 col-lg-7">

            <div class="form-group">
                <label for="identity" class="col-form-label">
                    <?= __('Username or Email Address') ?>
                </label>
                <input type="input" class="form-control<?= $this->Form->error('identity') ? ' is-invalid' : '' ?>" 
                    id="identity" name="identity" required maxlength="100" value="<?= $form->getData('identity') ?>" 
                    autocomplete="off">
                <?php if ($this->Form->error('identity')) : ?>
                <div class="text-danger"><?php print_r($this->Form->error('identity')) ?></div>
                <?php endif ?>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-primary mt-3" onclick="this.form.submit()">
                    <?= __('Submit the Request') ?> 
                    <i class="bi bi-forward-fill ms-2"></i>
                </button>
            </div>

        </div>

    </div>
<?= $this->Form->end() ?>
