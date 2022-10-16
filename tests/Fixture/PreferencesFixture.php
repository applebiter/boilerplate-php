<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PreferencesFixture
 */
class PreferencesFixture extends TestFixture
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
                'user_id' => 1,
                'theme' => 'Lorem ipsum dolor sit amet',
                'timezone' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
