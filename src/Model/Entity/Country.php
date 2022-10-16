<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Country Entity
 *
 * @property int $id
 * @property string|null $code
 * @property string|null $name
 *
 * @property \App\Model\Entity\Carrier[] $carriers
 * @property \App\Model\Entity\State[] $states
 * @property \App\Model\Entity\Zone[] $zones
 */
class Country extends Entity
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
        'code' => true,
        'name' => true,
        'carriers' => true,
        'states' => true,
        'zones' => true,
    ];
}
