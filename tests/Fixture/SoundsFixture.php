<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SoundsFixture
 */
class SoundsFixture extends TestFixture
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
                'uuid' => 'c4dbbdab-9697-47d1-97d5-24fcccc1f2f2',
                'location' => 'Lorem ipsum dolor sit amet',
                'filename' => 'Lorem ipsum dolor sit amet',
                'mimetype' => 'Lorem ipsum dolor sit amet',
                'extension' => 'Lorem ipsum dolor sit amet',
                'size' => 'Lorem ipsum dolor sit amet',
                'duration_timecode' => 'Lorem ipsum dolor sit amet',
                'duration_milliseconds' => 'Lorem ipsum dolor sit amet',
                'bits_per_sample' => 'Lorem ipsum dolor sit amet',
                'bitrate' => 'Lorem ipsum dolor sit amet',
                'channels' => 'Lorem ipsum dolor sit amet',
                'samplerate' => 'Lorem ipsum dolor sit amet',
                'beats_per_minute' => 'Lorem ipsum dolor sit amet',
                'genre' => 'Lorem ipsum dolor sit amet',
                'title' => 'Lorem ipsum dolor sit amet',
                'albumartist' => 'Lorem ipsum dolor sit amet',
                'album' => 'Lorem ipsum dolor sit amet',
                'tracknumber' => 'Lorem ipsum dolor sit amet',
                'discnumber' => 'Lorem ipsum dolor sit amet',
                'artist' => 'Lorem ipsum dolor sit amet',
                'year' => 'Lorem ipsum dolor sit amet',
                'label' => 'Lorem ipsum dolor sit amet',
                'copyright' => 'Lorem ipsum dolor sit amet',
                'composer' => 'Lorem ipsum dolor sit amet',
                'producer' => 'Lorem ipsum dolor sit amet',
                'engineer' => 'Lorem ipsum dolor sit amet',
                'comment' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'created' => '2022-10-14 02:58:39',
                'modified' => '2022-10-14 02:58:39',
            ],
        ];
        parent::init();
    }
}
