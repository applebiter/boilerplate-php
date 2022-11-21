<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Resource $resource
 * @var \Cake\Collection\CollectionInterface|string[] $roles
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Resources'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="resources form content">
            <?= $this->Form->create($resource) ?>
            <fieldset>
                <legend><?= __('Add Resource') ?></legend>
                <?php
                    echo $this->Form->control('path');
                    echo $this->Form->control('type');
                    echo $this->Form->control('roles._ids', ['options' => $roles]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
