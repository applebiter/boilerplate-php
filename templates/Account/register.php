<div class="users form">
    <?= $this->Flash->render() ?>
    <h3><?= __('Register an Account') ?></h3>
    <?= $this->Form->create($form, [
        'url' => '/account/register'
    ]) ?>
    <fieldset>
        <legend><?= __('An activation code will be sent to the email address you provide below.') ?></legend>
        <?= $this->Form->control('username', ['required' => true]) ?>
        <?= $this->Form->control('password', ['required' => true, 'type' => 'password']) ?>
        <?= $this->Form->control('repassword', ['required' => true, 'type' => 'password']) ?>
        <?= $this->Form->control('email', ['required' => true, 'type' => 'email']) ?>
        <?= $this->Form->control('reemail', ['required' => true, 'type' => 'email']) ?>
        <?= $this->Form->control('agreed_to_terms', ['checked' => false]) ?>
        <?= $this->Form->control('read_privacy_policy', ['checked' => false]) ?>
        <?= $this->Form->control('email_opt_in', ['checked' => true]) ?>
        <?= $this->Form->control('newsletter_opt_in', ['checked' => true]) ?>
    </fieldset>
    <?= $this->Form->submit(__('Register'), ['onclick' => 'this.form.submit()']); ?>
    <?= $this->Form->end() ?>
</div>