<div class="row">
    <div class="col-12 col-md-8 col-lg-6 col-xl-4">
        <?= $this->Form->create($form, [
            'class' => 'g-3',
            'url' => '/account/register'
        ]) ?>
            <fieldset>
                <legend>
                    <i class="bi bi-person-lines-fill me-2"></i>
                    <?= __('Register an Account') ?>
                </legend>
                <p class="small">
                    <?= __('An activation code will be sent to the email address that you provide below.') ?>
                </p>
                <?= $this->Flash->render() ?>
                <div class="form-group">
                    <label for="username" class="col-form-label">
                        <?= __('Username') ?>
                    </label>
                    <input type="input" class="form-control<?= $this->Form->error('username') ? ' is-invalid' : '' ?>" 
                           id="username" name="username" required maxlength="36" value="<?= $form->getData('username') ?>">
                    <?php if ($this->Form->error('username')) : ?>
                    <div class="text-danger"><?php print_r($this->Form->error('username')) ?></div>
                    <?php endif ?>
                </div>
                <div class="form-group">
                    <label for="password" class="col-form-label">
                        <?= __('Password') ?>
                    </label>
                    <input type="password" class="form-control<?= $this->Form->error('password') ? ' is-invalid' : '' ?>" 
                           id="password" name="password" required maxlength="36" value="<?= $form->getData('password') ?>">
                    <?php if ($this->Form->error('password')) : ?>
                    <div class="text-danger"><?php print_r($this->Form->error('password')) ?></div>
                    <?php endif ?>
                </div>
                <div class="form-group">
                    <label for="repassword" class="col-form-label">
                        <?= __('Re-type Password') ?>
                    </label>
                    <input type="password" class="form-control<?= $this->Form->error('repassword') ? ' is-invalid' : '' ?>" 
                           id="repassword" name="repassword" required maxlength="36" value="<?= $form->getData('repassword') ?>">
                    <?php if ($this->Form->error('repassword')) : ?>
                    <div class="text-danger"><?php print_r($this->Form->error('repassword')) ?></div>
                    <?php endif ?>
                </div>
                <div class="form-group">
                    <label for="email" class="col-form-label">
                        <?= __('Email') ?>
                    </label>
                    <input type="email" class="form-control<?= $this->Form->error('email') ? ' is-invalid' : '' ?>" 
                           id="email" name="email" required maxlength="100" value="<?= $form->getData('email') ?>"> 
                    <?php if ($this->Form->error('email')) : ?>
                    <div class="text-danger"><?php print_r($this->Form->error('email')) ?></div>
                    <?php endif ?>
                </div>
                <div class="form-group">
                    <label for="reemail" class="col-form-label">
                        <?= __('Re-type Email') ?>
                    </label>
                    <input type="email" class="form-control<?= $this->Form->error('reemail') ? ' is-invalid' : '' ?>" 
                           id="reemail" name="reemail" required maxlength="100" value="<?= $form->getData('reemail') ?>">
                    <?php if ($this->Form->error('reemail')) : ?>
                    <div class="text-danger"><?php print_r($this->Form->error('reemail')) ?></div>
                    <?php endif ?>
                </div>
                <fieldset class="form-group">
                    <legend class="mt-4 small">
                        <?= __('Required') ?>
                    </legend>
                    <div class="form-check">
                        <input class="form-check-input" 
                               type="checkbox" value="1" id="read_privacy_policy" name="read_privacy_policy" required 
                               <?= $form->getData('read_privacy_policy') ? 'checked' : '' ?>>
                        <label class="form-check-label" for="read_privacy_policy">
                            <a href="/pages/privacy" target="_blank">
                                <?= __('I have read and agree to the website Privacy Policy.') ?>
                            </a>
                        </label>
                        <?php if ($this->Form->error('read_privacy_policy')) : ?>
                        <div class="text-danger">
                            <?= __('Check here to indicate that you have read and agree to the website Privacy Policy.') ?>
                        </div>
                        <?php endif ?>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" 
                               type="checkbox" value="1" id="agreed_to_terms" name="agreed_to_terms" required 
                               <?= $form->getData('agreed_to_terms') ? 'checked' : '' ?>>
                        <label class="form-check-label" for="agreed_to_terms">
                            <?= __('I have read and agree with the Terms of Use Policy.') ?>
                        </label>
                        <?php if ($this->Form->error('agreed_to_terms')) : ?>
                        <div class="text-danger">
                            <?= __('Check here to indicate that you have read and agree to the website Terms of Use Policy.') ?>
                        </div>
                        <?php endif ?>
                    </div>
                </fieldset>
                <fieldset class="form-group">
                    <legend class="mt-3 small">
                        <?= __('Optional') ?>
                    </legend>
                    <div class="form-check">
                        <input class="form-check-input<?= $this->Form->error('email_opt_in') ? ' is-invalid' : '' ?>" 
                               type="checkbox" value="1" id="email_opt_in" name="email_opt_in" required 
                               <?= $form->getData('email_opt_in') ? 'checked' : '' ?>>
                        <label class="form-check-label" for="email_opt_in">
                            <?= __('This website may send occasional emails to me.') ?>
                        </label>
                        <?php if ($this->Form->error('email_opt_in')) : ?>
                        <div class="text-danger"><?php print_r($this->Form->error('email_opt_in')) ?></div>
                        <?php endif ?>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input<?= $this->Form->error('newsletter_opt_in') ? ' is-invalid' : '' ?>" 
                               type="checkbox" value="1" id="newsletter_opt_in" name="newsletter_opt_in" required 
                               <?= $form->getData('newsletter_opt_in') ? 'checked' : '' ?>>
                        <label class="form-check-label" for="newsletter_opt_in">
                            <?= __('I want to receive the website newsletter, as well.') ?>
                        </label>
                        <?php if ($this->Form->error('newsletter_opt_in')) : ?>
                        <div class="text-danger"><?php print_r($this->Form->error('newsletter_opt_in')) ?></div>
                        <?php endif ?>
                    </div>
                </fieldset>
                <button type="submit" class="btn btn-primary mt-3" onclick="this.form.submit()">
                    <?= __('Register') ?>
                </button>
            </fieldset>
        <?= $this->Form->end() ?>
    </div>
</div>