<div class="users form">
    <?= $this->Flash->render() ?>
    <h3>Account Activation</h3>
    <?= $this->Form->create($form, [
        'url' => '/account/activate'
    ]) ?>
    <fieldset>
        <legend><?= __('Please enter your username and activation code') ?></legend>
        <?= $this->Form->control('username', ['required' => true]) ?>
        <?= $this->Form->control('secret', ['required' => true]) ?>
    </fieldset>
    <?= $this->Form->submit(__('Activate'), ['onclick' => 'this.form.submit()']); ?>
    <?= $this->Form->end() ?>
</div>