<div class="users form">
    <?= $this->Flash->render() ?>
    <h3>Confirm Password Reset</h3>
    <?= $this->Form->create($form, [
        'url' => '/account/resetpwd'
    ]) ?>
    <fieldset>
        <legend><?= __('Please enter your email address ') ?></legend>
        <?= $this->Form->control('email', ['required' => true]) ?>
        <?= $this->Form->control('secret', ['required' => true]) ?>
    </fieldset>
    <?= $this->Form->submit(__('Confirm Password Reset'), ['onclick' => 'this.form.submit()']); ?>
    <?= $this->Form->end() ?>
</div>