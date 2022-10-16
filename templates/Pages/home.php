<?php 
$session = $this->request->getSession();
$authUser = null;

if ($session->check('Auth.User'))
{
    $authUser = $session->read('Auth.User');
}
?>

<h3>Public Home Page</h3>
<pre><?php print_r($authUser) ?></pre>