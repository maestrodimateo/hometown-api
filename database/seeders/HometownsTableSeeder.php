<?php

namespace Database\Seeders;

use App\Models\Hometown;
use Illuminate\Database\Seeder;

class HometownsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Hometown::create(["label" => "Mairie d'Akanda", 'base_url' => 'http://mairie-akanda.com/profil/']);
        Hometown::create(["label" => "Hotel de ville de Libreville"]);
    }
}
