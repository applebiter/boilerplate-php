<?php 
$authUser = ($this->request->getSession()->check('Auth.User')) ? $this->request->getSession()->read('Auth.User') : null;
$avatarId = null;

if ($authUser->profile->avatar)
{
    $pathArr = explode('/', $authUser->profile->avatar);
    $avatarId = trim(array_pop($pathArr));
}
?>
<?= $this->Form->create($form, [
    'autocomplete' => 'off',
    'class' => 'g-3',
    'url' => '/account/profile',
    'type' => 'file'
]) ?>
    <input autocomplete="false" name="hidden" type="text" style="display:none;">
    <div class="row gx-5 align-items-center justify-content-center">

        <div class="col-lg-5 mb-4">
            <h2>
                <i class="bi bi-person-fill me-2"></i>
                <?= __('Account Profile') ?>
            </h2>
            <p class="small">
                <?= __('') ?>
            </p>
            <?= $this->Flash->render() ?>
            <div class="text-center align-items-center justify-content-center mt-4 p-3 shadow">

                <?php if ($avatarId) : ?>
                <div style="background-image:url('/images/thumbnail/<?= $avatarId ?>/180x180');background-repeat:no-repeat;background-position:50%;border-radius:50%;width:150px;height:150px;display:inline-block;padding-top:120px" 
                    class="shadow small">
                </div>
                <?php else : ?>
                <div style="background-image:url('/favicon.png');background-repeat:no-repeat;background-position:50%;border-radius:50%;width:150px;height:150px;display:inline-block" 
                    class="shadow"></div>
                <?php endif ?> 

                <h5 class="mt-2 mb-2"><strong>
                    <?= $authUser->profile->full_name ? h($authUser->profile->full_name) : h($authUser->username) ?>
                </strong></h5>

                <p class="text-muted"><span class="badge bg-primary">
                    <?= $authUser->role->name ?>
                </span></p>
            </div>                     
        </div>

        <div class="col-xxl-5 col-lg-7">
            <div class="row gx-3">
                <div class="col-md-6">

                    <div class="form-group">
                        <label for="avatar" class="col-form-label mt-4">
                            <?= __('Upload New Avatar') ?>
                        </label>
                        <input class="form-control" type="file" id="avatar" name="avatar">
                        <?php if ($this->Form->error('avatar')) : ?>
                        <div class="text-danger"><?php print_r($this->Form->error('avatar')) ?></div>
                        <?php endif ?>
                    </div>

                </div>
                <div class="col-md-6">

                    <div class="form-group">
                        <label for="full_name" class="col-form-label mt-4">
                            <?= __('Full Name') ?>
                        </label>
                        <input type="input" class="form-control<?= $this->Form->error('full_name') ? ' is-invalid' : '' ?>" 
                            id="full_name" name="full_name" required maxlength="60" value="<?= h($authUser->profile->full_name) ?>" 
                            autocomplete="off">
                        <?php if ($this->Form->error('full_name')) : ?>
                        <div class="text-danger"><?php print_r($this->Form->error('full_name')) ?></div>
                        <?php endif ?>
                    </div>
                    
                </div>
            </div>

            <div class="form-group">
                <label for="short_biography" class="form-label mt-4">
                    <?= __('Brief Introduction') ?>
                </label>
                <textarea class="form-control" id="short_biography" name="short_biography"rows="3" 
                          maxlength="255" autocomplete="off"><?= h($authUser->profile->short_biography) ?></textarea>
                <?php if ($this->Form->error('short_biography')) : ?>
                <div class="text-danger"><?php print_r($this->Form->error('short_biography')) ?></div>
                <?php endif ?>
            </div>

            <div class="form-group">
                <label for="long_biography" class="form-label mt-4">
                    <?= __('Your Manifesto') ?>
                </label>
                <textarea class="form-control" id="long_biography" name="long_biography"rows="5" 
                        maxlength="16383" autocomplete="off"><?= h($authUser->profile->long_biography) ?></textarea>
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