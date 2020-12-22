<?php

use App\Models\Hometown;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class HometownControllerTest extends TestCase
{

    /**
     * @test
     *
     * @return void
     */
    public function we_can_create_a_hometown()
    {
        // Etant donné que j'ai 2 mairies
        $hometowns = Hometown::all();

        if ($hometowns->count() == 3) {
            $hometowns->last()->delete();
        }
        // Quand j'ajoute une mairie
        $formdata = [
            'label' => "Mairie de Bikele",
            'base_url' => 'http://google.com'
        ];

        $response = $this->json('post', route('create.hometown'), $formdata);

        // Je veux avoir un total de 3 mairies
        $all_hometowns = Hometown::all();
        $this->assertEquals(3, $all_hometowns->count());
        // Et un code status de 201
        $response->seeStatusCode(201);
        // Et une structure identique
        $response->seeJsonStructure([ 'label', 'base_url']);
        // Et des informations identiques
        $response->assertEquals("Mairie de Bikele", $all_hometowns->last()->label);
        $response->assertEquals("http://google.com", $all_hometowns->last()->base_url);
    }

    /**
     * @test
     *
     * @return void
     */
    public function we_can_get_all_hometowns()
    {
        // Etant donné que j'ai 2 mairies
        $hometowns = Hometown::all();

        if ($hometowns->count() == 3) {
            $hometowns->last()->delete();
        }

        // Quand je demande toutes les mairies
        $response = $this->json('get', route('all.hometown'));
        $hometowns_last = Hometown::all();

        // Alors
        $response->seeStatusCode(200);
        $this->assertCount(2, $hometowns_last);
    }

    /**
     * @test
     *
     * @return void
     */
    public function we_can_get_a_hometown()
    {
        // Etant donné qu'on a 
        $hometown_1 = Hometown::find(1);
        $hometown_2 = Hometown::find(2);

        // Quand je demande une mairie
        $response_1 = $this->json('get', route('single.hometown', 1));
        $response_2 = $this->json('get', route('single.hometown', 2));

        // Alors je veux avoir les informations correctes
    }

}
