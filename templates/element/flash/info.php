<?php
/**
 * @var \App\View\AppView $this
 * @var array $params
 * @var string $message
 */
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="alert alert-dismissible alert-info">
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  <?= $message ?>
</div>