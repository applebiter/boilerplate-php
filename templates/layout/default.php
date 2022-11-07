<?php
use Cake\Core\Configure;

$theme = file_get_contents(Configure::read("Applebiter.Theme.themefile"));
$session = $this->request->getSession();
$authUser = null;

if ($session->check('Auth.User'))
{
    $authUser = $session->read('Auth.User');
    $theme = $authUser->preference->theme;
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Applebiter.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?= $this->fetch('meta') ?>
    <link rel="stylesheet" href="/assets/css/<?= h($theme) ?>/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/vendor/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/assets/vendor/prismjs/themes/prism-okaidia.css">
    <link rel="stylesheet" href="/assets/css/custom.min.css">
    <?= $this->fetch('css') ?>
  </head>
  <body>
    <div class="navbar navbar-expand-lg fixed-top navbar-dark bg-primary">
      <div class="container">
        <a href="/" class="navbar-brand">
          <i class="bi bi-app"></i>
          applebiter.com
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
        <?php if ($authUser) : ?>  
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" id="account">
                <?= __('Account') ?>
              </a>
              <div class="dropdown-menu" aria-labelledby="account">
                <a class="dropdown-item" href="/account/home"><?= __('Account Home') ?></a>
                <a class="dropdown-item" href="/account/changepwd"><?= __('Change Your Password') ?></a>
                <a class="dropdown-item" href="/account/preferences"><?= __('Account Preferences') ?></a>
                <a class="dropdown-item" href="/account/profile"><?= __('Manage Your Profile') ?></a>
                <a class="dropdown-item" href="/account/devices"><?= __('SMS Devices') ?></a>
                <a class="dropdown-item" href="/account/logout"><?= __('Log Out') ?></a>
              </div>
            </li>
          </ul>
          <?php else : ?>
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="/account/login" id="login">
                <i class="bi bi-person-circle"></i> 
                <?= __('Log In') ?>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/account/register" id="register">
                <i class="bi bi-person-lines-fill"></i> 
                <?= __('Register') ?>
              </a>
            </li>
          </ul>
          <?php endif ?>
          <ul class="navbar-nav ms-md-auto">
            <li class="nav-item">
              <a target="_blank" rel="noopener" class="nav-link" href="https://github.com/applebiter">
                <i class="bi bi-github"></i> GitHub
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>

    <div class="container">

      <?= $this->fetch('content') ?>

      <footer id="footer">
        <div class="row">
          <div class="col-lg-12">
            <ul class="list-unstyled">
              <li class="float-end"><a href="#top">Back to top</a></li>
              <li><a href="/pages/about">About</a></li>
              <li><a href="/pages/privacy">Privacy</a></li>
              <li><a href="/pages/terms">Terms</a></li>
              <li><a href="https://github.com/applebiter">GitHub</a></li>
            </ul>
            <p class="text-muted small">
                Made by <a href="https://applebiter.com/">Richard Lucas</a>
                and released under the
                <a href="https://opensource.org/licenses/MIT">MIT License</a>.
            </p>
          </div>
        </div>
      </footer>
    </div>

    <script src="/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/vendor/prismjs/prism.js" data-manual></script>
    <script src="/assets/js/custom.js"></script>
    <?= $this->fetch('script') ?>
  </body>
</html>

