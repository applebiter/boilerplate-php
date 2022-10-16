<div class="users form">
    <?= $this->Flash->render() ?>
    <h3>Login</h3>
    <?= $this->Form->create($form, [
        'url' => '/account/login'
    ]) ?>
    <fieldset>
        <legend><?= __('Please enter your username and password') ?></legend>
        <?= $this->Form->control('username', ['required' => true]) ?>
        <?= $this->Form->control('password', ['required' => true]) ?>
    </fieldset>
    <?= $this->Form->submit(__('Login'), ['onclick' => 'this.form.submit()']); ?>
    Not yet a member? <a href="/account/register">Register here</a>. <br>
    Forgot your password? <a href="/account/resetpwdreq">Request a password reset here</a>.
    <?= $this->Form->end() ?>
</div>