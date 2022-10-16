<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Sound $sound
 * @var string[]|\Cake\Collection\CollectionInterface $users
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $sound->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $sound->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Sounds'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="sounds form content">
            <?= $this->Form->create($sound) ?>
            <fieldset>
                <legend><?= __('Edit Sound') ?></legend>
                <?php
                    echo $this->Form->control('user_id', ['options' => $users]);
                    echo $this->Form->control('uuid');
                    echo $this->Form->control('location');
                    echo $this->Form->control('filename');
                    echo $this->Form->control('mimetype');
                    echo $this->Form->control('extension');
                    echo $this->Form->control('size');
                    echo $this->Form->control('duration_timecode');
                    echo $this->Form->control('duration_milliseconds');
                    echo $this->Form->control('bits_per_sample');
                    echo $this->Form->control('bitrate');
                    echo $this->Form->control('channels');
                    echo $this->Form->control('samplerate');
                    echo $this->Form->control('beats_per_minute');
                    echo $this->Form->control('genre');
                    echo $this->Form->control('title');
                    echo $this->Form->control('albumartist');
                    echo $this->Form->control('album');
                    echo $this->Form->control('tracknumber');
                    echo $this->Form->control('discnumber');
                    echo $this->Form->control('artist');
                    echo $this->Form->control('year');
                    echo $this->Form->control('label');
                    echo $this->Form->control('copyright');
                    echo $this->Form->control('composer');
                    echo $this->Form->control('producer');
                    echo $this->Form->control('engineer');
                    echo $this->Form->control('comment');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
