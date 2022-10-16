<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Image $image
 * @var \Cake\Collection\CollectionInterface|string[] $users
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Images'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="images form content">
            <?= $this->Form->create($image) ?>
            <fieldset>
                <legend><?= __('Add Image') ?></legend>
                <?php
                    echo $this->Form->control('user_id', ['options' => $users]);
                    echo $this->Form->control('uuid');
                    echo $this->Form->control('title');
                    echo $this->Form->control('description');
                    echo $this->Form->control('is_avatar');
                    echo $this->Form->control('location');
                    echo $this->Form->control('filename');
                    echo $this->Form->control('size');
                    echo $this->Form->control('width');
                    echo $this->Form->control('height');
                    echo $this->Form->control('mimetype');
                    echo $this->Form->control('extension');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
