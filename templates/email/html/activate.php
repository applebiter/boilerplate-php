<p>Hi, <?= h($username) ?></p>

<p>You have successfully created a new account with <?= h($website_name) ?>. Now 
all that you must do is activate your new account using this code:</p> 

<p><?= h($secret) ?></p>

<p>You may follow this link directly to the activation form and input the code 
above. PLEASE NOTE that this activation code is only good for one hour after 
account creation. If you do not redeem this code within an hour of creating 
the account, you will have to register another, new account and try again.</p>

<p>https://<?= h($host_name) ?>/account/activate</p>