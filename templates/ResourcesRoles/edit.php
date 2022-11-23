<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ResourcesRole $resourcesRole
 * @var string[]|\Cake\Collection\CollectionInterface $resources
 * @var string[]|\Cake\Collection\CollectionInterface $roles
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $resourcesRole->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $resourcesRole->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Resources Roles'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="resourcesRoles form content">
            <?= $this->Form->create($resourcesRole) ?>
            <fieldset>
                <legend><?= __('Edit Resources Role') ?></legend>
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
