<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Preference Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $theme
 * @property string $timezone
 *
 * @property \App\Model\Entity\User $user
 */
class Preference extends Entity
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
        'theme' => true,
        'timezone' => true,
        'user' => true,
    ];
}
