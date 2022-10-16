<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Sodium\Compat;

/**
 * User Entity
 *
 * @property int $id
 * @property string $uuid
 * @property string $email
 * @property string $username
 * @property string|resource $password
 * @property string|null $secret
 * @property int $role_id
 * @property bool $is_activated
 * @property bool $agreed_to_terms
 * @property bool $read_privacy_policy
 * @property bool $email_opt_in
 * @property bool $newsletter_opt_in
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Role $role
 * @property \App\Model\Entity\Device[] $devices
 * @property \App\Model\Entity\Preference $preference
 * @property \App\Model\Entity\Profile $profile
 */
class User extends Entity
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
        'uuid' => true,
        'email' => true,
        'username' => true,
        'password' => true,
        'secret' => true,
        'role_id' => true,
        'is_activated' => true,
        'agreed_to_terms' => true,
        'read_privacy_policy' => true,
        'email_opt_in' => true,
        'newsletter_opt_in' => true,
        'created' => true,
        'modified' => true,
        'role' => true,
        'devices' => true,
        'preference' => true,
        'profile' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array<string>
     */
    protected $_hidden = [
        'password',
    ];

    /**
     * _setPassword
     * 
     * @param string $password
     * @return string
     */
    protected function _setPassword(string $password) : ?string
    {
        if (strlen($password) > 0) 
        {
            return utf8_decode(sodium_crypto_pwhash_str(
                $password,
                SODIUM_CRYPTO_PWHASH_OPSLIMIT_SENSITIVE,
                SODIUM_CRYPTO_PWHASH_MEMLIMIT_SENSITIVE
            ));
        }
    }
}
