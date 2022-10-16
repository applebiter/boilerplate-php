<div class="users form">
    <?= $this->Flash->render() ?>
    <h3>Request a New Password</h3>
    <?= $this->Form->create($form, [
        'url' => '/account/resetpwdreq'
    ]) ?>
    <fieldset>
        <legend><?= __('Please enter your username or email address ') ?></legend>
        <?= $this->Form->control('identity', ['required' => true]) ?>
    </fieldset>
    <?= $this->Form->submit(__('Request New Password'), ['onclick' => 'this.form.submit()']); ?>
    <?= $this->Form->end() ?>
</div>