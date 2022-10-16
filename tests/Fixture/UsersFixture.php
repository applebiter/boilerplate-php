<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersFixture
 */
class UsersFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'uuid' => 'd0d6279a-61e8-4c87-8053-8572b5979526',
                'email' => 'Lorem ipsum dolor sit amet',
                'username' => 'Lorem ipsum dolor sit amet',
                'password' => 'Lorem ipsum dolor sit amet',
                'secret' => 'Lorem ipsum dolor sit amet',
                'role_id' => 1,
                'is_activated' => 1,
                'created' => '2022-10-09 03:19:26',
                'modified' => '2022-10-09 03:19:26',
            ],
        ];
        parent::init();
    }
}
