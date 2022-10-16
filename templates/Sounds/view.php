<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Sound $sound
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Sound'), ['action' => 'edit', $sound->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Sound'), ['action' => 'delete', $sound->id], ['confirm' => __('Are you sure you want to delete # {0}?', $sound->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Sounds'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Sound'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="sounds view content">
            <h3><?= h($sound->title) ?></h3>
            <table>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $sound->has('user') ? $this->Html->link($sound->user->id, ['controller' => 'Users', 'action' => 'view', $sound->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Uuid') ?></th>
                    <td><?= h($sound->uuid) ?></td>
                </tr>
                <tr>
                    <th><?= __('Location') ?></th>
                    <td><?= h($sound->location) ?></td>
                </tr>
                <tr>
                    <th><?= __('Filename') ?></th>
                    <td><?= h($sound->filename) ?></td>
                </tr>
                <tr>
                    <th><?= __('Mimetype') ?></th>
                    <td><?= h($sound->mimetype) ?></td>
                </tr>
                <tr>
                    <th><?= __('Extension') ?></th>
                    <td><?= h($sound->extension) ?></td>
                </tr>
                <tr>
                    <th><?= __('Size') ?></th>
                    <td><?= h($sound->size) ?></td>
                </tr>
                <tr>
                    <th><?= __('Duration Timecode') ?></th>
                    <td><?= h($sound->duration_timecode) ?></td>
                </tr>
                <tr>
                    <th><?= __('Duration Milliseconds') ?></th>
                    <td><?= h($sound->duration_milliseconds) ?></td>
                </tr>
                <tr>
                    <th><?= __('Bits Per Sample') ?></th>
                    <td><?= h($sound->bits_per_sample) ?></td>
                </tr>
                <tr>
                    <th><?= __('Bitrate') ?></th>
                    <td><?= h($sound->bitrate) ?></td>
                </tr>
                <tr>
                    <th><?= __('Channels') ?></th>
                    <td><?= h($sound->channels) ?></td>
                </tr>
                <tr>
                    <th><?= __('Samplerate') ?></th>
                    <td><?= h($sound->samplerate) ?></td>
                </tr>
                <tr>
                    <th><?= __('Beats Per Minute') ?></th>
                    <td><?= h($sound->beats_per_minute) ?></td>
                </tr>
                <tr>
                    <th><?= __('Genre') ?></th>
                    <td><?= h($sound->genre) ?></td>
                </tr>
                <tr>
                    <th><?= __('Title') ?></th>
                    <td><?= h($sound->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Albumartist') ?></th>
                    <td><?= h($sound->albumartist) ?></td>
                </tr>
                <tr>
                    <th><?= __('Album') ?></th>
                    <td><?= h($sound->album) ?></td>
                </tr>
                <tr>
                    <th><?= __('Tracknumber') ?></th>
                    <td><?= h($sound->tracknumber) ?></td>
                </tr>
                <tr>
                    <th><?= __('Discnumber') ?></th>
                    <td><?= h($sound->discnumber) ?></td>
                </tr>
                <tr>
                    <th><?= __('Artist') ?></th>
                    <td><?= h($sound->artist) ?></td>
                </tr>
                <tr>
                    <th><?= __('Year') ?></th>
                    <td><?= h($sound->year) ?></td>
                </tr>
                <tr>
                    <th><?= __('Label') ?></th>
                    <td><?= h($sound->label) ?></td>
                </tr>
                <tr>
                    <th><?= __('Copyright') ?></th>
                    <td><?= h($sound->copyright) ?></td>
                </tr>
                <tr>
                    <th><?= __('Composer') ?></th>
                    <td><?= h($sound->composer) ?></td>
                </tr>
                <tr>
                    <th><?= __('Producer') ?></th>
                    <td><?= h($sound->producer) ?></td>
                </tr>
                <tr>
                    <th><?= __('Engineer') ?></th>
                    <td><?= h($sound->engineer) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($sound->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($sound->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($sound->modified) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Comment') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($sound->comment)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
