Hi, <?= h($username) ?>

A new password was generated for you, at your request.

It is recommended that you change your password again to something more 
memorable to you the next time you log in to <?= h($website_name) ?>, but you are 
also welcome to keep the newly generated one and this email by which to remember 
it.

You may log in now, if you like, using your email address and new password:
    
Email: <?= h($email) ?>
Password: <?= h($password) ?>

https://<?= h($host_name) ?>/account/login

