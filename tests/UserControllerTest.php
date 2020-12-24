<?php

use App\Models\User;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class UserControllerTest extends TestCase
{

    /**
     * @test
     *
     * @return void
     */
    public function we_can_create_a_user()
    {
        // Etant donné que je n'ai aucun utilisateurs
        User::where('id', '<>', 3)->delete();

        $data = [
            'email' => 'noelmeb12@gmail.com',
            'password' => 'mebalenoel',
            'password_confirmation' => 'mebalenoel',
            'fullname' => 'Mebale noel',
            'role_id' => 1,
        ];
        // Quand j'ajoute un utilisateur
        $response = $this->json('post', route('create.user'), $data);
        $response->seeStatusCode(201);
        $simple_user_count = User::where('role_id', 1)->count();

        $this->assertEquals(1, $simple_user_count);
    }
}
