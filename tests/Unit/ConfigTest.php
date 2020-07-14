<?php

namespace AhmdSwerky\Media\Tests;

class ConfigTest extends TestCase
{
    protected $filenameLength = 10;
    
    /** @test */
    public function check_if_media_config_file_exists()
    {
        $this->assertNotNull(
            config('media'),
            '🐞 Media [config] isn\'t allowed, check it\'s location again 🐞'
        );
    }
    
    /** @test */
    public function check_if_max_filename_length_has_a_value()
    {
        $this->assertGreaterThan(
            $this->filenameLength, 
            config('media.filename.length'), 
            "🐞 File name cannot be less than {$this->filenameLength}, increase file name length in Media [config] 🐞"
        );
    }
    
    /** @test */
    public function check_if_paths_has_values()
    {
        $this->assertNotNull(
            config('media.photos.path'),
            '🐞 Media [config] (photos path) isn\'t allowed, check its value 🐞'
        );
        $this->assertNotNull(
            config('media.videos.path'),
            '🐞 Media [config] (videos path) isn\'t allowed, check its value 🐞'
        );
        $this->assertNotNull(
            config('media.files.path'),
            '🐞 Media [config] (files path) isn\'t allowed, check its value 🐞'
        );
    }
    
    /** @test */
    public function check_if_allowed_extensions_has_values()
    {
        $this->assertNotNull(
            config('media.photos.allowed_extensions'),
            '🐞 Media [config] photos (allowed extensions) doesn\'t have a value, check its value 🐞'
        );
        $this->assertNotNull(
            config('media.videos.allowed_extensions'),
            '🐞 Media [config] videos (allowed extensions) doesn\'t have a value, check its value 🐞'
        );
        $this->assertNotNull(
            config('media.files.allowed_extensions'),
            '🐞 Media [config] files (allowed extensions) doesn\'t have a value, check its value 🐞'
        );
    }
}