<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ResourcesRole Entity
 *
 * @property int $id
 * @property int $resource_id
 * @property int $role_id
 * @property bool $can_create
 * @property bool $can_read
 * @property bool $can_update
 * @property bool $can_delete
 * @property bool $can_execute
 * @property bool $is_owner
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Resource $resource
 * @property \App\Model\Entity\Role $role
 */
class ResourcesRole extends Entity
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
        'resource_id' => true,
        'role_id' => true,
        'can_create' => true,
        'can_read' => true,
        'can_update' => true,
        'can_delete' => true,
        'can_execute' => true,
        'is_owner' => true,
        'created' => true,
        'modified' => true,
        'resource' => true,
        'role' => true,
    ];
}
