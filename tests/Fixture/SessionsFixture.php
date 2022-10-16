<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SessionsFixture
 */
class SessionsFixture extends TestFixture
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
                'id' => '',
                'created' => '2022-10-09 03:19:14',
                'modified' => '2022-10-09 03:19:14',
                'data' => 'Lorem ipsum dolor sit amet',
                'expires' => 1,
            ],
        ];
        parent::init();
    }
}
