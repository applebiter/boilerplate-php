<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Image Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $uuid
 * @property string $title
 * @property string|null $description
 * @property bool $is_avatar
 * @property string|null $location
 * @property string|null $filename
 * @property int|null $size
 * @property int|null $width
 * @property int|null $height
 * @property string|null $mimetype
 * @property string|null $extension
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 */
class Image extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'user_id' => true,
        'uuid' => true,
        'title' => true,
        'description' => true,
        'is_avatar' => true,
        'location' => true,
        'filename' => true,
        'size' => true,
        'width' => true,
        'height' => true,
        'mimetype' => true,
        'extension' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
    ];
}
