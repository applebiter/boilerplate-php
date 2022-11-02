<?php
$authUser = ($this->request->getSession()->check('Auth.User')) 
    ? $this->request->getSession()->read('Auth.User') : null; 
?>
<?= $this->Form->create($form, [
    'autocomplete' => 'off',
    'class' => 'g-3',
    'url' => '/account/preferences'
]) ?>
    <input autocomplete="false" name="hidden" type="text" style="display:none;">
    <div class="row gx-5 align-items-center justify-content-center">

        <div class="col-lg-5">
            <h2>
                <i class="bi bi-sliders me-2"></i>
                <?= __('Account Preferences') ?>
            </h2>
            <p class="small">
                <?= __('') ?>
            </p>
            <?= $this->Flash->render() ?>
        </div>

        <div class="col-xxl-5 col-lg-7">
            <div class="form-group">
                <label for="theme" class="form-label mt-4">
                    <?= __('Website Color Scheme') ?>
                </label>
                <select class="form-select" id="theme" name="theme">
                    <?php foreach ($form->getThemes() as $key => $val) : ?>
                    <option value="<?= h($key) ?>"<?= strcmp($authUser->preference->theme, $key) == 0 ? ' selected="selected"' : '' ?>><?= h($val) ?></option>
                    <?php endforeach ?>
                </select>
            </div>

            <div class="form-group">
                <label for="timezone" class="form-label mt-4">
                    <?= __('Displayed Time Zone') ?>
                </label>
                <select class="form-select" id="timezone" name="timezone">
                    <?php foreach ($form->getTimezones() as $key => $val) : ?>
                    <option value="<?= h($key) ?>"<?= strcmp($authUser->preference->timezone, $key) == 0 ? ' selected="selected"' : '' ?>><?= h($val) ?></option>
                    <?php endforeach ?>
                </select>
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