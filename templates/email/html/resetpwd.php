<p>Hi, <?= h($website_name) ?></p>

<p>You, or someone pretending to be you, has requested a password reset for your 
account on our website, <?= h($website_name) ?>. If you did not request a 
password reset, then do nothing and your password will remain unchanged.</p> 

<p>If you want to reset your password browse to the following URL:</p>

<p>https://<?= h($host_name) ?>/account/resetpwd</p>

<p>...then come back and copy this this code so that you can paste it into the 
input form on that page:</p>

<p><?= $secret ?></p>

<p>A new password will be generated after you have submitted the code above and 
emailed to you. It is recommended that you immediately change your password to 
something more memorable for you as soon as you log in.</p>

<p>The code above is only good for one hour, after which you must begin the 
process again for resetting your password.</p>