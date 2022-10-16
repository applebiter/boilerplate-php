<?php
$session = $this->request->getSession();
$authUser = null;

if ($session->check('Auth.User'))
{
    $authUser = $session->read('Auth.User');
}
?>
<div class="users form">
    <?= $this->Flash->render() ?>
    <h3><?= __('Manage Account Preferences') ?></h3>
    <?= $this->Form->create($form, [
        'url' => '/account/preferences'
    ]) ?>
    <fieldset>
        <legend><?= __('') ?></legend>
        <?= $this->Form->control('theme', [
            'required' => true, 
            'options' => $form->getThemes(), 
            'value' => $authUser->preference->theme
            ]) ?>
        <?= $this->Form->control('timezone', [
            'required' => true, 
            'options' => $form->getTimezones(), 
            'value' => $authUser->preference->timezone
            ]) ?>
    </fieldset>
    <?= $this->Form->submit(__('Save Changes'), ['onclick' => 'this.form.submit()']); ?>
    <?= $this->Form->end() ?>
</div>