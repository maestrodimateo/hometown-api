<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class StaffControllerTest extends TestCase
{

    /**
     * A basic test example.
     * 
     * @test
     * 
     * @return void
     */
    public function staff_can_be_created()
    {
        Storage::fake('local');
        $file = UploadedFile::fake()->image('avatar.jpg');

        $formdata = [
            'fullname' => 'Jean boniface',
            'photo' => $file,
            'qrcode' => 'path/to/qrcode',
            'hometown_id' => 1,
        ];

        $this->json('post', route('create.staff'), $formdata)->seeStatusCode(201);
        $this->assertFileExists($file->hashName());

    }
}
