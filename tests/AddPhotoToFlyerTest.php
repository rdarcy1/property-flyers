<?php

namespace App;

use Mockery as m;
use Symfony\Component\HttpFoundation\File\UploadedFile;


class AddPhotoToFlyerTest extends \TestCase
{
    /** @test */
    public function it_processes_a_form_to_add_a_photo_to_a_flyer()
    {
        $flyer = factory(Flyer::class)->create();

        $file = m::mock(UploadedFile::class, [
            'getClientOriginalName' => 'Foo',
            'getClientOriginalExtension' => 'jpg'
        ]);

        $file->shouldReceive('move')
            ->once()
            ->with('flyer-assets/photos', 'nowFoo.jpg');

        $thumbnail = m::mock(Thumbnail::class);

        $thumbnail->shouldReceive('make')
            ->once()
            ->with('flyer-assets/photos/nowFoo.jpg', 'flyer-assets/photos/tn-nowFoo.jpg');

        (new AddPhotoToFlyer($flyer, $file, $thumbnail))->save();

        $this->assertCount(1, $flyer->photos);
    }
}

function time()
{
    return 'now';
}

function sha1($value)
{
    return $value;
}