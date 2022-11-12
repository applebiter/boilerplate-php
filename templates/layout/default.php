<?php
use Cake\Core\Configure;

$theme = file_get_contents(Configure::read("Applebiter.Theme.themefile"));
$session = $this->request->getSession();
$authUser = ($this->request->getSession()->check('Auth.User')) ? $this->request->getSession()->read('Auth.User') : null;

if ($authUser)
{
    $theme = $authUser->preference->theme;
}
 
$avatarId = null;

if ($authUser && $authUser->profile->avatar)
{
    $pathArr = explode('/', $authUser->profile->avatar);
    $avatarId = trim(array_pop($pathArr));
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
    <div class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
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
          <ul class="navbar-nav ms-md-auto">            
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="account"
                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <?php if ($avatarId) : ?>
                <div style="background-image:url('/images/thumbnail/<?= $avatarId ?>/30x30');background-repeat:no-repeat;background-position:50%;border-radius:50%;width:24px;height:24px;" class="me-2"></div>
                <?php endif ?>
                <?= __('Account') ?>
              </a>
              <div class="dropdown-menu" aria-labelledby="account">
                <a class="dropdown-item" href="/account/home">
                  <i class="bi bi-house-fill me-2"></i>
                  <?= __('Account Home') ?>
                </a>
                <a class="dropdown-item" href="/account/changepwd">
                  <i class="bi bi-key-fill me-2"></i>
                  <?= __('Change Your Password') ?>
                </a>
                <a class="dropdown-item" href="/account/preferences">
                  <i class="bi bi-sliders me-2"></i>
                  <?= __('Account Preferences') ?>
                </a>
                <a class="dropdown-item" href="/account/profile">
                  <i class="bi bi-person-fill me-2"></i>
                  <?= __('Manage Your Profile') ?>
                </a>
                <a class="dropdown-item" href="/account/devices">
                  <i class="bi bi-phone-vibrate me-2"></i>
                  <?= __('Mobile Devices') ?>
                </a>
                <a class="dropdown-item" href="/account/logout">
                  <i class="bi bi-door-open-fill me-2"></i>
                  <?= __('Log Out') ?>
                </a>
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
          <ul class="navbar-nav ms-md-auto">
            <li class="nav-item">
              <a target="_blank" rel="noopener" class="nav-link" href="https://github.com/applebiter">
                <i class="bi bi-github"></i> GitHub
              </a>
            </li>
          </ul>
          <?php endif ?>
        </div>
      </div>
    </div>

    <div class="container">

      <?= $this->fetch('content') ?>

      <footer id="footer">
        <div class="row">
          <div class="col-lg-12">
            <ul class="list-unstyled">
              <li class="float-end"><a href="#top"><?= __('Back to top') ?></a></li>
              <li><a href="/pages/about"><?= __('About') ?></a></li>
              <li><a href="/pages/privacy"><?= __('Privacy') ?></a></li>
              <li><a href="/pages/terms"><?= __('Terms') ?></a></li>
              <li><a target="_blank" href="https://github.com/applebiter/boilerplate-php">GitHub</a></li>
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

