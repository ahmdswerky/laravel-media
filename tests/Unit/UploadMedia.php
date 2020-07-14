<?php

namespace AhmdSwerky\Media\Tests;

use AhmdSwerky\Media\Media;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UploadMedia extends TestCase
{
    /** @test */
    public function check_if_media_table_connected_to_model()
    {
        $this->assertIsNumeric(
            Media::count(), 
            'Media model is not connected to migration'
        );
    }
}