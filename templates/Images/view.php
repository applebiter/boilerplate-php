<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Image $image
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Image'), ['action' => 'edit', $image->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Image'), ['action' => 'delete', $image->id], ['confirm' => __('Are you sure you want to delete # {0}?', $image->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Images'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Image'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="images view content">
            <h3><?= h($image->title) ?></h3>
            <table>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $image->has('user') ? $this->Html->link($image->user->id, ['controller' => 'Users', 'action' => 'view', $image->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Uuid') ?></th>
                    <td><?= h($image->uuid) ?></td>
                </tr>
                <tr>
                    <th><?= __('Title') ?></th>
                    <td><?= h($image->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Location') ?></th>
                    <td><?= h($image->location) ?></td>
                </tr>
                <tr>
                    <th><?= __('Filename') ?></th>
                    <td><?= h($image->filename) ?></td>
                </tr>
                <tr>
                    <th><?= __('Mimetype') ?></th>
                    <td><?= h($image->mimetype) ?></td>
                </tr>
                <tr>
                    <th><?= __('Extension') ?></th>
                    <td><?= h($image->extension) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($image->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Size') ?></th>
                    <td><?= $image->size === null ? '' : $this->Number->format($image->size) ?></td>
                </tr>
                <tr>
                    <th><?= __('Width') ?></th>
                    <td><?= $image->width === null ? '' : $this->Number->format($image->width) ?></td>
                </tr>
                <tr>
                    <th><?= __('Height') ?></th>
                    <td><?= $image->height === null ? '' : $this->Number->format($image->height) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($image->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($image->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Avatar') ?></th>
                    <td><?= $image->is_avatar ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($image->description)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
