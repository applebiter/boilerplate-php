<div class="users form">
    <?= $this->Flash->render() ?>
    <h3>Change Your Password</h3>
    <?= $this->Form->create($form, [
        'url' => '/account/changepwd'
    ]) ?>
    <fieldset>
        <legend><?= __('You will need to also provide your current (old) password.') ?></legend>
        <?= $this->Form->control('old_password', ['required' => true, 'type' => 'password']) ?>
        <?= $this->Form->control('password', ['required' => true, 'type' => 'password']) ?>
        <?= $this->Form->control('repassword', ['required' => true, 'type' => 'password']) ?>
    </fieldset>
    <?= $this->Form->submit(__('Change Password'), ['onclick' => 'this.form.submit()']); ?>
    <?= $this->Form->end() ?>
</div>