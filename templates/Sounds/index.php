<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Sound> $sounds
 */
?>
<div class="sounds index content">
    <?= $this->Html->link(__('New Sound'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Sounds') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th><?= $this->Paginator->sort('uuid') ?></th>
                    <th><?= $this->Paginator->sort('location') ?></th>
                    <th><?= $this->Paginator->sort('filename') ?></th>
                    <th><?= $this->Paginator->sort('mimetype') ?></th>
                    <th><?= $this->Paginator->sort('extension') ?></th>
                    <th><?= $this->Paginator->sort('size') ?></th>
                    <th><?= $this->Paginator->sort('duration_timecode') ?></th>
                    <th><?= $this->Paginator->sort('duration_milliseconds') ?></th>
                    <th><?= $this->Paginator->sort('bits_per_sample') ?></th>
                    <th><?= $this->Paginator->sort('bitrate') ?></th>
                    <th><?= $this->Paginator->sort('channels') ?></th>
                    <th><?= $this->Paginator->sort('samplerate') ?></th>
                    <th><?= $this->Paginator->sort('beats_per_minute') ?></th>
                    <th><?= $this->Paginator->sort('genre') ?></th>
                    <th><?= $this->Paginator->sort('title') ?></th>
                    <th><?= $this->Paginator->sort('albumartist') ?></th>
                    <th><?= $this->Paginator->sort('album') ?></th>
                    <th><?= $this->Paginator->sort('tracknumber') ?></th>
                    <th><?= $this->Paginator->sort('discnumber') ?></th>
                    <th><?= $this->Paginator->sort('artist') ?></th>
                    <th><?= $this->Paginator->sort('year') ?></th>
                    <th><?= $this->Paginator->sort('label') ?></th>
                    <th><?= $this->Paginator->sort('copyright') ?></th>
                    <th><?= $this->Paginator->sort('composer') ?></th>
                    <th><?= $this->Paginator->sort('producer') ?></th>
                    <th><?= $this->Paginator->sort('engineer') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sounds as $sound): ?>
                <tr>
                    <td><?= $this->Number->format($sound->id) ?></td>
                    <td><?= $sound->has('user') ? $this->Html->link($sound->user->id, ['controller' => 'Users', 'action' => 'view', $sound->user->id]) : '' ?></td>
                    <td><?= h($sound->uuid) ?></td>
                    <td><?= h($sound->location) ?></td>
                    <td><?= h($sound->filename) ?></td>
                    <td><?= h($sound->mimetype) ?></td>
                    <td><?= h($sound->extension) ?></td>
                    <td><?= h($sound->size) ?></td>
                    <td><?= h($sound->duration_timecode) ?></td>
                    <td><?= h($sound->duration_milliseconds) ?></td>
                    <td><?= h($sound->bits_per_sample) ?></td>
                    <td><?= h($sound->bitrate) ?></td>
                    <td><?= h($sound->channels) ?></td>
                    <td><?= h($sound->samplerate) ?></td>
                    <td><?= h($sound->beats_per_minute) ?></td>
                    <td><?= h($sound->genre) ?></td>
                    <td><?= h($sound->title) ?></td>
                    <td><?= h($sound->albumartist) ?></td>
                    <td><?= h($sound->album) ?></td>
                    <td><?= h($sound->tracknumber) ?></td>
                    <td><?= h($sound->discnumber) ?></td>
                    <td><?= h($sound->artist) ?></td>
                    <td><?= h($sound->year) ?></td>
                    <td><?= h($sound->label) ?></td>
                    <td><?= h($sound->copyright) ?></td>
                    <td><?= h($sound->composer) ?></td>
                    <td><?= h($sound->producer) ?></td>
                    <td><?= h($sound->engineer) ?></td>
                    <td><?= h($sound->created) ?></td>
                    <td><?= h($sound->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $sound->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $sound->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $sound->id], ['confirm' => __('Are you sure you want to delete # {0}?', $sound->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
