<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ImagesFixture
 */
class ImagesFixture extends TestFixture
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
                'uuid' => '981aadd7-b936-422b-8827-07e8a7def092',
                'title' => 'Lorem ipsum dolor sit amet',
                'description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'is_avatar' => 1,
                'location' => 'Lorem ipsum dolor sit amet',
                'filename' => 'Lorem ipsum dolor sit amet',
                'size' => 1,
                'width' => 1,
                'height' => 1,
                'mimetype' => 'Lorem ipsu',
                'extension' => 'Lo',
                'created' => '2022-10-14 02:10:30',
                'modified' => '2022-10-14 02:10:30',
            ],
        ];
        parent::init();
    }
}
