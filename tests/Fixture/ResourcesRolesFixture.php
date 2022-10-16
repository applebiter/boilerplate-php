<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ResourcesRolesFixture
 */
class ResourcesRolesFixture extends TestFixture
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
                'resource_id' => 1,
                'role_id' => 1,
                'can_create' => 1,
                'can_read' => 1,
                'can_update' => 1,
                'can_delete' => 1,
                'can_execute' => 1,
                'is_owner' => 1,
                'created' => '2022-10-09 03:18:59',
                'modified' => '2022-10-09 03:18:59',
            ],
        ];
        parent::init();
    }
}
