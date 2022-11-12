<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * MessagesFixture
 */
class MessagesFixture extends TestFixture
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
                'uuid' => 'cd8e6bf9-1ef1-4b99-9ef1-f38cea0b0f16',
                'user_id' => 1,
                'receiver' => 'Lorem ipsum dolor sit amet',
                'content' => 'Lorem ipsum dolor sit amet',
                'created' => '2022-11-09 17:24:33',
                'modified' => '2022-11-09 17:24:33',
            ],
        ];
        parent::init();
    }
}
