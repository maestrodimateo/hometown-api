<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['label' => 'simple-user']);
        Role::create(['label' => 'designer']);
        Role::create(['label' => 'admin']);
    }
}
