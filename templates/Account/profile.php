<?php
$authUser = ($this->request->getSession()->check('Auth.User')) 
    ? $this->request->getSession()->read('Auth.User') : null; 
?>
<?= $this->Form->create($form, [
    'autocomplete' => 'off',
    'class' => 'g-3',
    'url' => '/account/profile'
]) ?>
    <input autocomplete="false" name="hidden" type="text" style="display:none;">
    <div class="row gx-5 align-items-center justify-content-center">

        <div class="col-lg-5">
            <h2>
                <i class="bi bi-person-fill me-2"></i>
                <?= __('Account Profile') ?>
            </h2>
            <p class="small">
                <?= __('') ?>
            </p>
            <?= $this->Flash->render() ?>
        </div>

        <div class="col-xxl-5 col-lg-7">

            <div class="form-group">
                <label for="avatar" class="form-label">
                    <?= __('Avatar') ?>
                </label>
                <input class="form-control" type="file" id="avatar" name="avatar">
                <?php if ($this->Form->error('avatar')) : ?>
                <div class="text-danger"><?php print_r($this->Form->error('avatar')) ?></div>
                <?php endif ?>
            </div>
        
            <div class="form-group">
                <label for="full_name" class="col-form-label mt-4">
                    <?= __('Full Name') ?>
                </label>
                <input type="input" class="form-control<?= $this->Form->error('full_name') ? ' is-invalid' : '' ?>" 
                    id="full_name" name="full_name" required maxlength="60" value="<?= $form->getData('full_name') ?>" 
                    autocomplete="off">
                <?php if ($this->Form->error('full_name')) : ?>
                <div class="text-danger"><?php print_r($this->Form->error('full_name')) ?></div>
                <?php endif ?>
            </div>

            <div class="form-group">
                <label for="short_biography" class="form-label mt-4">
                    <?= __('Brief Introduction') ?>
                </label>
                <textarea class="form-control" id="short_biography" name="short_biography"rows="5" 
                          maxlength="255" autocomplete="off"></textarea>
                <?php if ($this->Form->error('short_biography')) : ?>
                <div class="text-danger"><?php print_r($this->Form->error('short_biography')) ?></div>
                <?php endif ?>
            </div>

            <div class="form-group">
                <label for="long_biography" class="form-label mt-4">
                    <?= __('Your Manifesto') ?>
                </label>
                <textarea class="form-control" id="long_biography" name="long_biography"rows="10" 
                        maxlength="16383" autocomplete="off"></textarea>
                <?php if ($this->Form->error('long_biography')) : ?>
                <div class="text-danger"><?php print_r($this->Form->error('long_biography')) ?></div>
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