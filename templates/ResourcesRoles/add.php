<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ResourcesRole $resourcesRole
 * @var \Cake\Collection\CollectionInterface|string[] $resources
 * @var \Cake\Collection\CollectionInterface|string[] $roles
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Resources Roles'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="resourcesRoles form content">
            <?= $this->Form->create($resourcesRole) ?>
            <fieldset>
                <legend><?= __('Add Resources Role') ?></legend>
                <?php
                    echo $this->Form->control('resource_id', ['options' => $resources]);
                    echo $this->Form->control('role_id', ['options' => $roles]);
                    echo $this->Form->control('can_create');
                    echo $this->Form->control('can_read');
                    echo $this->Form->control('can_update');
                    echo $this->Form->control('can_delete');
                    echo $this->Form->control('can_execute');
                    echo $this->Form->control('is_owner');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
