<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Carrier $carrier
 * @var \Cake\Collection\CollectionInterface|string[] $countries
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Carriers'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="carriers form content">
            <?= $this->Form->create($carrier) ?>
            <fieldset>
                <legend><?= __('Add Carrier') ?></legend>
                <?php
                    echo $this->Form->control('country_id', ['options' => $countries]);
                    echo $this->Form->control('name');
                    echo $this->Form->control('gateway');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
